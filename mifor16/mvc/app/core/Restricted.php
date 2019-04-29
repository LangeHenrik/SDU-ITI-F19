<?php

namespace core;

function restricted ($controller, $method) {
    # TODO: CLEAN
	# ORIGINAL: $restricted_urls = array('HomeController' => array('restricted'));
    # Controller names should be corrected???
    $restricted_urls = array('controllers\HomeController' => array('index'), "controllers\AuthenticationController" => array(), 'controllers\APIController' => array(), 'controllers\UserController' => array());


    if(isset($_SESSION['id'])) {
		return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}