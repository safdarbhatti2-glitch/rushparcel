<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Database;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Repositories\ShipmentRepository;

class ShipmentController extends BaseController
{
    protected ShipmentRepository $shipmentRepo;

    public function __construct(?ShipmentRepository $shipmentRepo = null)
    {
        $this->shipmentRepo = $shipmentRepo ?? new ShipmentRepository();
    }

    public function index(Request $request): Response
    {
        $search = trim($request->get('search', ''));
        $statusFilter = trim($request->get('status', ''));

        $sql = "SELECT s.*, srv.name as service_name, c.legal_name as customer_name
                FROM shipments s
                JOIN services srv ON s.service_id = srv.id
                JOIN customers c ON s.customer_id = c.id
                WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (s.shipment_number LIKE :s1 OR s.tracking_number LIKE :s2 OR c.legal_name LIKE :s3)";
            $params[':s1'] = "%{$search}%";
            $params[':s2'] = "%{$search}%";
            $params[':s3'] = "%{$search}%";
        }

        if (!empty($statusFilter)) {
            $sql .= " AND s.status = :st";
            $params[':st'] = $statusFilter;
        }

        $sql .= " ORDER BY s.created_at DESC LIMIT 50";

        $shipments = Database::fetchAll($sql, $params);

        return $this->render('admin.shipments', [
            'title' => 'Operational Shipment Management — Admin',
            'active_page' => 'admin_shipments',
            'shipments' => $shipments,
            'search' => $search,
            'status_filter' => $statusFilter,
        ]);
    }

    public function create(Request $request): Response
    {
        $services = Database::fetchAll("SELECT * FROM services WHERE active = 1 ORDER BY sort_order ASC");

        return $this->render('admin.create_shipment', [
            'title' => 'Create New Shipment & Schedule Events — Admin',
            'active_page' => 'admin_shipments',
            'services' => $services,
            'input' => [],
            'error_message' => null,
        ]);
    }

    public function store(Request $request): Response
    {
        if (!$this->validateCsrf($request)) {
            Session::flash('error', 'Security token expired. Please try again.');
            return Response::redirect('/admin/shipments/create');
        }

        $services = Database::fetchAll("SELECT * FROM services WHERE active = 1 ORDER BY sort_order ASC");
        $input = $request->all();
        $actorUserId = Session::get('user_id');

        // Extract Inputs
        $senderName = trim($input['sender_name'] ?? '');
        $senderPhone = trim($input['sender_phone'] ?? '');
        $senderStreet = trim($input['sender_street'] ?? '');
        $senderCity = trim($input['sender_city'] ?? '');
        $senderPostcode = strtoupper(trim($input['sender_postcode'] ?? ''));
        $senderEmail = trim($input['sender_email'] ?? '');

        $receiverName = trim($input['receiver_name'] ?? '');
        $receiverPhone = trim($input['receiver_phone'] ?? '');
        $receiverStreet = trim($input['receiver_street'] ?? '');
        $receiverCity = trim($input['receiver_city'] ?? '');
        $receiverPostcode = strtoupper(trim($input['receiver_postcode'] ?? ''));
        $receiverEmail = trim($input['receiver_email'] ?? '');

        $itemName = trim($input['item_name'] ?? '');
        $weightKg = (float)($input['weight_kg'] ?? 1.0);
        $lengthCm = (float)($input['length_cm'] ?? 10.0);
        $widthCm = (float)($input['width_cm'] ?? 10.0);
        $heightCm = (float)($input['height_cm'] ?? 10.0);
        $packageType = trim($input['package_type'] ?? 'parcel');
        $specialInstructions = trim($input['special_instructions'] ?? '');

        $serviceId = (int)($input['service_id'] ?? 1);
        $manualAmount = (float)($input['manual_amount'] ?? 0.0);
        $declaredValue = (float)($input['declared_value'] ?? 0.0);

        $scheduledPickupAt = trim($input['scheduled_pickup_at'] ?? $input['pickup_date_time'] ?? '');
        if (empty($scheduledPickupAt)) {
            $scheduledPickupAt = date('Y-m-d H:i');
        }
        $scheduledDeliveryAt = trim($input['scheduled_delivery_at'] ?? '');
        if (empty($scheduledDeliveryAt)) {
            $scheduledDeliveryAt = date('Y-m-d H:i', strtotime($scheduledPickupAt . ' + 1 day'));
        }
        $initialStatus = trim($input['initial_status'] ?? 'booking_confirmed');
        $autoGenerateEvents = !empty($input['auto_generate_events']);

        // Validation
        if (empty($senderName) || empty($senderPhone) || empty($senderStreet) || empty($senderCity) || empty($senderPostcode)) {
            return $this->render('admin.create_shipment', [
                'title' => 'Create New Shipment & Schedule Events — Admin',
                'active_page' => 'admin_shipments',
                'services' => $services,
                'input' => $input,
                'error_message' => 'Please fill out all required Sender details.',
            ]);
        }

        if (empty($receiverName) || empty($receiverPhone) || empty($receiverStreet) || empty($receiverCity) || empty($receiverPostcode)) {
            return $this->render('admin.create_shipment', [
                'title' => 'Create New Shipment & Schedule Events — Admin',
                'active_page' => 'admin_shipments',
                'services' => $services,
                'input' => $input,
                'error_message' => 'Please fill out all required Receiver details.',
            ]);
        }

        if (empty($itemName) || $weightKg <= 0) {
            return $this->render('admin.create_shipment', [
                'title' => 'Create New Shipment & Schedule Events — Admin',
                'active_page' => 'admin_shipments',
                'services' => $services,
                'input' => $input,
                'error_message' => 'Please specify valid item description and positive weight.',
            ]);
        }

        if (empty($scheduledPickupAt)) {
            return $this->render('admin.create_shipment', [
                'title' => 'Create New Shipment & Schedule Events — Admin',
                'active_page' => 'admin_shipments',
                'services' => $services,
                'input' => $input,
                'error_message' => 'Please select a valid Pickup Date & Time.',
            ]);
        }

        try {
            // 1. Customer Lookup or Auto-Create
            $customer = Database::fetch(
                "SELECT id FROM customers WHERE phone = :p OR (email != '' AND email = :e) LIMIT 1",
                [':p' => $senderPhone, ':e' => $senderEmail]
            );

            if ($customer) {
                $customerId = (int)$customer['id'];
            } else {
                $custEmail = !empty($senderEmail) ? $senderEmail : 'cust_' . time() . '@rushparcel.co.uk';
                Database::query(
                    "INSERT INTO customers (type, legal_name, email, phone, status) VALUES ('individual', :name, :email, :phone, 'active')",
                    [':name' => $senderName, ':email' => $custEmail, ':phone' => $senderPhone]
                );
                $customerId = (int)Database::lastInsertId();
            }

            // Format Datetimes
            $pickupDt = date('Y-m-d H:i:s', strtotime($scheduledPickupAt));
            $deliveryDt = date('Y-m-d H:i:s', strtotime($scheduledDeliveryAt));

            // Prepare Shipment Creation Arrays
            $shipmentData = [
                'customer_id' => $customerId,
                'quote_id' => null,
                'service_id' => $serviceId,
                'status' => $initialStatus,
                'scheduled_pickup_at' => $pickupDt,
                'scheduled_delivery_at' => $deliveryDt,
                'total_amount' => $manualAmount,
                'currency' => 'GBP',
                'declared_value' => $declaredValue,
                'special_instructions' => $specialInstructions,
                'created_by' => $actorUserId,
            ];

            $pickupAddress = [
                'name' => $senderName,
                'phone' => $senderPhone,
                'street' => $senderStreet,
                'town' => $senderCity,
                'city' => $senderCity,
                'postcode' => $senderPostcode,
            ];

            $deliveryAddress = [
                'name' => $receiverName,
                'phone' => $receiverPhone,
                'street' => $receiverStreet,
                'town' => $receiverCity,
                'city' => $receiverCity,
                'postcode' => $receiverPostcode,
            ];

            $items = [
                [
                    'description' => $itemName,
                    'quantity' => 1,
                    'weight_kg' => $weightKg,
                    'length_cm' => $lengthCm,
                    'width_cm' => $widthCm,
                    'height_cm' => $heightCm,
                    'package_type' => $packageType,
                    'declared_value' => $declaredValue,
                ]
            ];

            // 2. Create Shipment Record in Database
            $shipment = $this->shipmentRepo->createShipment($shipmentData, $pickupAddress, $deliveryAddress, $items);
            $shipmentId = (int)$shipment['id'];

            // 3. Automated 5-Milestone Event Timeline Schedule Logic
            if ($autoGenerateEvents) {
                $pickupTs = strtotime($pickupDt);
                $deliveryTs = strtotime($deliveryDt);
                $midpointTs = (int)($pickupTs + ($deliveryTs - $pickupTs) / 2);
                $bookingTs = $pickupTs - 7200;
                $outForDeliveryTs = $midpointTs + (int)(($deliveryTs - $midpointTs) / 2);

                $milestones = [
                    [
                        'rank' => 1,
                        'status' => 'booking_confirmed',
                        'time' => date('Y-m-d H:i:s', $bookingTs),
                        'location' => uk_postcode_format($senderPostcode) . ' (' . $senderCity . ')',
                        'message' => 'Booking confirmed. Order details registered in Rush Parcel logistics network.',
                        'note' => 'Automated event milestone 1 generated by admin dispatcher',
                    ],
                    [
                        'rank' => 2,
                        'status' => 'collected',
                        'time' => date('Y-m-d H:i:s', $pickupTs),
                        'location' => $senderCity . ' Regional Depot',
                        'message' => 'Parcel collected from sender by courier driver and scanned into network.',
                        'note' => 'Automated event milestone 2 generated by admin dispatcher',
                    ],
                    [
                        'rank' => 3,
                        'status' => 'in_transit',
                        'time' => date('Y-m-d H:i:s', $midpointTs),
                        'location' => 'Central UK Hub (Birmingham)',
                        'message' => 'Shipment in transit through central UK sorting and distribution hub.',
                        'note' => 'Automated event milestone 3 generated by admin dispatcher',
                    ],
                    [
                        'rank' => 4,
                        'status' => 'out_for_delivery',
                        'time' => date('Y-m-d H:i:s', $outForDeliveryTs),
                        'location' => $receiverCity . ' Local Delivery Depot',
                        'message' => 'Courier out for final delivery to recipient address.',
                        'note' => 'Automated event milestone 4 generated by admin dispatcher',
                    ],
                    [
                        'rank' => 5,
                        'status' => 'delivered',
                        'time' => date('Y-m-d H:i:s', $deliveryTs),
                        'location' => uk_postcode_format($receiverPostcode) . ' (' . $receiverCity . ')',
                        'message' => 'Shipment delivered successfully to recipient with verified proof of delivery.',
                        'note' => 'Automated event milestone 5 generated by admin dispatcher',
                    ],
                ];

                $statusRanks = [
                    'booking_confirmed' => 1,
                    'collected' => 2,
                    'in_transit' => 3,
                    'out_for_delivery' => 4,
                    'delivered' => 5,
                ];

                $targetRank = $statusRanks[$initialStatus] ?? 1;

                // Clear previous initial status history from repo helper to insert clean structured timeline
                Database::query("DELETE FROM shipment_status_history WHERE shipment_id = :sid", [':sid' => $shipmentId]);

                $prevStatus = null;
                foreach ($milestones as $m) {
                    if ($m['rank'] <= $targetRank) {
                        Database::query(
                            "INSERT INTO shipment_status_history (
                                shipment_id, old_status, new_status, public_message, internal_note, location_label, actor_user_id, created_at
                             ) VALUES (
                                :sid, :old, :new, :msg, :note, :loc, :actor, :created
                             )",
                            [
                                ':sid' => $shipmentId,
                                ':old' => $prevStatus,
                                ':new' => $m['status'],
                                ':msg' => $m['message'],
                                ':note' => $m['note'],
                                ':loc' => $m['location'],
                                ':actor' => $actorUserId,
                                ':created' => $m['time'],
                            ]
                        );
                        $prevStatus = $m['status'];
                    }
                }

                // Update final shipment status
                Database::query("UPDATE shipments SET status = :st WHERE id = :sid", [':st' => $initialStatus, ':sid' => $shipmentId]);
            }

            Session::flash('success', "Shipment {$shipment['shipment_number']} (Tracking: {$shipment['tracking_number']}) created successfully with 5 automated milestone events!");
            return Response::redirect("/admin/shipments/{$shipment['shipment_number']}");
        } catch (\Throwable $e) {
            return $this->render('admin.create_shipment', [
                'title' => 'Create New Shipment & Schedule Events — Admin',
                'active_page' => 'admin_shipments',
                'services' => $services,
                'input' => $input,
                'error_message' => 'Failed to create shipment: ' . $e->getMessage(),
            ]);
        }
    }

    public function show(Request $request, array $params): Response
    {
        $shipmentNumber = strtoupper(trim($params['id'] ?? ''));
        $shipment = $this->shipmentRepo->findByNumber($shipmentNumber);

        if (!$shipment) {
            // Check if passed numeric ID
            $numericId = (int)$params['id'];
            if ($numericId > 0) {
                $raw = Database::fetch("SELECT shipment_number FROM shipments WHERE id = :id LIMIT 1", [':id' => $numericId]);
                if ($raw) {
                    $shipment = $this->shipmentRepo->findByNumber($raw['shipment_number']);
                }
            }
        }

        if (!$shipment) {
            return Response::make("404 Shipment Not Found", 404);
        }

        $drivers = Database::fetchAll("SELECT d.id, u.name, d.employee_ref, d.phone FROM drivers d JOIN users u ON d.user_id = u.id WHERE d.status = 'active'");

        return $this->render('admin.shipment_detail', [
            'title' => "Manage Shipment {$shipment['shipment_number']} — Admin",
            'active_page' => 'admin_shipments',
            'shipment' => $shipment,
            'drivers' => $drivers,
        ]);
    }

    public function updateStatus(Request $request, array $params): Response
    {
        if (!$this->validateCsrf($request)) {
            return Response::redirect("/admin/shipments/{$params['id']}");
        }

        $shipmentId = (int)$params['id'];
        $newStatus = trim($request->input('status', ''));
        $publicMessage = trim($request->input('public_message', ''));
        $internalNote = trim($request->input('internal_note', ''));
        $locationLabel = trim($request->input('location_label', ''));
        $actorUserId = Session::get('user_id');

        if (empty($newStatus) || empty($publicMessage)) {
            Session::flash('error', 'Please provide both status and a public milestone update message.');
            return Response::redirect("/admin/shipments/{$shipmentId}");
        }

        try {
            $this->shipmentRepo->updateStatus(
                $shipmentId,
                $newStatus,
                !empty($publicMessage) ? $publicMessage : "Status updated to " . ucwords(str_replace('_', ' ', $newStatus)),
                $internalNote,
                $locationLabel,
                $actorUserId
            );

            $estimatedDelivery = trim($request->input('estimated_delivery', ''));
            if (!empty($estimatedDelivery)) {
                $deliveryDt = date('Y-m-d H:i:s', strtotime($estimatedDelivery));
                Database::query("UPDATE shipments SET scheduled_delivery_at = :d WHERE id = :sid", [':d' => $deliveryDt, ':sid' => $shipmentId]);
            }

            Session::flash('success', "Shipment status updated to [" . ucwords(str_replace('_', ' ', $newStatus)) . "]!");
        } catch (\Throwable $e) {
            Session::flash('error', "Status update failed: " . $e->getMessage());
        }

        return Response::redirect("/admin/shipments/{$shipmentId}");
    }

    public function autoGenerateEvents(Request $request, array $params): Response
    {
        if (!$this->validateCsrf($request)) {
            return Response::redirect("/admin/shipments/{$params['id']}");
        }

        $shipmentId = (int)$params['id'];
        $pickupDate = trim($request->input('pickup_date', ''));
        $deliveryDate = trim($request->input('delivery_date', ''));
        $actorUserId = Session::get('user_id');

        $shipment = Database::fetch("SELECT * FROM shipments WHERE id = :id LIMIT 1", [':id' => $shipmentId]);
        if (!$shipment) {
            Session::flash('error', 'Shipment not found.');
            return Response::redirect('/admin/shipments');
        }

        $pickupAddress = Database::fetch("SELECT * FROM shipment_addresses WHERE shipment_id = :sid AND type = 'pickup' LIMIT 1", [':sid' => $shipmentId]);
        $deliveryAddress = Database::fetch("SELECT * FROM shipment_addresses WHERE shipment_id = :sid AND type = 'delivery' LIMIT 1", [':sid' => $shipmentId]);

        $senderCity = $pickupAddress['city'] ?? $pickupAddress['town'] ?? 'London';
        $senderPostcode = $pickupAddress['postcode'] ?? 'SW1A 1AA';
        $receiverCity = $deliveryAddress['city'] ?? $deliveryAddress['town'] ?? 'Manchester';
        $receiverPostcode = $deliveryAddress['postcode'] ?? 'M1 1AE';

        $pickupDt = !empty($pickupDate) ? date('Y-m-d H:i:s', strtotime($pickupDate)) : date('Y-m-d H:i:s', strtotime('+1 hour'));
        $deliveryDt = !empty($deliveryDate) ? date('Y-m-d H:i:s', strtotime($deliveryDate)) : date('Y-m-d H:i:s', strtotime($pickupDt . ' + 1 day'));

        $pickupTs = strtotime($pickupDt);
        $deliveryTs = strtotime($deliveryDt);
        $midpointTs = (int)($pickupTs + ($deliveryTs - $pickupTs) / 2);
        $bookingTs = $pickupTs - 7200;
        $outForDeliveryTs = $midpointTs + (int)(($deliveryTs - $midpointTs) / 2);

        $milestones = [
            [
                'status' => 'booking_confirmed',
                'time' => date('Y-m-d H:i:s', $bookingTs),
                'location' => uk_postcode_format($senderPostcode) . ' (' . $senderCity . ')',
                'message' => 'Booking confirmed. Order details registered in Rush Parcel logistics network.',
            ],
            [
                'status' => 'collected',
                'time' => date('Y-m-d H:i:s', $pickupTs),
                'location' => $senderCity . ' Regional Depot',
                'message' => 'Parcel collected from sender by courier driver and scanned into network.',
            ],
            [
                'status' => 'in_transit',
                'time' => date('Y-m-d H:i:s', $midpointTs),
                'location' => 'Central UK Hub (Birmingham)',
                'message' => 'Shipment in transit through central UK sorting and distribution hub.',
            ],
            [
                'status' => 'out_for_delivery',
                'time' => date('Y-m-d H:i:s', $outForDeliveryTs),
                'location' => $receiverCity . ' Local Delivery Depot',
                'message' => 'Courier out for final delivery to recipient address.',
            ],
            [
                'status' => 'delivered',
                'time' => date('Y-m-d H:i:s', $deliveryTs),
                'location' => uk_postcode_format($receiverPostcode) . ' (' . $receiverCity . ')',
                'message' => 'Shipment delivered successfully to recipient with verified proof of delivery.',
            ],
        ];

        Database::query("DELETE FROM shipment_status_history WHERE shipment_id = :sid", [':sid' => $shipmentId]);

        $prevStatus = null;
        foreach ($milestones as $m) {
            Database::query(
                "INSERT INTO shipment_status_history (
                    shipment_id, old_status, new_status, public_message, internal_note, location_label, actor_user_id, created_at
                 ) VALUES (
                    :sid, :old, :new, :msg, :note, :loc, :actor, :created
                 )",
                [
                    ':sid' => $shipmentId,
                    ':old' => $prevStatus,
                    ':new' => $m['status'],
                    ':msg' => $m['message'],
                    ':note' => 'Auto generated event milestone',
                    ':loc' => $m['location'],
                    ':actor' => $actorUserId,
                    ':created' => $m['time'],
                ]
            );
            $prevStatus = $m['status'];
        }

        Database::query("UPDATE shipments SET scheduled_pickup_at = :p, scheduled_delivery_at = :d WHERE id = :sid", [
            ':p' => $pickupDt,
            ':d' => $deliveryDt,
            ':sid' => $shipmentId
        ]);

        Session::flash('success', '5 milestone events automatically generated successfully!');
        return Response::redirect("/admin/shipments/{$shipment['shipment_number']}");
    }

    public function assignDriver(Request $request, array $params): Response
    {
        if (!$this->validateCsrf($request)) {
            return Response::redirect("/admin/shipments/{$params['id']}");
        }

        $shipmentId = (int)$params['id'];
        $driverId = (int)$request->input('driver_id', 0);
        $assignedBy = Session::get('user_id');

        if ($driverId <= 0) {
            Session::flash('error', 'Please select a valid active driver.');
            return Response::redirect("/admin/shipments/{$shipmentId}");
        }

        try {
            // Unassign previous assignments
            Database::query("UPDATE driver_assignments SET unassigned_at = CURRENT_TIMESTAMP, status = 'cancelled' WHERE shipment_id = :sid AND unassigned_at IS NULL", [':sid' => $shipmentId]);

            // Create assignment record
            Database::query(
                "INSERT INTO driver_assignments (shipment_id, driver_id, assigned_by, status) VALUES (:sid, :did, :by, 'assigned')",
                [':sid' => $shipmentId, ':did' => $driverId, ':by' => $assignedBy]
            );

            // Fetch driver details
            $driver = Database::fetch("SELECT u.name FROM drivers d JOIN users u ON d.user_id = u.id WHERE d.id = :did LIMIT 1", [':did' => $driverId]);

            // Update status if currently booking_confirmed or collection_scheduled
            $shipment = Database::fetch("SELECT status FROM shipments WHERE id = :id LIMIT 1", [':id' => $shipmentId]);
            if (in_array($shipment['status'], ['booking_confirmed', 'collection_scheduled'])) {
                $this->shipmentRepo->updateStatus(
                    $shipmentId,
                    'driver_assigned',
                    "Driver assigned for collection: " . ($driver['name'] ?? 'Assigned Driver'),
                    "Driver ID {$driverId} assigned by User ID {$assignedBy}",
                    'Regional Depot',
                    $assignedBy
                );
            }

            Session::flash('success', "Driver " . ($driver['name'] ?? '') . " assigned to shipment successfully!");
        } catch (\Throwable $e) {
            Session::flash('error', "Driver assignment failed: " . $e->getMessage());
        }

        return Response::redirect("/admin/shipments/{$shipmentId}");
    }

    public function thermalReceipt(Request $request, array $params): Response
    {
        $shipmentNumber = strtoupper(trim($params['id'] ?? ''));
        $shipment = $this->shipmentRepo->findByNumber($shipmentNumber);

        if (!$shipment) {
            $numericId = (int)$params['id'];
            if ($numericId > 0) {
                $raw = Database::fetch("SELECT shipment_number FROM shipments WHERE id = :id LIMIT 1", [':id' => $numericId]);
                if ($raw) {
                    $shipment = $this->shipmentRepo->findByNumber($raw['shipment_number']);
                }
            }
        }

        if (!$shipment) {
            return Response::make("404 Shipment Not Found", 404);
        }

        return Response::render('admin.thermal_receipt', [
            'shipment' => $shipment,
        ]);
    }

    public function edit(Request $request, array $params): Response
    {
        $ref = strtoupper(trim($params['id'] ?? ''));
        $shipment = $this->shipmentRepo->findByNumber($ref);

        if (!$shipment) {
            $rawTrack = Database::fetch("SELECT shipment_number FROM shipments WHERE tracking_number = :t LIMIT 1", [':t' => $ref]);
            if ($rawTrack) {
                $shipment = $this->shipmentRepo->findByNumber($rawTrack['shipment_number']);
            }
        }

        if (!$shipment) {
            $numericId = (int)$params['id'];
            if ($numericId > 0) {
                $raw = Database::fetch("SELECT shipment_number FROM shipments WHERE id = :id LIMIT 1", [':id' => $numericId]);
                if ($raw) {
                    $shipment = $this->shipmentRepo->findByNumber($raw['shipment_number']);
                }
            }
        }

        if (!$shipment) {
            return Response::make("404 Shipment Not Found", 404);
        }

        $services = Database::fetchAll("SELECT * FROM services WHERE active = 1 ORDER BY sort_order ASC");

        return $this->render('admin.edit_shipment', [
            'title' => "Edit Shipment {$shipment['shipment_number']} — Admin",
            'active_page' => 'admin_shipments',
            'shipment' => $shipment,
            'services' => $services,
            'error_message' => null,
        ]);
    }

    public function update(Request $request, array $params): Response
    {
        if (!$this->validateCsrf($request)) {
            Session::flash('error', 'Security token expired. Please try again.');
            return Response::redirect("/admin/shipments/{$params['id']}/edit");
        }

        $shipmentNumber = strtoupper(trim($params['id'] ?? ''));
        $shipment = $this->shipmentRepo->findByNumber($shipmentNumber);

        if (!$shipment) {
            $numericId = (int)$params['id'];
            if ($numericId > 0) {
                $raw = Database::fetch("SELECT shipment_number FROM shipments WHERE id = :id LIMIT 1", [':id' => $numericId]);
                if ($raw) {
                    $shipment = $this->shipmentRepo->findByNumber($raw['shipment_number']);
                }
            }
        }

        if (!$shipment) {
            return Response::make("404 Shipment Not Found", 404);
        }

        $input = $request->all();
        $shipmentId = (int)$shipment['id'];
        $customerId = (int)$shipment['customer_id'];

        $senderName = trim($input['sender_name'] ?? '');
        $senderPhone = trim($input['sender_phone'] ?? '');
        $receiverName = trim($input['receiver_name'] ?? '');
        $receiverPhone = trim($input['receiver_phone'] ?? '');

        try {
            // 1. Update Customers table so shipment lists show updated customer name
            if ($customerId > 0 && !empty($senderName)) {
                Database::query(
                    "UPDATE customers SET legal_name = :name, phone = :phone WHERE id = :cid",
                    [':name' => $senderName, ':phone' => $senderPhone, ':cid' => $customerId]
                );
            }

            // 2. Update Shipment Table
            $newStatus = trim($input['status'] ?? $shipment['status']);
            $newTotal = (float)($input['total_amount'] ?? $shipment['total_amount']);
            $oldStatus = $shipment['status'];

            Database::query(
                "UPDATE shipments SET
                    service_id = :service_id,
                    status = :status,
                    scheduled_pickup_at = :scheduled_pickup_at,
                    scheduled_delivery_at = :scheduled_delivery_at,
                    total_amount = :total_amount,
                    declared_value = :declared_value,
                    special_instructions = :special_instructions
                 WHERE id = :id",
                [
                    ':service_id' => (int)($input['service_id'] ?? $shipment['service_id']),
                    ':status' => $newStatus,
                    ':scheduled_pickup_at' => !empty($input['scheduled_pickup_at']) ? date('Y-m-d H:i:s', strtotime($input['scheduled_pickup_at'])) : $shipment['scheduled_pickup_at'],
                    ':scheduled_delivery_at' => !empty($input['scheduled_delivery_at']) ? date('Y-m-d H:i:s', strtotime($input['scheduled_delivery_at'])) : $shipment['scheduled_delivery_at'],
                    ':total_amount' => $newTotal,
                    ':declared_value' => (float)($input['declared_value'] ?? $shipment['declared_value']),
                    ':special_instructions' => trim($input['special_instructions'] ?? $shipment['special_instructions']),
                    ':id' => $shipmentId,
                ]
            );

            // 3. Upsert Pickup Address
            $existingPickup = Database::fetch("SELECT id FROM shipment_addresses WHERE shipment_id = :sid AND type = 'pickup' LIMIT 1", [':sid' => $shipmentId]);
            if ($existingPickup) {
                Database::query(
                    "UPDATE shipment_addresses SET
                        name = :name, phone = :phone, house_number = :house_number, street = :street, town = :town, city = :city, postcode = :postcode
                     WHERE id = :aid",
                    [
                        ':name' => $senderName,
                        ':phone' => $senderPhone,
                        ':house_number' => trim($input['sender_house_number'] ?? ''),
                        ':street' => trim($input['sender_street'] ?? ''),
                        ':town' => trim($input['sender_city'] ?? ''),
                        ':city' => trim($input['sender_city'] ?? ''),
                        ':postcode' => strtoupper(trim($input['sender_postcode'] ?? '')),
                        ':aid' => $existingPickup['id'],
                    ]
                );
            } else {
                Database::query(
                    "INSERT INTO shipment_addresses (shipment_id, type, name, phone, house_number, street, town, city, postcode)
                     VALUES (:sid, 'pickup', :name, :phone, :house_number, :street, :town, :city, :postcode)",
                    [
                        ':sid' => $shipmentId,
                        ':name' => $senderName,
                        ':phone' => $senderPhone,
                        ':house_number' => trim($input['sender_house_number'] ?? ''),
                        ':street' => trim($input['sender_street'] ?? ''),
                        ':town' => trim($input['sender_city'] ?? ''),
                        ':city' => trim($input['sender_city'] ?? ''),
                        ':postcode' => strtoupper(trim($input['sender_postcode'] ?? '')),
                    ]
                );
            }

            // 4. Upsert Delivery Address
            $existingDelivery = Database::fetch("SELECT id FROM shipment_addresses WHERE shipment_id = :sid AND type = 'delivery' LIMIT 1", [':sid' => $shipmentId]);
            if ($existingDelivery) {
                Database::query(
                    "UPDATE shipment_addresses SET
                        name = :name, phone = :phone, house_number = :house_number, street = :street, town = :town, city = :city, postcode = :postcode
                     WHERE id = :aid",
                    [
                        ':name' => $receiverName,
                        ':phone' => $receiverPhone,
                        ':house_number' => trim($input['receiver_house_number'] ?? ''),
                        ':street' => trim($input['receiver_street'] ?? ''),
                        ':town' => trim($input['receiver_city'] ?? ''),
                        ':city' => trim($input['receiver_city'] ?? ''),
                        ':postcode' => strtoupper(trim($input['receiver_postcode'] ?? '')),
                        ':aid' => $existingDelivery['id'],
                    ]
                );
            } else {
                Database::query(
                    "INSERT INTO shipment_addresses (shipment_id, type, name, phone, house_number, street, town, city, postcode)
                     VALUES (:sid, 'delivery', :name, :phone, :house_number, :street, :town, :city, :postcode)",
                    [
                        ':sid' => $shipmentId,
                        ':name' => $receiverName,
                        ':phone' => $receiverPhone,
                        ':house_number' => trim($input['receiver_house_number'] ?? ''),
                        ':street' => trim($input['receiver_street'] ?? ''),
                        ':town' => trim($input['receiver_city'] ?? ''),
                        ':city' => trim($input['receiver_city'] ?? ''),
                        ':postcode' => strtoupper(trim($input['receiver_postcode'] ?? '')),
                    ]
                );
            }

            // 5. Upsert Shipment Items
            $existingItem = Database::fetch("SELECT id FROM shipment_items WHERE shipment_id = :sid LIMIT 1", [':sid' => $shipmentId]);
            if ($existingItem) {
                Database::query(
                    "UPDATE shipment_items SET
                        description = :desc, weight_kg = :weight, length_cm = :len, width_cm = :wid, height_cm = :hgt, package_type = :pkg, declared_value = :val
                     WHERE id = :item_id",
                    [
                        ':desc' => trim($input['item_name'] ?? 'General Cargo'),
                        ':weight' => (float)($input['weight_kg'] ?? 1.0),
                        ':len' => (float)($input['length_cm'] ?? 10.0),
                        ':wid' => (float)($input['width_cm'] ?? 10.0),
                        ':hgt' => (float)($input['height_cm'] ?? 10.0),
                        ':pkg' => trim($input['package_type'] ?? 'parcel'),
                        ':val' => (float)($input['declared_value'] ?? 0.0),
                        ':item_id' => $existingItem['id'],
                    ]
                );
            } else {
                Database::query(
                    "INSERT INTO shipment_items (shipment_id, description, quantity, weight_kg, length_cm, width_cm, height_cm, package_type, declared_value)
                     VALUES (:sid, :desc, 1, :weight, :len, :wid, :hgt, :pkg, :val)",
                    [
                        ':sid' => $shipmentId,
                        ':desc' => trim($input['item_name'] ?? 'General Cargo'),
                        ':weight' => (float)($input['weight_kg'] ?? 1.0),
                        ':len' => (float)($input['length_cm'] ?? 10.0),
                        ':wid' => (float)($input['width_cm'] ?? 10.0),
                        ':hgt' => (float)($input['height_cm'] ?? 10.0),
                        ':pkg' => trim($input['package_type'] ?? 'parcel'),
                        ':val' => (float)($input['declared_value'] ?? 0.0),
                    ]
                );
            }

            // 6. Record Status Transition Event if Status Changed
            if ($oldStatus !== $newStatus) {
                Database::query(
                    "INSERT INTO shipment_status_history (shipment_id, old_status, new_status, public_message, internal_note, location_label)
                     VALUES (:sid, :old, :new, :msg, :note, :loc)",
                    [
                        ':sid' => $shipmentId,
                        ':old' => $oldStatus,
                        ':new' => $newStatus,
                        ':msg' => "Status updated to " . ucwords(str_replace('_', ' ', $newStatus)),
                        ':note' => 'Admin updated shipment details',
                        ':loc' => trim($input['sender_city'] ?? 'UK Hub'),
                    ]
                );
            }

            // 7. Update Invoice if present
            $vatRate = (float)config('app.vat_rate', 20.0);
            $subtotal = round($newTotal / (1 + ($vatRate / 100.0)), 2);
            $vatAmount = round($newTotal - $subtotal, 2);

            Database::query(
                "UPDATE invoices SET issue_date = :idate, customer_name = :cname, subtotal = :sub, vat_amount = :vat, total = :tot WHERE shipment_id = :sid",
                [
                    ':idate' => !empty($input['scheduled_pickup_at']) ? date('Y-m-d H:i:s', strtotime($input['scheduled_pickup_at'])) : date('Y-m-d H:i:s'),
                    ':cname' => $senderName,
                    ':sub' => $subtotal,
                    ':vat' => $vatAmount,
                    ':tot' => $newTotal,
                    ':sid' => $shipmentId,
                ]
            );

            Session::flash('success', "Shipment {$shipment['shipment_number']} updated successfully!");
            return Response::redirect("/admin/shipments/{$shipment['shipment_number']}");
        } catch (\Throwable $e) {
            $services = Database::fetchAll("SELECT * FROM services WHERE active = 1 ORDER BY sort_order ASC");
            return $this->render('admin.edit_shipment', [
                'title' => "Edit Shipment {$shipment['shipment_number']} — Admin",
                'active_page' => 'admin_shipments',
                'shipment' => $shipment,
                'services' => $services,
                'error_message' => 'Failed to update shipment: ' . $e->getMessage(),
            ]);
        }
    }

    public function deleteEvent(Request $request, array $params): Response
    {
        if (!$this->validateCsrf($request)) {
            Session::flash('error', 'Security token expired. Please try again.');
            return Response::redirect("/admin/shipments/{$params['id']}");
        }

        $ref = strtoupper(trim($params['id'] ?? ''));
        $eventId = (int)($params['eventId'] ?? 0);

        if ($eventId > 0) {
            Database::query("DELETE FROM shipment_status_history WHERE id = :eid", [':eid' => $eventId]);
            Session::flash('success', "Timeline event milestone deleted successfully.");
        }

        return Response::redirect("/admin/shipments/{$ref}");
    }
}
