<?php

require_once __DIR__ . '/../Models/Patient.php';
require_once __DIR__ . '/../Models/Dentist.php';
require_once __DIR__ . '/../Models/Receptionist.php';

class DentalClinicService
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['dental_users'])) {
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

    public function addUser(array $data): bool
    {
        $role = $data['role'] ?? '';
        $id = "U" . str_pad((string)(count($_SESSION['dental_users']) + 1), 3, '0', STR_PAD_LEFT);
        $name = trim($data['name'] ?? '');
        $contact = trim($data['contact'] ?? '');
        if (empty($name) || empty($contact)) {
            return false;
        }
        switch ($role) {
            case 'patient':
                $user = new Patient(
                    $id,
                    $name,
                    $contact,
                    !empty($data['patient_no']) ? $data['patient_no'] : 'P-' . rand(100, 999),
                    !empty($data['concern']) ? $data['concern'] : 'General Checkup'
                );
                break;
            case 'dentist':
                $user = new Dentist(
                    $id,
                    $name,
                    $contact,
                    !empty($data['specialization']) ? $data['specialization'] : 'General Dentistry',
                    !empty($data['license_no']) ? $data['license_no'] : 'DMD-' . rand(1000, 9999)
                );
                break;
            case 'receptionist':
                $user = new Receptionist(
                    $id,
                    $name,
                    $contact,
                    !empty($data['employee_no']) ? $data['employee_no'] : 'EMP-' . rand(100, 999),
                    !empty($data['shift']) ? $data['shift'] : 'Morning (8:00 AM - 5:00 PM)'
                );
                break;
            default:
                return false;
        }
        $_SESSION['dental_users'][] = $user;
        return true;
    }

     public function resetToDefault(): void
    {
        $_SESSION['dental_users'] = [
            new Patient("U001", "Carl Joseph Sumagang", "0917-123-4567", "P-101", "Toothache & Cleaning"),
            new Dentist("U002", "Dr. James Ian", "0918-987-6543", "Orthodontics & Implants", "DMD-5524"),
            new Receptionist("U003", "John Lou", "0919-456-7890", "EMP-204", "Morning (8:00 AM - 4:00 PM)")
        ];
    }
}