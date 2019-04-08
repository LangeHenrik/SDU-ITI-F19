<?php

namespace framework\response;

class HtmlResponse implements IResponse
{
    private $view;
    private $responseCode;
    private $viewBag;

    public function __construct(string $view, array $viewBag, int $responseCode = 200)
    {
        $this->view = $view;
        $this->responseCode = $responseCode;
        $this->viewBag = $viewBag;
    }

    function getContentType(): string
    {
        return "text/html";
    }

    function getContent(): string
    {
        $viewBag = $this->viewBag; // declaring this variable, so the view file has access to it
        include $_SERVER["DOCUMENT_ROOT"] . "/app/view/$this->view.php";
        return "";
    }

    function getResponseCode(): int
    {
        return $this->responseCode;
    }

    public static function create404Response(): IResponse
    {
        return new HtmlResponse("error/404", [], 404);
    }

    public static function createLoginRedirectResponse(): IResponse
    {
        return new HtmlResponse("error/loginRedirect", [], 401);
    }

}