<?php

function restricted ($controller, $method) {

	$restricted_urls = array('HomeController' => array('restricted','logout'));
	$restricted_urls['LoginController'] = array('');
	$restricted_urls['PostsController'] = array('index');
	$restricted_urls['RegisterController'] = array('');
	$restricted_urls['UsersController'] = array('index');
	$restricted_urls['UploadController'] = array('index','post');
	$restricted_urls['apiController'] = array('');

	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}