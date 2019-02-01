<?php

require_once 'Frequency.php';
require_once __DIR__.'/../Database.php';

class FrequencyMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function saveFrequency($name, $surname, $frequency, $date) {

        try {
            $stmt = $this->database->connect()->prepare('INSERT INTO `frequency` VALUES (NULL, :n, :s, :f, :d);');
            $stmt->bindParam(':n', $name);
            $stmt->bindParam(':s', $surname);
            $stmt->bindParam(':f', $frequency);
            $stmt->bindParam(':d', $date);
            $stmt->execute();
        }
        catch(PDOException $e) {
            die();
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getFrequency(
        $id
    ) {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM frequency WHERE id = :id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $frequency = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Frequency($frequency['name'], $frequency['surname'], $frequency['frequency'], $frequency['date']);
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getFrequences()
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM frequency ORDER BY id DESC;');
            $stmt->execute();

            $frequency = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $frequency;
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function delete(int $id): void
    {
        try {
            $stmt = $this->database->connect()->prepare('DELETE FROM frequency WHERE id = :id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e) {
            die();
        }
    }
}