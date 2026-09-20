<?php

require_once __DIR__ . '/../Models/Patient.php';
require_once __DIR__ . '/../Models/Dentist.php';
require_once __DIR__ . '/../Models/Receptionist.php';
require_once __DIR__ . '/../Models/Appointment.php';

class DentalClinicService
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['dental_users']) || !isset($_SESSION['appointments'])) {
            $this->resetToDefault();
        }
    }

    public function getDentalClinicUsers(?string $roleFilter = null): array
    {
        $users = $_SESSION['dental_users'];

        if ($roleFilter && $roleFilter !== 'all') {
            $users = array_filter($users, function (DentalClinicUser $user) use ($roleFilter) {
                return strtolower($user->getRoleBadge()) === strtolower($roleFilter);
            });
        }

        return $users;
    }

    public function getPatients(): array
    {
        return array_filter($_SESSION['dental_users'], fn($u) => $u instanceof Patient);
    }

    public function getDentists(): array
    {
        return array_filter($_SESSION['dental_users'], fn($u) => $u instanceof Dentist);
    }

    public function getAppointments(): array
    {
        return $_SESSION['appointments'];
    }

    public function getAvailableServices(): array
    {
        return [
            ['name' => 'Dental Consultation', 'desc' => 'Comprehensive oral examination and diagnosis', 'fee' => '₱500.00'],
            ['name' => 'Oral Prophylaxis (Cleaning)', 'desc' => 'Removal of plaque and tartar deposits', 'fee' => '₱1,200.00'],
            ['name' => 'Dental Filling', 'desc' => 'Restoration of decayed or fractured teeth', 'fee' => '₱800.00 per surface'],
            ['name' => 'Tooth Extraction', 'desc' => 'Safe removal of problematic or infected teeth', 'fee' => '₱1,500.00'],
            ['name' => 'Orthodontic Consultation', 'desc' => 'Braces and teeth alignment evaluation', 'fee' => '₱800.00']
        ];
    }

    public function addUser(array $data): array
    {
        $role = trim($data['role'] ?? '');
        $name = trim($data['name'] ?? '');
        $contact = trim($data['contact'] ?? '');

        // Validation for Figure 10
        if (empty($name) || empty($contact) || empty($role)) {
            return ['success' => false, 'message' => 'Please fill in all required user fields (Name, Contact, and Role).'];
        }

        $id = "U" . str_pad((string)(count($_SESSION['dental_users']) + 1), 3, '0', STR_PAD_LEFT);

        switch ($role) {
            case 'patient':
                $patientNo = trim($data['patient_no'] ?? '');
                $concern = trim($data['concern'] ?? '');
                if (empty($patientNo) || empty($concern)) {
                    return ['success' => false, 'message' => 'Patient Number and Dental Concern are required.'];
                }
                $user = new Patient($id, $name, $contact, $patientNo, $concern);
                break;

            case 'dentist':
                $spec = trim($data['specialization'] ?? '');
                $lic = trim($data['license_no'] ?? '');
                if (empty($spec) || empty($lic)) {
                    return ['success' => false, 'message' => 'Dentist Specialization and License Number are required.'];
                }
                $user = new Dentist($id, $name, $contact, $spec, $lic);
                break;

            case 'receptionist':
                $empNo = trim($data['employee_no'] ?? '');
                $shift = trim($data['shift'] ?? '');
                if (empty($empNo) || empty($shift)) {
                    return ['success' => false, 'message' => 'Employee Number and Shift are required.'];
                }
                $user = new Receptionist($id, $name, $contact, $empNo, $shift);
                break;

            default:
                return ['success' => false, 'message' => 'Invalid user role selected.'];
        }

        $_SESSION['dental_users'][] = $user;
        return ['success' => true, 'message' => "Successfully added {$user->getName()} ({$user->getRoleBadge()})."];
    }

    public function addAppointment(array $data): array
    {
        $patientId = $data['patient_id'] ?? '';
        $dentistId = $data['dentist_id'] ?? '';
        $date = trim($data['date'] ?? '');
        $time = trim($data['time'] ?? '');
        $service = trim($data['service'] ?? '');

        // Validation for Figure 10
        if (empty($patientId) || empty($dentistId) || empty($date) || empty($time) || empty($service)) {
            return ['success' => false, 'message' => 'All appointment fields are required.'];
        }

        $patient = null;
        $dentist = null;

        foreach ($_SESSION['dental_users'] as $u) {
            if ($u->getUserId() === $patientId && $u instanceof Patient) {
                $patient = $u;
            }
            if ($u->getUserId() === $dentistId && $u instanceof Dentist) {
                $dentist = $u;
            }
        }

        if (!$patient || !$dentist) {
            return ['success' => false, 'message' => 'Selected Patient or Dentist does not exist.'];
        }

        $aptId = "APT-" . str_pad((string)(count($_SESSION['appointments']) + 1), 3, '0', STR_PAD_LEFT);
        $appointment = new Appointment($aptId, $patient, $dentist, $date, $time, $service);

        $_SESSION['appointments'][] = $appointment;
        return ['success' => true, 'message' => "Appointment {$aptId} scheduled successfully for {$patient->getName()}."];
    }

    public function resetToDefault(): void
    {
        $p1 = new Patient("U001", "Carl Joseph Sumagang", "0917-123-4567", "P001", "Toothache");
        $d1 = new Dentist("U002", "Dr. James Ian Escabas", "0918-123-4567", "General Dentistry", "DMD-001");
        $r1 = new Receptionist("U003", "John Lourenz Dico", "0919-123-4567", "EMP-001", "Morning Shift");

        $_SESSION['dental_users'] = [$p1, $d1, $r1];

        $_SESSION['appointments'] = [
            new Appointment("APT-001", $p1, $d1, date('Y-m-d'), "10:00 AM", "Oral Prophylaxis (Cleaning)")
        ];
    }
}