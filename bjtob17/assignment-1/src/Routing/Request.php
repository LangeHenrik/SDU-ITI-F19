<?php

namespace Routing;

class Request implements IRequest
{
    function __construct()
    {
        $this->init();
    }
    private function init()
    {
        foreach($_SERVER as $key => $value)
        {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    private function toCamelCase(string $val): string
    {
        $result = strtolower($val);

        preg_match_all('/_[a-z]/', $result, $matches);
        foreach($matches[0] as $match)
        {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }

    public function getBody()
    {
        if($this->requestMethod === "GET")
        {
            return $argv;
        }
        if ($this->requestMethod == "POST")
        {
            $result = array();
            foreach($_POST as $key => $value)
            {
                $result[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if (count($_FILES) > 0) {
                $result["_FILES"] = $_FILES;
            }
            return $result;
        }

        return $body;
    }
}