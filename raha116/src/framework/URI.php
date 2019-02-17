<?php


namespace framework;


use Exception;

class URI
{
    private const UriSchemeRegex = "/(\/[\w\d\_\-\/]+)(?:\?([\w\d\_\-\/\=&]+)?)?/";

    /**
     * @var string
     */
    public $path;
    /**
     * @var string
     */
    public $query_string;

    public function __construct(string $url)
    {
        if (!preg_match(self::UriSchemeRegex, $url, $matches)) {
            throw new Exception("url: '$url' doesn't match the uri scheme");
        }

        $this->path = $matches[1];
        $this->query_string = $matches[2];
    }
}