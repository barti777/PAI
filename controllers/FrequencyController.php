<?php

require_once "AppController.php";

require_once __DIR__.'/../model/Frequency.php';
require_once __DIR__.'/../model/FrequencyMapper.php';


class FrequencyController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $this->render('index', []);
    }

    public function add() {
        $this->render('add', []);
    }

    public function save() {

        $mapper = new FrequencyMapper();

        $_POST['date'] = date('Y-m-d');

        if(!isset($_POST['frequency'])) {
            $_POST['frequency'] = 'off';
        }

        $mapper->saveFrequency($_POST['name'], $_POST['surname'], $_POST['frequency'], $_POST['date']);

        $this->render('index', []);
    }

    public function frequences()
    {
        $mapper = new FrequencyMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $mapper->getFrequences() ? json_encode($mapper->getFrequences()) : 'Coś poszło nie tak';
    }

    public function delete()
    {
        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $mapper = new FrequencyMapper();
        $mapper->delete((int)$_POST['id']);

        http_response_code(200);
    }
}