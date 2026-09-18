<?php

require_once __DIR__ . '/../Models/Patient.php';
require_once __DIR__ . '/../Models/Dentist.php';
require_once __DIR__ . '/../Models/Receptionist.php';

class DentalClinicService
{
    public function getDentalClinicUsers(): array
    {
        $patient = new Patient(
            "U001",
            "Carl Joseph Sumagang",
            "09171234567",
            "P001",
            "Toothache"
        );

        $dentist = new Dentist(
            "U002",
            "Dr. James Ian",
            "09181234567",
            "General Dentistry",
            "DMD-001"
        );

        $receptionist = new Receptionist(
            "U003",
            "John Lou",
            "09191234567",
            "EMP-001",
            "Morning"
        );

        return [
            $patient,
            $dentist,
            $receptionist
        ];
    }
}