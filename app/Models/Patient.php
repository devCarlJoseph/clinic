<?php

require_once __DIR__ . '/DentalClinicUser.php';

class Patient extends DentalClinicUser
{
    private string $patientNo;
    private string $dentalConcern;

    public function __construct(string $userId, string $name, string $contactNum, string $patientNo, string $dentalConcern)
    {
        parent::__construct($userId, $name, $contactNum);

        $this->patientNo = $patientNo;
        $this->dentalConcern = $dentalConcern;
    }


    public function getRoleDescription(): string 
    {
        return "Patient - receives dental consultation and services";
    }
}