<?php

namespace Controllers;


class BaseController
{
    protected $config;

    /**
     * BaseController constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    protected function html(string $viewName, $viewData = [], $responseCode = 200) : string
    {
        $viewData["_app_title"] = $this->config["app_title"];

        http_response_code($responseCode);
        header('Content-Type: text/html');
        include __DIR__ . "/../" . "/Resources/views/".$viewName.".php";
        return "";
    }

    protected function json($data) : string
    {
        header('Content-Type: application/json');
        return json_encode($data);
    }

    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
}
