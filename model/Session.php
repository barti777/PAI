<?php

class Session
{
    public $id;
    public $timeout;
    public $userId;

    public function __construct($timeout, $userId)
    {
        $this->timeout = $timeout;
        $this->userId = $userId;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setTimeout($timeout): void
    {
        $this->timeout = $timeout;
    }
}