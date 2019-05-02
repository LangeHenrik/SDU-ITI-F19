<?php

function restricted ($controller, $method) {

	$restricted_urls = array(
		'HomeController' => array('restricted'),
		'DashboardController' => array('index', 'images', 'accounts'),
		'ApiController' => array()
);

	if(isset($_SESSION['ID'])) {
		return false;
	} else if( isset($controller) && in_array(strtolower($method), $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}