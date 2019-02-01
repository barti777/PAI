<?php

require_once 'Session.php';
require_once __DIR__.'/../Database.php';

class SessionMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function startSession($userId) {

        $this->delete($userId);

        try {

            $timeout = microtime(true) + (1440 * 1000);

            $stmt = $this->database->connect()->prepare('INSERT INTO `sessions` VALUES (NULL, :tout, :userId);');
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':tout', $timeout, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $this->database->connect()->prepare("INSERT INTO `logins` VALUES (NULL, :userId, :loginDate);");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':loginDate', date("Y-m-d H:i:s"));
            $stmt->execute();

        }
        catch(PDOException $e) {
            die();
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getSession(
        $userId
    ) {

        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM `sessions` WHERE userId = :userId;');
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $session = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Session($session->timeout, $userId);
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function delete($userId): void
    {

        try {

            $stmt = $this->database->connect()->prepare("INSERT INTO `logouts` VALUES (NULL, :userId, :loginDate);");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':loginDate', date("Y-m-d H:i:s"));
            $stmt->execute();

            $stmt = $this->database->connect()->prepare('DELETE FROM `sessions` WHERE userId = :userId;');
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e) {
        }
    }
}