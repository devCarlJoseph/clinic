<?php


class DentalClinicUser
{
    protected function DentalClinicUser 
    {
        protected string $name,
        protected string $contactNum,
        private string $userId,

        public function __construct( string $userId, string $contactNum, string $name) 
        {
          $this->userId = $userId;
          $this->name = $name;
          $this->contactNumber = $contactNum;
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
    }
}