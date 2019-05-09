<?php

class Router
{

    protected $controller = 'homeController';
    protected $method = 'index';
    protected $params = [];

    function __construct()
    {


        $url = $this->parseUrl();



        if ($url[0] != null && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        require_once '../app/controllers/' . ucfirst($this->controller) . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        require_once 'Restricted.php';
        if (restricted(get_class($this->controller), $this->method)) {
            echo 'Access Denied';
        } else {
            call_user_func_array([$this->controller, $this->method], $this->params);
        }

    }

    public function parseUrl()
    {
        $url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return array_slice($url, 4);
    }

}
	

