<?php

class PersonalData
{
    public $address;
    public $phone;
    public $userId;

    public function __construct($address, $phone, $userId)
    {
        $this->address = $address;
        $this->phone = $phone;
        $this->userId = $userId;
    }
}