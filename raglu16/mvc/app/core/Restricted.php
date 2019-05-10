<?php

function restricted ($controller, $method) {

	$restricted_urls = array(	'HomeController' => array(),
								'LoginController' => array(),
								'ApiController' => array(),
								'UploadController' => array(),
								'RegisterController' => array(),
								'UsersController' => array());

	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}