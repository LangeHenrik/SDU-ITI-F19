<?php

namespace utilities;

class IO
{
    /**
     * Joins the given paths into one path without creating double slashes
     *
     * Mostly stolen from here, just slightly modified:
     * https://stackoverflow.com/a/15575293/3950006
     *
     * @param string ...$parts
     * @return string
     */
    public static function join_paths(string ...$parts): string
    {
        $paths = array();

        foreach ($parts as $part) {
            if ($part !== '') {
                $paths[] = $part;
            }
        }

        return preg_replace('#/+#', '/', join('/', $paths));
    }
}


