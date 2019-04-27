<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

function restricted ($controller, $method) {

	$restricted_urls = array('HomeController' => array('restricted'),
							'PicturesController' => array('index'),
							'UsersController' => array('index'),
							'ApiController' => array());

	if(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true && $controller != 'HomeController') {
		return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else if(isset($controller) && $controller == 'HomeController' && isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true && $method == 'index') {
		return true;
	} else {
		return false;
	}
}