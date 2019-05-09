<?php

namespace framework\response;


class JsonResponse implements IResponse
{

    private $data;
    private $responseCode;

    /**
     * JsonResponse constructor.
     * @param $data
     * @param int $responseCode
     */
    public function __construct($data, int $responseCode = 200)
    {
        $this->data = $data;
        $this->responseCode = $responseCode;
    }


    function getContentType(): string
    {
        return "application/json";
    }

    function getContent(): string
    {
        return json_encode($this->data);
    }

    function getResponseCode(): int
    {
        return $this->responseCode;
    }

    public static function create401Response(): IResponse
    {
        return new JsonResponse(["error" => "You must be logged in to view this"], 401);
    }
}