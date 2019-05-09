<?php
function restricted ($controller, $method) {

	$restricted_urls = array('HomeController' => array('restricted'));

	if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
		return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}