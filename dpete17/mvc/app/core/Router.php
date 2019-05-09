<?php

class Router {
	protected $controller = '';
	protected $method = 'index';
	protected $params = [];
	
	function __construct () {
		$url = $this->parseUrl();

		if(isset($url[0])) {
			$this -> controller = ucfirst(strtolower($url[0])) . 'Controller';
			unset($url[0]);

			if(file_exists('../app/controllers/' . $this -> controller . '.php')) {
				$this -> setController($this -> controller, $url);
			} else {
				header('Location: /dpete17/mvc/public/home');
			}
		} else {
			header('Location: /dpete17/mvc/public/home');
		}
	}
	
	public function parseUrl () {
		$url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
		$url = explode('/', $url);
		return array_slice($url, 4);
	}

	private function setController($controller, $url) {
		require_once '../app/controllers/' . $controller . '.php';

		$this->controller = new $controller;
		
		if(isset($url[1])) {
			if(method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}
		
		$this->params = $url ? array_values($url) : [];
		
		require_once 'Restricted.php';
		if(restricted(get_class($this->controller), $this->method)) {
			echo 'Access Denied';
		} else {
			call_user_func_array([$this->controller, $this->method], $this->params);
		}
	}
	
}
	

