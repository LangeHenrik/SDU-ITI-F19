<?php
class Controller {
	
	public function model($model) {
        $file = '../app/models/' . $model . '.php';
        if (file_exists($file)) {
            require_once '../app/models/' . $model . '.php';
        }else{
            require_once '../app/models/' . 'unknown' . '.php';
        }
		return new $model();
	}
	
	public function view($view, $viewbag = []) {
	    $file = '../app/views/' . $view . '.php';
	    if (file_exists($file)) {
            require_once '../app/views/' . $view . '.php';
        }else{
            require_once '../app/views/' . 'unknown' . '.php';
        }
	}
	
	public function post () {
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}
	
	public function get () {
		return $_SERVER['REQUEST_METHOD'] === 'GET';
	}
    function getUUID()
    {
        $UUID = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
        return $UUID;
    }
	
}