<?php

require_once __DIR__ . '/../Services/DentalClinicService.php';

class UserController
{
    private DentalClinicService $dentalClinicService;

    public function __construct()
    {
        $this->dentalClinicService = new DentalClinicService();
    }

    public function handleRequest(): void
    {
        if (isset($_GET['action']) && $_GET['action'] === 'reset') {
            $this->dentalClinicService->resetToDefault();
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_user') {
            $this->dentalClinicService->addUser($_POST);
            header("Location: index.php?role=" . urlencode($_POST['role'] ?? 'all'));
            exit;
        }

        $activeRole = $_GET['role'] ?? 'all';
        $dentalUsers = $this->dentalClinicService->getDentalClinicUsers($activeRole);

        include __DIR__ . '/../../views/layouts/header.php';
        include __DIR__ . '/../../views/users/index.php';
        include __DIR__ . '/../../views/layouts/footer.php';
    }
}
