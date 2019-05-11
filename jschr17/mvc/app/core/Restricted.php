<?php

function restricted ($controller, $method) {

	$restricted_urls = array('HomeController' => array('restricted'),
						'controllers/ApiController' => array());
	//$restricted_urls_2 = array('SignupController' => array('restricted'));

	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} /*else if( isset($controller) && in_array($method, $restricted_urls_2[$controller])) {
        return true;
    }*/
	else {
		return false;
	}
}