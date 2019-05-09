<?php

function restricted ($controller, $method) {

	$restricted_urls = array('HomeController' => array('index'));
	
	if(isset($_SESSION['user_name']) && $_SESSION['user_name'] == true) {
		return false;
	} else if( isset($controller) && isset($restricted_urls[$controller]) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}