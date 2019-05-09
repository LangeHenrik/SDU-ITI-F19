<?php

if (session_status() == PHP_SESSION_NONE ) {
	session_start();
}

require_once '../app/init.php';

// Note for my self
/**
 * Note for my self.
 * in the init file, is the relationship established in the system, such as Controller, router and Database
 * Establishing the relationship through a init file, each class does not need to have multiple relations. '
 * A router constructer then sets the url routing in the constructor method and is therefor called when just creating a router obj as seen here.
 * $router = new Router();
 */
