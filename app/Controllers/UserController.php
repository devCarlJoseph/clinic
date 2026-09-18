<?php

require_once __DIR__ . '/../Services/DentalClinicService.php';

class UserController
{
    private DentalClinicService $dentalClinicService;

    public function __construct()
    {
        $this->dentalClinicService = new DentalClinicService();
    }

    public function index(): array
    {
        return $this->dentalClinicService->getDentalClinicUsers();
    }
}