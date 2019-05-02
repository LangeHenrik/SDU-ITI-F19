<?php
class Controller {
	
	public function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}
	public function controllers($controller){
	    require_once '../app/controllers/' . $controller . '.php';
    }
	
	public function view($view, $viewbag = []) {
	    if($view == 'gallery_upload' || $view == 'load-pictures'){
	        $this->controllers($view);
        } else {
            require_once '../app/views/home/' . $view . '.php';
        }
    }

	public function post () {
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}
	
	public function get () {
		return $_SERVER['REQUEST_METHOD'] === 'GET';
	}
	
}