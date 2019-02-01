<?php

require_once 'PersonalData.php';
require_once __DIR__.'/../Database.php';

class PersonalDataMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function savePersonalData($address, $phone, $userId) {

        try {
            $stmt = $this->database->connect()->prepare("INSERT INTO `personals` VALUES (NULL, :u ':ad', :p);");
            $stmt->bindParam(':ad', $address);
            $stmt->bindParam(':p', $phone);
            $stmt->bindParam(':u', $userId);
            $stmt->execute();
        }
        catch(PDOException $e) {
            die();
            return 'Error: ' . $e->getMessage();
        }
    }

    public function editPersonalData($address, $phone, $userId) {

        try {

            $stmt = $this->database->connect()->prepare(
            "UPDATE `personals` SET
                `address`=':ad',
                `phone`=:p
            WHERE userId=:id");

            $stmt->bindParam(':id', $userId);
            $stmt->bindParam(':ad', $address);
            $stmt->bindParam(':p', $phone);
            $stmt->execute();
        }
        catch(PDOException $e) {
            die();
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getPersonalData($userId) {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM personals WHERE userId=:id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $personalData = $stmt->fetch(PDO::FETCH_ASSOC);

            return new PersonalData(
                $personalData['address'],
                $personalData['phone'],
                $personalData['userId']);
        }
        catch(PDOException $e) {
            die();
        }        
    }
}