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
	    if($view == 'gallery_upload' || $view == 'load-pictures' || $view == 'logout'){
	        $this->controllers($view);
		}
		/* else if ($view == 'api') { // block for testing out why the f.... i can't seem to get contact with the apicontroller
			echo 'api view requested... it shouldnt get requested...';
			$this->controllers('ApiController');
		}*/
		 else {
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