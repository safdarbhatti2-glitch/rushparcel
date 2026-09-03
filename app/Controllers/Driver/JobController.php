<?php

namespace App\Controllers\Driver;

use App\Controllers\BaseController;
use App\Core\Database;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Repositories\ShipmentRepository;
use App\Services\PodService;
use RuntimeException;

class JobController extends BaseController
{
    protected ShipmentRepository $shipmentRepo;
    protected PodService $podService;

    public function __construct(?ShipmentRepository $shipmentRepo = null, ?PodService $podService = null)
    {
        $this->shipmentRepo = $shipmentRepo ?? new ShipmentRepository();
        $this->podService = $podService ?? new PodService();
    }

    public function index(Request $request): Response
    {
        $userId = Session::get('user_id');
        $driver = Database::fetch("SELECT * FROM drivers WHERE user_id = :uid LIMIT 1", [':uid' => $userId]);

        $jobs = [];
        if ($driver) {
            $jobs = Database::fetchAll(
                "SELECT s.*, srv.name as service_name, da.status as assignment_status
                 FROM driver_assignments da
                 JOIN shipments s ON da.shipment_id = s.id
                 JOIN services srv ON s.service_id = srv.id
                 WHERE da.driver_id = :did AND da.unassigned_at IS NULL
                 ORDER BY s.created_at DESC",
                [':did' => $driver['id']]
            );
        }

        return $this->render('driver.jobs', [
            'title' => 'Driver Portal — Assigned Courier Jobs',
            'active_page' => 'driver_jobs',
            'driver' => $driver,
            'jobs' => $jobs,
        ]);
    }

    public function show(Request $request, array $params): Response
    {
        $shipmentId = (int)$params['id'];
        $userId = Session::get('user_id');
        $driver = Database::fetch("SELECT * FROM drivers WHERE user_id = :uid LIMIT 1", [':uid' => $userId]);

        if (!$driver) {
            return Response::make("403 Forbidden - Driver profile not found", 403);
        }

        // Verify driver assignment
        $assignment = Database::fetch(
            "SELECT * FROM driver_assignments WHERE shipment_id = :sid AND driver_id = :did AND unassigned_at IS NULL LIMIT 1",
            [':sid' => $shipmentId, ':did' => $driver['id']]
        );

        if (!$assignment) {
            return Response::make("403 Forbidden - Job not assigned to you", 403);
        }

        $shipment = Database::fetch("SELECT shipment_number FROM shipments WHERE id = :id LIMIT 1", [':id' => $shipmentId]);
        $details = $this->shipmentRepo->findByNumber($shipment['shipment_number']);

        return $this->render('driver.job_detail', [
            'title' => "Driver Job Details — Shipment {$details['shipment_number']}",
            'active_page' => 'driver_jobs',
            'driver' => $driver,
            'shipment' => $details,
        ]);
    }

    public function updateStatus(Request $request, array $params): Response
    {
        if (!$this->validateCsrf($request)) {
            return Response::redirect("/driver/jobs/{$params['id']}");
        }

        $shipmentId = (int)$params['id'];
        $newStatus = trim($request->input('status', ''));
        $publicMessage = trim($request->input('public_message', ''));
        $locationLabel = trim($request->input('location_label', ''));
        $actorUserId = Session::get('user_id');

        try {
            $this->shipmentRepo->updateStatus(
                $shipmentId,
                $newStatus,
                $publicMessage,
                "Updated by driver (User ID {$actorUserId})",
                $locationLabel,
                $actorUserId
            );
            Session::flash('success', "Job status updated to [" . ucwords(str_replace('_', ' ', $newStatus)) . "]!");
        } catch (\Throwable $e) {
            Session::flash('error', "Status update failed: " . $e->getMessage());
        }

        return Response::redirect("/driver/jobs/{$shipmentId}");
    }

    public function uploadPod(Request $request, array $params): Response
    {
        if (!$this->validateCsrf($request)) {
            return Response::redirect("/driver/jobs/{$params['id']}");
        }

        $shipmentId = (int)$params['id'];
        $userId = Session::get('user_id');
        $driver = Database::fetch("SELECT * FROM drivers WHERE user_id = :uid LIMIT 1", [':uid' => $userId]);

        if (!$driver) {
            Session::flash('error', 'Driver account not found.');
            return Response::redirect("/driver/jobs/{$shipmentId}");
        }

        $recipientName = trim($request->input('recipient_name', 'Recipient'));
        $file = $request->file('pod_file');

        if (empty($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            Session::flash('error', 'Please select a valid POD photo or signature file to upload.');
            return Response::redirect("/driver/jobs/{$shipmentId}");
        }

        try {
            $this->podService->processPodUpload($shipmentId, $driver['id'], $file, $recipientName, $userId);
            Session::flash('success', "Proof of Delivery (POD) uploaded successfully! Shipment marked as Delivered.");
            return Response::redirect("/driver/jobs/{$shipmentId}");
        } catch (\Throwable $e) {
            Session::flash('error', "POD Upload failed: " . $e->getMessage());
            return Response::redirect("/driver/jobs/{$shipmentId}");
        }
    }
}
