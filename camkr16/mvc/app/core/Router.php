<?php

namespace core;

class Router {
	
	protected $controller = 'controllers\HomeController';
	protected $method = 'index';
	protected $params = [];
	
	function __construct () {
		$url = $this->parseUrl();
		if(!empty($url[0])){
            $url[0] = strtoupper($url[0][0]) . substr($url[0], 1);
            if(file_exists('../app/controllers/' . $url[0] . 'Controller.php')) {
                $this->controller = "controllers\\" . $url[0] . 'Controller';
                //$this->controller = strtoupper($this->controller[0]) . substr($this->controller, 1);
                error_log($this->controller);
                unset($url[0]);
            }
        }

		$this->controller = new $this->controller;
		
		if(isset($url[1])) {
			if(method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}
		
		$this->params = $url ? array_values($url) : [];
		
		require_once 'restricted.php';
		if(restricted(get_class($this->controller), $this->method)) {
		    header("Location: /camkr16/mvc/public/authentication/login");
			echo 'Access Denied';
		} else {
			call_user_func_array([$this->controller, $this->method], $this->params);
		}
		
	}
	
	public function parseUrl () {
		$url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
		$url = explode('/', $url);
		return array_slice($url, 4);
	}
	
}
	

