<?php
class Controller {
	
	public function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}
	
	public function view($view, $viewbag = []) {
		require_once '../app/views/' . $view . '.php';
	}
	
	public function isPost() {
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}
	
	public function isGet() {
		return $_SERVER['REQUEST_METHOD'] === 'GET';
	}
	
}