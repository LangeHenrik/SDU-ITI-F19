<?php

namespace Controllers;


class BaseController
{
    private $data = [];
    protected function html(string $viewName, $data = []) : string
    {
        header('Content-Type: text/html');
        $this->data = $data;
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