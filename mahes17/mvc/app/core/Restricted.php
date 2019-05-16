<?php

function restricted($controller, $method)
{

	$restricted_urls = array(
		'HomeController' => array('restricted'),
		'PictureController' => array('all'),
		'UserController' => array(),
		'TestController' => array(),
		'ABIController' => array()
	);

	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		return false;
	} else if (isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}
