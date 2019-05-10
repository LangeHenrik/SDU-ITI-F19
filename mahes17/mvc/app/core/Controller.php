<?php
class Controller {

	//load model by name
	public function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}

	//Load view by view name and viewbag (content)
	public function view($view, $viewbag = []) {
		require_once '../app/views/' . $view . '.php';
	}

	public function post () {
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}

	public function get () {
		return $_SERVER['REQUEST_METHOD'] === 'GET';
	}

}
