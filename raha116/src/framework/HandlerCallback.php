<?php


namespace framework;


use ReflectionClass;
use ReflectionMethod;
use ReflectionType;
use utilities\strings;

class HandlerCallback
{
    /**
     * @var ControllerBase
     */
    private $controller;
    /**
     * @var string
     */
    private $verb;


    public function __construct(ControllerBase $controller, string $verb)
    {
        $this->controller = $controller;
        $this->verb = $verb;
    }


    public function __invoke()
    {
        $method = $this->get_controller_method();

        $params = $method->getParameters();

        $call_params = array();

        foreach ($params as $param) {
            $param_name = $param->getName();
            $type = $param->getType();

            $value = $this->get_param_value($param_name, $type);

            $call_params[] = $value;
        }

        return $method->invoke($this->controller, ...$call_params);
    }

    private const QUERY_PREFIX = "query_";

    private const BODY_KEY = "body";

    /**
     * Extracts the given parameter from the request
     * And converts it to the given type, if one was passed on
     *
     * @param string $param_name
     * @param ReflectionType $type
     * @return mixed
     */
    private function get_param_value(string $param_name, ReflectionType $type)
    {

        if (strings::starts_with($param_name, self::QUERY_PREFIX)) {
            $value = $this->get_query_param(str_replace(self::QUERY_PREFIX, "", $param_name));
            return $this->coerce_to_type($value, $type);
        }

        if ($param_name == self::BODY_KEY) {
            return $this->get_body($type);
        }

        die("Unknown parameter handler for '$param_name'");

    }

    private function get_body(ReflectionType $type)
    {
        $content_type = explode(";", $_SERVER['CONTENT_TYPE'])[0];

        if ($content_type == "application/json") {

            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE);

            return JsonConverter::convert_to_object($input, $type->getName());
        } else if ($content_type == "multipart/form-data") {
            $name = $type->getName();
            $instance = new $name;

            JsonConverter::fill_instance($_FILES, $instance);

            JsonConverter::fill_instance($_REQUEST, $instance);

            return $instance;
        } else {
            die("unknown content type $content_type");
        }
    }

    /**
     * Coerces to given value into the requested type
     *
     * @param string $value
     * @param ReflectionType $type
     * @return mixed
     */
    private function coerce_to_type(string $value, ReflectionType $type)
    {

        if (!settype($value, $type->getName())) {
            die("Failed to convert '$value' to '$type'");
        }

        return $value;
    }

    private function get_query_param(string $name): string
    {
        return $_REQUEST[$name];
    }

    private function get_controller_method(): ReflectionMethod
    {
        $reflection = new ReflectionClass($this->controller);

        return $reflection->getMethod(strtolower($this->verb));
    }

}