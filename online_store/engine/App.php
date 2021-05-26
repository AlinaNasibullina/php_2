<?php

namespace MyApp;

use MyApp\Controllers\IndexController;
use MyApp\Tools\Singleton;
use MyApp\Tools\DB;

final class App 
{
    use Singleton;
    private $config;
    private $db;

    public function getDB(): DB
    {
        return $this->db;
    }

    public function init()
    {
        $this->db = new DB($this->config['db']);
    }

    public function run()
    {
        $this->init();
        session_start();


        $path = $_SERVER['REQUEST_URI'];

        $router = new Router($this->config['routing']);
        [$controllerName, $actionName, $param] = $router->parse($path);

        $controllerClass = 'MyApp\Controllers\\' . ucfirst($controllerName) . 'Controller';
        $methodName = 'action' . ucfirst($actionName);

        if (class_exists($controllerClass)){
            $controller = new $controllerClass();
            if (method_exists($controller, $methodName)) {
                $controller->$methodName($param);
                return;
            }
        }

        (new IndexController())->actionError();
    }

    public function setConfig($config) //где вызывается функция, откуда подгружаем конфиг?
    {
        $this->config = $config;
        return $this; //зачем?
    }

    public function getConfig()
    {
        return $this->config;
    }


}