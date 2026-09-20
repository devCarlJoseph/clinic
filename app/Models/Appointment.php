<?php

require_once __DIR__ . '/Patient.php';
require_once __DIR__ . '/Dentist.php';

class Appointment
{
    private string $appointmentId;
    private Patient $patient;
    private Dentist $dentist;
    private string $appointmentDate;
    private string $appointmentTime;
    private string $dentalService;

    public function __construct(
        string $appointmentId,
        Patient $patient,
        Dentist $dentist,
        string $appointmentDate,
        string $appointmentTime,
        string $dentalService
    ) {
        $this->appointmentId = $appointmentId;
        $this->patient = $patient;
        $this->dentist = $dentist;
        $this->appointmentDate = $appointmentDate;
        $this->appointmentTime = $appointmentTime;
        $this->dentalService = $dentalService;
    }

    public function getAppointmentId(): string
    {
        return $this->appointmentId;
    }

    public function getPatient(): Patient
    {
        return $this->patient;
    }

    public function getDentist(): Dentist
    {
        return $this->dentist;
    }

    public function getAppointmentDate(): string
    {
        return $this->appointmentDate;
    }

    public function getAppointmentTime(): string
    {
        return $this->appointmentTime;
    }

    public function getDentalService(): string
    {
        return $this->dentalService;
    }
}