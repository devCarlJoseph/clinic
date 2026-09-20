<?php

class DentalClinicUser
{
    protected string $name;
    protected string $contactNumber;
    private string $userId;

    public function __construct(string $userId, string $name, string $contactNumber)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->contactNumber = $contactNumber;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContactNumber(): string
    {
        return $this->contactNumber;
    }

    public function getRoleDescription(): string
    {
        return "General dental clinic user";
    }

    public function getRoleBadge(): string
    {
        return "User";
    }
}