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
        $path = explode("/", $key);

        if(isset($_POST[$path[0]])) {
            $data = $_POST;
        } else if(isset($_GET[$path[0]])) {
            $data = $_GET;
        } else {
            return false;
        }

        foreach ($path as $seg) {
            //print_r($seg);

            // Check if segment is present in data
            if(is_array($data) && isset($data[$seg])) {
                // Check if data is json
                $json = json_decode($data[$seg], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $data = $json;
                } else {
                    $data = $data[$seg];
                }
            }
        }

        if($sanitize) {
            return self::sanitize($data);
        }
        return $data;
        /*if(isset($_POST[$key])) {
            if($sanitize) {
                return self::sanitize($_POST[$key]);
            }
            return $_POST[$key];
        } else if(isset($_GET[$key])) {
            if($sanitize) {
                return self::sanitize($_GET[$key]);
            }
            return $_GET[$key];
        }*/
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