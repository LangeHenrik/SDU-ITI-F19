<?php

namespace App\Core\ViewRenderer;


use App\Core\Config;

class Renderer
{

    public function render($content, array $data = []) {

        global $publicBasePath;
        $publicBasePath = Config::get('app/publicBasePath');

        // Register sections
        if(preg_match_all("/@section\([\'|\"](.*)[\'|\"]\)\n(.*)\n@endsection/msU", $content, $matches, PREG_SET_ORDER, 0)) {
            foreach ($matches as $match) {
                $data[$match[1]] = trim($match[2]);

                // Replace in the content
                $content = str_replace($match[0], "", $content);
            }
        }

        // Find simple view include tags
        if(preg_match_all("/@view\((.*)\)/", $content, $matches, PREG_SET_ORDER, 0)) {
            foreach ($matches as $match) {
                // Remove any spaces used for formatting
                $view = trim($match[1]);

                $result = View::create($view, $data)->render();

                // Replace in the content
                $content = str_replace($match[0], $result, $content);
            }
        }

        // Find simple include tags with parameters
        if(preg_match_all("/@view\((.*?)(,.*?)((.*?))\)/s", $content, $matches, PREG_SET_ORDER, 0)) {
            foreach ($matches as $match) {
                // Remove any spaces used for formatting
                $view = trim($match[1]);

                $viewData = json_decode($match[4], true, 128, JSON_OBJECT_AS_ARRAY);
                $viewData = array_merge($viewData, $data);

                // Create view
                $result = View::create($view, $viewData)->render();

                // Replace in the content
                $content = str_replace($match[0], $result, $content);
            }
        }

        // For each loops
        if(preg_match_all("/@foreach\((.*)\)\n(.*)@endforeach/msU", $content, $matches, PREG_SET_ORDER, 0)) {
            foreach ($matches as $match) {
                $loopCondition = $match[1];
                $loopContent = "\$res .= \"" . addslashes(trim($match[2]));

                $loopContent = str_replace("{{ ", "", $loopContent);
                $loopContent = str_replace(" }}", "", $loopContent);

                $loopContent .= "\";";

                $loop = "\$res = null; foreach ({$loopCondition}) { {$loopContent} }\n\rreturn \$res;";

                $loopRes = eval($loop);
                $loopRes = str_replace("\'", "'", $loopRes);

                $content = str_replace($match[0], $loopRes, $content);
            }
        }

        // Find dynamic parts of the template
        if(preg_match_all("/\{\{(.*)\}\}/msU", $content, $matches, PREG_SET_ORDER, 0)) {
            foreach ($matches as $match) {
                // Remove any spaces used for formatting
                $value = trim($match[1]);

                // Check if part is a variable
                if(substr($value, 0, 1) == "$") {
                    // Check if variable has a default value
                    if(strpos($match[1], ":")) {
                        $parts = explode(":", str_replace("$", "", $value));
                        $key = trim($parts[0]);

                        // Set result to default value
                        $result = ltrim(trim($parts[1]), "\"");

                        // If key exists set result to variable value
                        if (array_key_exists($key, $data)) {
                            $result = $data[$key];
                        }

                        // Replace in the content
                        $content = str_replace("{{{$match[1]}}}", $result, $content);
                    } else {
                        $key = str_replace("$", "", $value);
                        $result = null;

                        $keys = explode("->", $key);

                        if(array_key_exists($keys[0], $data)) {
                            $result = $data[$keys[0]];

                            if(count($keys) > 1) {
                                foreach (array_slice($keys, 1) as $subkey) {
                                    $result = $result->{$subkey};
                                }
                            }
                        } else {
                            if($key == "base") {
                                $result = Config::get('app/base');
                            } else if($key == "publicBasePath") {
                                $result = Config::get('app/publicBasePath');
                            }
                        }

                        // Convert boolean values
                        if(is_bool($result)) {
                            $result = ($result) ? 'true' : 'false';
                        }

                        // Set replacement to variable passed into data array
                        /*if (array_key_exists($firstKey, $data)) {
                            $result = $data[$key];
                        }*/

                        // Replace in the content
                        $content = str_replace("{{{$match[1]}}}", $result, $content);
                    }
                }
            }
        }

        // If statements
        if(preg_match_all("/@if\((.*)\)\n(.*)@endif/msU", $content, $matches, PREG_SET_ORDER, 0)) {

            foreach ($matches as $match) {
                $condition = $match[1];
                $result = trim($match[2]);

                if(eval("return ({$condition});")) {
                    $content = str_replace($match[0], $result, $content);
                } else {
                    $content = str_replace($match[0], "", $content);
                }
            }
        }

        return $content;
    }

}