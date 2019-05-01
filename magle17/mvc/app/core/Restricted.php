<?php

function restricted ($controller, $method) {

	$restricted_urls = array(
		'HomeController' => array(),
		'ImagesController'=>array('index','getimages','uploadImage'),
		'UserImagesController'=>array('index','getimages','removeImage'),
		'UsersController'=>array('index'));


	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}