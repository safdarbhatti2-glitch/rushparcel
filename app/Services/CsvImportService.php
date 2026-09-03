<?php

namespace App\Services;

use App\Core\Database;
use RuntimeException;

class CsvImportService extends BaseService
{
    public function parseAndPreviewCsv(string $filePath, string $filename, ?int $createdByUserId = null): array
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new RuntimeException("CSV file [{$filename}] could not be read.");
        }

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if ($ext !== "csv") {
            throw new RuntimeException("Invalid file format. Only .csv files are supported.");
        }

        $handle = fopen($filePath, "r");
        if (!$handle) {
            throw new RuntimeException("Failed to open CSV stream.");
        }

        $headers = fgetcsv($handle, 4096, ",");
        if (!$headers) {
            fclose($handle);
            throw new RuntimeException("CSV file is empty or missing headers.");
        }

        $normalizedHeaders = array_map(function($h) {
            return strtolower(trim(str_replace([" ", "_", "-"], "", $h)));
        }, $headers);

        $validRows = [];
        $failedRows = [];
        $rowIndex = 1;

        while (($row = fgetcsv($handle, 4096, ",")) !== false) {
            $rowIndex++;
            if (count(array_filter($row)) === 0) continue; // skip blank lines

            $rowData = [];
            foreach ($headers as $i => $headerName) {
                $cleanKey = $normalizedHeaders[$i] ?? "col_{$i}";
                $rowData[$cleanKey] = trim($row[$i] ?? "");
            }

            // Map aliases
            $mapped = [
                "sender_name" => $rowData["sendername"] ?? $rowData["sender"] ?? $rowData["fromname"] ?? "",
                "sender_city" => $rowData["sendercity"] ?? $rowData["origin"] ?? $rowData["fromcity"] ?? "London",
                "sender_postcode" => $rowData["senderpostcode"] ?? $rowData["frompostcode"] ?? "SW1A 1AA",
                "receiver_name" => $rowData["receivername"] ?? $rowData["receiver"] ?? $rowData["toname"] ?? "",
                "receiver_city" => $rowData["receivercity"] ?? $rowData["destination"] ?? $rowData["tocity"] ?? "Manchester",
                "receiver_postcode" => $rowData["receiverpostcode"] ?? $rowData["topostcode"] ?? "M1 1AE",
                "weight_kg" => (float)($rowData["weight"] ?? $rowData["weightkg"] ?? 1.0),
                "item_name" => $rowData["item"] ?? $rowData["description"] ?? $rowData["cargo"] ?? "General Cargo",
            ];

            // Validation
            $errors = [];
            if (empty($mapped["sender_name"])) {
                $errors[] = "Missing Sender Name";
            }
            if (empty($mapped["receiver_name"])) {
                $errors[] = "Missing Receiver Name";
            }
            if ($mapped["weight_kg"] <= 0) {
                $errors[] = "Weight must be greater than 0 kg";
            }

            if (empty($errors)) {
                $validRows[] = array_merge($mapped, ["row_number" => $rowIndex]);
            } else {
                $failedRows[] = [
                    "row_number" => $rowIndex,
                    "errors" => implode(", ", $errors),
                    "raw" => implode(", ", $row),
                ];
            }
        }
        fclose($handle);

        $batchId = "BATCH-" . date("Ymd") . "-" . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        $totalCount = count($validRows) + count($failedRows);

        Database::query(
            "INSERT INTO csv_imports (import_batch_id, filename, total_rows, valid_rows, failed_rows, status, created_by)
             VALUES (:bid, :fname, :total, :valid, :failed, \"preview\", :created_by)",
            [
                ":bid" => $batchId,
                ":fname" => $filename,
                ":total" => $totalCount,
                ":valid" => count($validRows),
                ":failed" => count($failedRows),
                ":created_by" => $createdByUserId,
            ]
        );

        return [
            "batch_id" => $batchId,
            "filename" => $filename,
            "total_rows" => $totalCount,
            "valid_rows_count" => count($validRows),
            "failed_rows_count" => count($failedRows),
            "valid_rows" => $validRows,
            "failed_rows" => $failedRows,
        ];
    }

    public function commitImportBatch(string $batchId, array $validRows): array
    {
        return $this->transaction(function() use ($batchId, $validRows) {
            $importRecord = Database::fetch("SELECT * FROM csv_imports WHERE import_batch_id = :bid LIMIT 1", [":bid" => $batchId]);
            if (!$importRecord) {
                throw new RuntimeException("Import batch [{$batchId}] not found.");
            }

            if ($importRecord["status"] === "committed") {
                throw new RuntimeException("Import batch [{$batchId}] has already been committed.");
            }

            $createdCount = 0;
            $shipmentRepo = new \App\Repositories\ShipmentRepository();

            foreach ($validRows as $r) {
                $shipmentData = [
                    "customer_id" => 1,
                    "service_id" => 1,
                    "status" => "booking_confirmed",
                    "scheduled_pickup_at" => date("Y-m-d H:i:s"),
                    "scheduled_delivery_at" => date("Y-m-d H:i:s", strtotime("+1 day")),
                    "total_amount" => 29.99,
                    "currency" => "GBP",
                    "special_instructions" => "Bulk CSV Import Batch [{$batchId}]",
                ];

                $pickupAddress = [
                    "name" => $r["sender_name"],
                    "phone" => "07700 900123",
                    "street" => "100 High Street",
                    "city" => $r["sender_city"],
                    "postcode" => $r["sender_postcode"],
                    "country" => "United Kingdom",
                ];

                $deliveryAddress = [
                    "name" => $r["receiver_name"],
                    "phone" => "07700 900456",
                    "street" => "50 Commercial Road",
                    "city" => $r["receiver_city"],
                    "postcode" => $r["receiver_postcode"],
                    "country" => "United Kingdom",
                ];

                $items = [
                    [
                        "description" => $r["item_name"],
                        "quantity" => 1,
                        "weight_kg" => $r["weight_kg"],
                        "package_type" => "parcel",
                    ]
                ];

                $shipmentRepo->createShipment($shipmentData, $pickupAddress, $deliveryAddress, $items);
                $createdCount++;
            }

            Database::query("UPDATE csv_imports SET status = \"committed\" WHERE import_batch_id = :bid", [":bid" => $batchId]);

            return [
                "batch_id" => $batchId,
                "committed_rows" => $createdCount,
                "status" => "committed",
            ];
        });
    }
}

