<?php

function restricted ($controller, $method) {

	$restricted_urls = array(	'HomeController' => array(), 
								'LoginController' => array(),
								'ContentController' => array('index'),
								'MyPageController' => array('index'), 
								'UserController' => array('index'),
								'ApiController' => array('index'));

	//print_r($_SESSION['logged_in']);

	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}