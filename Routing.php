<?php

require_once 'controllers/DefaultController.php';
require_once 'controllers/UploadController.php';
require_once 'controllers/PlayerController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/ArticleController.php';
require_once 'controllers/FrequencyController.php';
require_once 'controllers/PersonalDataController.php';

class Routing
{
    public $routes = [];

    public function __construct()
    {
        $this->routes = [
            'index' => [
                'controller' => 'DefaultController',
                'action' => 'index'
            ],
            'login' => [
                'controller' => 'DefaultController',
                'action' => 'login'
            ],
            'logout' => [
                'controller' => 'DefaultController',
                'action' => 'logout'
            ],
            'upload' => [
                'controller' => 'UploadController',
                'action' => 'upload'
            ],
            'player' => [
                'controller' => 'PlayerController',
                'action' => 'player'
            ],
            'admin' => [
                'controller' => 'AdminController',
                'action' => 'index'
            ],
            'admin_users' => [
                'controller' => 'AdminController',
                'action' => 'users'
            ],
            'news' => [
                'controller' => 'ArticleController',
                'action' => 'index'
            ],
            'frequency' => [
                'controller' => 'FrequencyController',
                'action' => 'index'
            ],
            'frequency_list' => [
                'controller' => 'FrequencyController',
                'action' => 'frequences'
            ],
            'frequency_add' => [
                'controller' => 'FrequencyController',
                'action' => 'add'
            ],
            'frequency_save' => [
                'controller' => 'FrequencyController',
                'action' => 'save'
            ],
            'frequency_delete' => [
                'controller' => 'FrequencyController',
                'action' => 'delete'
            ],
            'personals_data' => [
                'controller' => 'PersonalDataController',
                'action' => 'index'
            ],
            'personals_save' => [
                'controller' => 'PersonalDataController',
                'action' => 'save'
            ],
            'news_list' => [
                'controller' => 'ArticleController',
                'action' => 'articles'
            ],
            'news_add' => [
                'controller' => 'ArticleController',
                'action' => 'add'
            ],
            'news_delete' => [
                'controller' => 'ArticleController',
                'action' => 'delete'
            ],
            'news_save' => [
                'controller' => 'ArticleController',
                'action' => 'save'
            ],
            'admin_delete_user' => [
                'controller' => 'AdminController',
                'action' => 'userDelete'
            ]
        ];
    }

    public function run()
    {
        $page = isset($_GET['page'])
            && isset($this->routes[$_GET['page']]) ? $_GET['page'] : 'login';

        if ($this->routes[$page]) {

            $class = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];

            $object = new $class;
            $object->$action();
        }
    }
}