<?php

require_once "AppController.php";

require_once __DIR__.'/../model/PersonalData.php';
require_once __DIR__.'/../model/PersonalDataMapper.php';


class PersonalDataController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $this->render('index', []);
    }

    public function save() {

        $mapper = new PersonalDataMapper();

        var_dump($_POST);

        $mapper->savePersonalData(
            $_POST['address'],
            $_POST['phone'],
            $_POST['userId'],
        );

        $this->render('index', []);
    }

    public function data($userId)
    {
        $mapper = new PersonalDataMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $mapper->getPersonalData($userId) ? json_encode($mapper->getPersonalData($userId) ) : 'Coś poszło nie tak';
    }

    public function delete()
    {
        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $mapper = new PersonalDataMapper();
        $mapper->delete((int)$_POST['id']);

        http_response_code(200);
    }
}