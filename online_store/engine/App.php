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

    public function run()
    {
        $this->db = new DB($this->config['db']);

        $path = $_SERVER['REQUEST_URI'];
        [$url] = explode('?', $path);
        $url = trim($url, '/');
        [$controllerName, $actionName, $param] = explode('/', $url);

        if (empty($controllerName)) {
            $controllerName = 'index';
        }
        if (empty($actionName)) {
            $actionName = 'index';
        }

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