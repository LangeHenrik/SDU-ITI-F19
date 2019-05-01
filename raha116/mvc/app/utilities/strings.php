<?php


namespace utilities;


class strings
{
    /**
     * Checks if $needle is the start of $haystack
     *
     * Stolen from:
     * https://stackoverflow.com/a/834355/3950006
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function starts_with($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * Checks if $needle is the end of $haystack
     *
     * Also stolen from:
     * https://stackoverflow.com/a/834355/3950006
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function ends_with($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }
}