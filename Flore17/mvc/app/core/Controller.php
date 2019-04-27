<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

class Controller {
	
	public function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}
	
	public function view($view, $viewbag = []) {
		require_once '../app/views/' . $view . '.php';
	}

	public function service($service) {
		require_once '../app/services/' . $service . '.php';
		return new $service();
	}
	
	public function post () {
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}
	
	public function get () {
		return $_SERVER['REQUEST_METHOD'] === 'GET';
	}
	
}