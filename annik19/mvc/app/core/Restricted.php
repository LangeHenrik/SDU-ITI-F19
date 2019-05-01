<?php

function restricted ($controller, $method) {

    //echo '<br> restricted function';
	$restricted_urls = array('HomeController' => array('restricted'), 'ApiController' => array('restricted'));
    //var_dump($restricted_urls);

	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	    //echo '1 if';
		return false;
	} else if( isset($controller) && in_array($method, $restricted_urls[$controller])) {
	    //echo '2 if';
		return true;
	} else {
	    //echo '3 if';
		return false;
	}
}