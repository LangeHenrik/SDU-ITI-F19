<?php


namespace framework;


use Exception;

class JsonDecoder
{
    static function DecodeJson(string $json, bool $assoc = false)
    {
        $content = json_decode($json, $assoc);

        if (json_last_error()) {
            throw new Exception("Failed to decode json: " . json_last_error_msg());
        }

        return $content;
    }
}