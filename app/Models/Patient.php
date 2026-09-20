<?php

require_once __DIR__ . '/DentalClinicUser.php';

class Patient extends DentalClinicUser
{
    private string $patientNo;
    private string $dentalConcern;

    public function __construct(
        string $userId,
        string $name,
        string $contactNumber,
        string $patientNo,
        string $dentalConcern
    ) {
        parent::__construct(
            $userId,
            $name,
            $contactNumber
        );

        $this->patientNo = $patientNo;
        $this->dentalConcern = $dentalConcern;
    }

    public function getPatienNo(): string 
    {
        return $this->patientNo;
    }

    public function getDentalConcern(): string
    {
        return $this->dentalConcern;
    }

    public function getRoleDescription(): string
    {
        return "Receives regular dental checkups, cleaning, and procedural treatments.";
    }

    public function getRoleBadge(): string 
    {
        return "Patient";
    }

    public function getAdditionalDetails(): array
    {
        return [
            "Patient No" => $this->patientNo,
            "Dental Concern" => $this->dentalConcern
        ];
    }
}