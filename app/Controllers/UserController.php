<?php

require_once __DIR__ . '/../Services/DentalClinicService.php';

class UserController
{
    private DentalClinicService $service;

    public function __construct()
    {
        $this->service = new DentalClinicService();
    }

    public function handleRequest(): void
    {
        $alert = null;

        if (isset($_GET['action']) && $_GET['action'] === 'reset') {
            $this->service->resetToDefault();
            header("Location: index.php?tab=users");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_user') {
            $result = $this->service->addUser($_POST);
            if ($result['success']) {
                header("Location: index.php?tab=users&success=" . urlencode($result['message']));
                exit;
            } else {
                $alert = ['type' => 'error', 'message' => $result['message']];
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_appointment') {
            $result = $this->service->addAppointment($_POST);
            if ($result['success']) {
                header("Location: index.php?tab=appointments&success=" . urlencode($result['message']));
                exit;
            } else {
                $alert = ['type' => 'error', 'message' => $result['message']];
            }
        }

        if (isset($_GET['success'])) {
            $alert = ['type' => 'success', 'message' => $_GET['success']];
        }

        $activeTab = $_GET['tab'] ?? 'users';
        $activeRole = $_GET['role'] ?? 'all';

        $dentalUsers = $this->service->getDentalClinicUsers($activeRole);
        $allPatients = $this->service->getPatients();
        $allDentists = $this->service->getDentists();
        $appointments = $this->service->getAppointments();
        $servicesList = $this->service->getAvailableServices();

        include __DIR__ . '/../../views/layouts/header.php';
        include __DIR__ . '/../../views/users/index.php';
        include __DIR__ . '/../../views/layouts/footer.php';
    }
}