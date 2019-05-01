<?php
class Controller {
	
	public function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}
	
	public function view($view, $viewbag = []) {
		require_once '../app/views/' . $view . '.php';
	}
	
	public function post () {
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}
	
	public function get () {
		return $_SERVER['REQUEST_METHOD'] === 'GET';
	}

	public function service($service) {
		require_once '../app/services/' . $service . '.php';
		return new $service();
	}
	
}