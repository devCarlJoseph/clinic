<?php

class DentalClinicUser
{
    protected string $name;
    protected string $contactNumber;
    private string $userId;

    public function __construct(
        string $userId,
        string $name,
        string $contactNumber
    ) {
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

    abstract public function getRoleDescription(): string;
    abstract public function getRoleBadge(): string;
    abstract public function getAdditionalDetails(): array;
}