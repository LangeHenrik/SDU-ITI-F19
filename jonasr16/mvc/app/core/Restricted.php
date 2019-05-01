<?php

function restricted ($controller, $method) {

	$restricted_urls = array('controllers\HomeController' => array('index'), 'controllers\LoginController' => array(), 'controllers\RegisterController' => array(), 'controllers\AjaxController' => array(), 'controllers\APIController' => array(), 'controllers\MenuController' => array());
    if(isset($_SESSION['login_user'])) {
        return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
		return true;
	} else {
		return false;
	}
}