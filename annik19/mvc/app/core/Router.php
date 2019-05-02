<?php

class Router {
	
	protected $controller = 'homeController';
	protected $method = 'index';
	protected $params = [];
	
	function __construct () {
	    //echo "<br> Router Constructor";
		$url = $this->parseUrl();
		
		if(isset($url[0]) &&    file_exists('../app/controllers/' . $url[0] . 'Controller.php')) {
			$this->controller = $url[0] . 'Controller';
			//echo "<br> unset url[0]";
			unset($url[0]);
		}
		
		require_once '../app/controllers/' . $this->controller . '.php';
		$this->controller = new $this->controller;

		//echo "<br> url[1]: ".$url[1];
		if(isset($url[1])) {
			if(method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
                //echo "<br> unset url[1]";
				unset($url[1]);
			}
		}
		
		$this->params = $url ? array_values($url) : [];

		require_once 'restricted.php';
        //echo "<br> this->method: ". $this->method;
        //echo "<br> controller ". get_class($this->controller);
		if(restricted(get_class($this->controller), $this->method)) {
			echo 'Access Denied';
		} else {
		    //echo "<br> this->method: ". $this->method;
            //echo "<br> this->params: "; var_dump($this->params);
            //echo "<br> controller ". $this->controller;
			call_user_func_array([$this->controller, $this->method], $this->params);
		}
	}
	
	public function parseUrl () {
	    //echo '<br> parsing URL';
		$url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
		$url = explode('/', $url);
		return array_slice($url, 4);
	}
	
}
	

