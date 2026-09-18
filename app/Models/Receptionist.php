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

    public function getRoleDescription(): string 
    {
        return "Receptionist - handles registration and appointment assistance.";
    }
}