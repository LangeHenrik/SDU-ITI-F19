<?php
declare(strict_types=1);

namespace framework;


use utilities\IO;

class Settings
{
    private $cached_settings;

    public function get_settings()
    {
        if (!$this->cached_settings) {
            $json = file_get_contents(IO::join_paths(__DIR__, "..", "settings.json"));

            if (!$json) {
                die("No settings file available");
            }

            $this->cached_settings = JsonDecoder::DecodeJson($json);
        }

        return $this->cached_settings;
    }
}