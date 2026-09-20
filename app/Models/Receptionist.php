<?php

require_once __DIR__ . '/DentalClinicUser.php';

class Receptionist extends DentalClinicUser
{
    private string $employeeNo;
    private string $shift;

    public function __construct(
        string $userId,
        string $name,
        string $contactNumber,
        string $employeeNo,
        string $shift
    ) {
        parent::__construct($userId, $name, $contactNumber);
        $this->employeeNo = $employeeNo;
        $this->shift = $shift;
    }

    public function getEmployeeNo(): string
    {
        return $this->employeeNo;
    }

    public function getShift(): string
    {
        return $this->shift;
    }

    public function getRoleDescription(): string
    {
        return "Receptionist - handles registration and appointment assistance.";
    }

    public function getRoleBadge(): string
    {
        return "Receptionist";
    }
}