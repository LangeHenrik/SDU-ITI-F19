<?php

namespace App\Core\Utility;


class Input
{

    /**
     * Check if request has POST any parameters
     *
     * @return bool
     */
    public static function hasPost()
    {
        return (!empty($_POST));
    }

    /**
     * Check if request has GET any parameters
     *
     * @return bool
     */
    public static function hasGet()
    {
        return (!empty($_GET));
    }

    /**
     * Get a POST or GET parameter from a key
     *
     * @param $key
     * @param bool $sanitize
     * @return string
     */
    public static function get($key, $sanitize = true)
    {
        if(isset($_POST[$key])) {
            if($sanitize) {
                return self::sanitize($_POST[$key]);
            }
            return $_POST[$key];
        } else if(isset($_GET[$key])) {
            if($sanitize) {
                return self::sanitize($_GET[$key]);
            }
            return $_GET[$key];
        }
    }

    /**
     * Sanitize a string
     *
     * @param $string
     * @return string
     */
    public static function sanitize($string)
    {
        return htmlentities($string, ENT_QUOTES, "UTF-8");
    }

}