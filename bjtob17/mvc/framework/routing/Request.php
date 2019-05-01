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

    public function getBodyAsJson(string $formDataKey): array
    {
        switch ($this->requestMethod) {
            case "GET":
                {
                    $getBody = $this->getGETBody(FILTER_DEFAULT)[$formDataKey];
                    $strippedJson = strip_tags($getBody);
                    return json_decode($strippedJson, true);
                }

            case "POST":
                {
                    $postBody = $this->getPOSTBody(FILTER_DEFAULT)[$formDataKey];
                    $strippedJson = strip_tags($postBody);
                    return json_decode($strippedJson, true);
                }

            default:
                return null;
        }

    }

    private function getGETBody(int $filter = FILTER_SANITIZE_STRING): array
    {
        $result = [];
        foreach ($_GET as $key => $value) {
            $result[$key] = filter_input(INPUT_GET, $key, $filter);
        }

        return $result;
    }

    private function getPOSTBody(int $filter = FILTER_SANITIZE_STRING): array
    {
        $result = array();
        foreach ($_POST as $key => $value) {
            $result[$key] = filter_input(INPUT_POST, $key, $filter);
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
