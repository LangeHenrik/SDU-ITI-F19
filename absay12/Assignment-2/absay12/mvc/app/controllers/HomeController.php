<?php

class HomeController extends Controller {

	public function index () {
		$viewbag['pictures'] = $this->model('Home') -> getAllPictures();
		$this->view('home/index', $viewbag);
	}
}
