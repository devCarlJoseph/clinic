<?php

require_once __DIR__ . '/DentalClinicUser.php';

class Dentist extends DentalClinicUser
{
    private string $specialization;
    private string $licenseNo;

    public function __construct(
        string $userId,
        string $name,
        string $contactNumber,
        string $specialization,
        string $licenseNo
    ) {
        parent::__construct(
            $userId,
            $name,
            $contactNumber
        );

        $this->specialization = $specialization;
        $this->licenseNo = $licenseNo;
    }

    public function getLicenseNo(): string 
    {
        return $this->licenseNo;
    }

    public function getSpecialization(): string
    {
        return $this->specialization;
    }

    public function getRoleDescription(): string
    {
        return "Provides expert dental consultation, diagnosis, and surgical treatments..";
    }

    public function getRoleBadge(): string
    {
        return "Dentist";
    }

    public function getAdditionalDetails(): array
    {
        return [
            'License No.' =>  $this->licenseNo,
            'Specialization' => $this->specialization
        ];
    }
}