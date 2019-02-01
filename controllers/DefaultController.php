<?php

require_once "AppController.php";

require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';
require_once __DIR__.'/../model/SessionMapper.php';


class DefaultController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $text = 'Hello there 👋';

        $this->render('index', ['text' => $text]);
    }

    public function login()
    {
        $sessionMapper = new SessionMapper();
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            $user = $mapper->getUser($_POST['email']);

            if(!$user) {
                return $this->render('login', ['message' => ['Email not recognized']]);
            }

            if ($user->getPassword() !== md5($_POST['password'])) {
                return $this->render('login', ['message' => ['Wrong password']]);
            } else {
                $_SESSION["id"] = $user->getEmail();
                $_SESSION["role"] = $user->getRole();
                $_SESSION['userId'] = $user->id;

                $sessionMapper->startSession(intval($user->id));

                $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
                header("Location: {$url}?page=index");
                exit();
            }
        }

        $this->render('login');
    }

    public function logout()
    {

        $sessionMapper = new SessionMapper();
        $sessionMapper->delete($_SESSION['userId']);

        session_unset();
        session_destroy();

        $this->render('index', ['text' => 'You have been successfully logged out!']);
    }
}