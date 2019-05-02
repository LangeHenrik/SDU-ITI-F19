<?php

function restricted ($controller, $method) {

	$restricted_urls = array(
		'HomeController' => array(),
		'HomePageController' => array('index', 'uploadImage'), // insert restricted methods eg. only logged on
		'SignupController' => array(),
		'ProfileController' => array('index'),
		'UsersController' => array('index', 'search'),
		'APIController' => array()
);

	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		return false;//if logged in, no restrictions
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}