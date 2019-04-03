<?php

/**
 * This file will define various functions as conveniences
 */

if(!function_exists('view')) {
    /**
     * Convenience for view creation
     *
     * @param string $name
     * @param array $data
     * @return \App\Core\ViewRenderer\View
     */
    function view($name = '', $data = []) {
        return \App\Core\ViewRenderer\View::create($name, $data);
    }
}

if(!function_exists('redirect')) {
    /**
     * Convenience for view redirection
     *
     * @param $url
     * @return \App\Core\Response\Redirect
     */
    function redirect($url) {
        return \App\Core\Response\Redirect::to($url);
    }
}

if(!function_exists('uuid')) {
    /**
     * Convenience for UUID string
     *
     * @return string
     */
    function uuid() {
        return \App\Core\Utility\Uuid::generate();
    }
}

if(!function_exists('auth')) {

    function auth() {

    }
}