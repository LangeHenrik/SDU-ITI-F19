<?php

namespace framework\routing;

class Request implements IRequest
{
    function __construct()
    {
        $this->init();
    }

    private function init()
    {
        // Set the values of $_SERVER as properties of this class, with camelCased names
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    public function getBody(): array
    {
        switch ($this->requestMethod) {
            case "GET":
                return $this->getGETBody();

            case "POST":
                return $this->getPOSTBody();

            default:
                return [];
        }
    }

    private function getGETBody(): array
    {
        $result = [];
        foreach ($_GET as $key => $value) {
            $result[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $result;
    }

    private function getPOSTBody(): array
    {
        $result = array();
        foreach ($_POST as $key => $value) {
            $result[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if (count($_FILES) > 0) {
            $result["_FILES"] = $_FILES;
        }
        return $result;
    }

    private function toCamelCase(string $val): string
    {
        $result = strtolower($val);

        preg_match_all('/_[a-z]/', $result, $matches);
        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }
}
