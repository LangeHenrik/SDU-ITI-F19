<?php


namespace framework;


use Exception;

class URI
{
    private const UriSchemeRegex = "/(?<prefix>\/\w+\/mvc\/public)(?<path>\/[\w\d\_\-\/]+)(?:\?(?<query>[\w\d\_\-\/\=&]+)?)?/";

    /**
     * @var string
     */
    public $path;
    /**
     * @var string
     */
    public $query_string;

    /**
     * @var string
     */
    public $prefix;

    public function __construct(string $url)
    {
        if (!preg_match(self::UriSchemeRegex, $url, $matches)) {
            throw new Exception("url: '$url' doesn't match the uri scheme");
        }

        $this->path = $matches['path'];
        $this->prefix = $matches['prefix'];
        if (isset($matches['query'])) {
            $this->query_string = $matches['query'];
        } else {
            $this->query_string = "";
        }
    }
}