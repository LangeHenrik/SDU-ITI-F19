<?php

class Router {
	
	protected $controller = 'HomeController';
	protected $method = 'index';
	protected $params = [];
	
	function __construct () {
		$url = $this->parseUrl();
		
		if(file_exists('../app/controllers/' . $url[0] . 'Controller.php')) {
			$this->controller = $url[0] . 'Controller';
			unset($url[0]);
		}
		
		require_once '../app/controllers/' . $this->controller . '.php';
		$this->controller = new $this->controller;
        /*echo '<pre>'; print_r($url); echo '</pre>';*/

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
	
	public function parseUrl () {
		$url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
		$url = explode('/', $url);
		return array_slice($url, 4);
	}

	private $_uri = array();
	private $_method = array();

	/**
	 * Builds a collection of internal URL's to look for
	 * @param type $_uri
	 */
	public function add($_uri, $_method = null){
		$this->_uri[] = '/' . trim($_uri, '/');
		if ($_method != null) {
			$this->_method[] = $_method;
		}
	}

	public function submit(){
		$uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
		foreach ($this->_uri as $key => $val) {
			if (preg_match("#^$val$#", $uriGetParam)) {
				$useMethod = $this->_method[$key];
				new $useMethod;

			}
		}
	}
	
}
	

