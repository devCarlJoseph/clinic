<?php

class Receptionist extends DentalClinicUser
{
    protected string $employeeNo;
    protected string $shift;

    public function __construct(string $userId, string $name, string $contactNum, string $employeeNo, string $shift)
    {
        parent::__construct($userId, $name, $contactNum);

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
        return "Manages appointment bookings, patient registrations, and front-desk reception.";
    }

    public function getRoleBadge(): string
    {
        return "Receptionist";
    }

    public function getAdditionalDetails(): array
    {
        return [
            "Employee No" => $this->employeeNo,
            "Shift" => $this->shift
        ];
    }
}