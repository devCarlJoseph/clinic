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
        parent::__construct($userId, $name, $contactNumber);
        $this->specialization = $specialization;
        $this->licenseNo = $licenseNo;
    }

    public function getSpecialization(): string
    {
        return $this->specialization;
    }

    public function getLicenseNo(): string
    {
        return $this->licenseNo;
    }

    // Overridden method as documented in Section 9
    public function getRoleDescription(): string
    {
        return "Dentist - provides dental consultation and treatment.";
    }

    public function getRoleBadge(): string
    {
        return "Dentist";
    }
}