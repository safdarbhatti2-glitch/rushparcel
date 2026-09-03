<?php

namespace App\Services;

use App\Core\Config;
use App\Core\Database;
use App\Repositories\ShipmentRepository;
use RuntimeException;

class PodService extends BaseService
{
    protected ShipmentRepository $shipmentRepo;

    public function __construct(?ShipmentRepository $shipmentRepo = null)
    {
        $this->shipmentRepo = $shipmentRepo ?? new ShipmentRepository();
    }

    public function processPodUpload(int $shipmentId, int $driverId, array $fileInput, string $recipientName, ?int $actorUserId = null): array
    {
        return $this->transaction(function () use ($shipmentId, $driverId, $fileInput, $recipientName, $actorUserId) {
            $shipment = Database::fetch("SELECT * FROM shipments WHERE id = :id LIMIT 1", [':id' => $shipmentId]);
            if (!$shipment) {
                throw new RuntimeException("Shipment [ID: {$shipmentId}] not found.");
            }

            // File Upload Validation (finfo, extension allow-list, random filename)
            $tmpPath = $fileInput['tmp_name'] ?? '';
            $originalName = $fileInput['name'] ?? 'pod.jpg';
            $sizeBytes = (int)($fileInput['size'] ?? 0);

            if (!is_uploaded_file($tmpPath) && !file_exists($tmpPath)) {
                throw new RuntimeException("Invalid file upload.");
            }

            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $allowedExts = Config::get('security.allowed_upload_extensions', ['jpg', 'jpeg', 'png', 'gif', 'pdf']);

            if (!in_array($ext, $allowedExts)) {
                throw new RuntimeException("Invalid file extension [.{$ext}]. Allowed: " . implode(', ', $allowedExts));
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $tmpPath);
            finfo_close($finfo);

            $allowedMimes = Config::get('security.allowed_upload_mimes', ['image/jpeg', 'image/png', 'image/gif', 'application/pdf']);
            if (!in_array($mimeType, $allowedMimes)) {
                throw new RuntimeException("Invalid file content type [{$mimeType}].");
            }

            // Random hashed storage filename in /storage/private/pod/
            $storageDir = BASE_PATH . '/storage/private/pod';
            if (!is_dir($storageDir)) {
                mkdir($storageDir, 0755, true);
            }

            $randomFilename = 'pod_' . md5(uniqid('', true)) . '.' . $ext;
            $destinationPath = $storageDir . '/' . $randomFilename;

            if (!move_uploaded_file($tmpPath, $destinationPath) && !copy($tmpPath, $destinationPath)) {
                throw new RuntimeException("Failed to save POD file to secure storage.");
            }

            $checksum = hash_file('sha256', $destinationPath);

            // Record in files table
            Database::query(
                "INSERT INTO files (owner_type, owner_id, storage_path, original_name, mime_type, size_bytes, checksum, created_by)
                 VALUES ('pod_photo', :shipment_id, :path, :orig_name, :mime, :size, :hash, :created_by)",
                [
                    ':shipment_id' => $shipmentId,
                    ':path' => 'pod/' . $randomFilename,
                    ':orig_name' => $originalName,
                    ':mime' => $mimeType,
                    ':size' => $sizeBytes,
                    ':hash' => $checksum,
                    ':created_by' => $actorUserId,
                ]
            );

            $fileId = (int)Database::lastInsertId();

            // Record in proof_of_delivery table
            $now = date('Y-m-d H:i:s');
            Database::query(
                "INSERT INTO proof_of_delivery (shipment_id, recipient_name, photo_file_id, delivered_at, driver_id)
                 VALUES (:sid, :recipient, :fid, :del_at, :did)
                 ON DUPLICATE KEY UPDATE recipient_name = VALUES(recipient_name), photo_file_id = VALUES(photo_file_id), delivered_at = VALUES(delivered_at)",
                [
                    ':sid' => $shipmentId,
                    ':recipient' => $recipientName,
                    ':fid' => $fileId,
                    ':del_at' => $now,
                    ':did' => $driverId,
                ]
            );

            // Transition Shipment Status to 'delivered'
            $this->shipmentRepo->updateStatus(
                $shipmentId,
                'delivered',
                "Delivered to recipient [{$recipientName}]. Proof of delivery photo captured.",
                "POD photo file ID {$fileId} recorded by Driver ID {$driverId}",
                'Recipient Address',
                $actorUserId
            );

            return [
                'shipment_id' => $shipmentId,
                'recipient_name' => $recipientName,
                'file_id' => $fileId,
                'delivered_at' => $now,
            ];
        });
    }
}
