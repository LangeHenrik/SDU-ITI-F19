<?php

function restricted ($controller, $method) {

    $restricted_urls = array('controllers\homeController' => array('index'), 'controllers\LoginController' => array(),
        'controllers\RegisterController' => array(), 'controllers\UploadController' => array(),
        'controllers\UsersController' => array(), 'controllers\APIController' => array());

	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}