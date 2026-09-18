<?php

require_once __DIR__ . '/DentalClinicUser.php';


class Dentis extends DentalClinicUser
{
    protected string $specialization;
    protected string $licenseNo;


    public function __construct(string $userId, string $name, string $contactNum, string $specialization, string $licenseNo)
    {
        parent::__construct($userId, $name, $contactNum);

        $this->specialization = $specialization;
        $this->licenseNo = $licenseNo;
    }

    public function getRoleDescription(): string
    {
        return "Dentist - provides dental consultation and treatment.";
    }
}