<?php


namespace framework;


use ReflectionClass;
use ReflectionMethod;
use ReflectionType;
use utilities\strings;

class HandlerCallback
{


    /**
     * @var string
     */
    private $controllerName;
    /**
     * @var string
     */
    private $methodName;
    /**
     * @var DependencyContainer
     */
    private $di;
    /**
     * @var string
     */
    private $requestPath;

    public function __construct(string $controllerName, string $methodName, string $requestPath, DependencyContainer $di)
    {
        $this->controllerName = $controllerName;
        $this->methodName = $methodName;
        $this->di = $di;
        $this->requestPath = $requestPath;
    }

    /**
     * @var ControllerBase
     */
    private $controller;

    public function __invoke()
    {

        $this->controller = $this->di->get_service($this->controllerName);

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

    private const PATH_PREFIX = "path_";

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

        if (strings::starts_with($param_name, self::PATH_PREFIX)) {
            $value = $this->get_path_param(str_replace(self::PATH_PREFIX, "", $param_name));
            return $this->coerce_to_type($value, $type);
        }

        die("Unknown parameter handler for '$param_name'");

    }

    private function get_body(ReflectionType $type)
    {
        $content_type = explode(";", $_SERVER['CONTENT_TYPE'])[0];

        if ($content_type == "application/json") {

            $inputJSON = file_get_contents('php://input');
            $input = JsonDecoder::DecodeJson($inputJSON, true);

            return JsonConverter::convert_to_object($input, $type->getName());
        } else if ($content_type == "multipart/form-data" || $content_type == "application/x-www-form-urlencoded") {
            $name = $type->getName();
            $instance = new $name;
            if (isset($_REQUEST["json"])) {
                $jsonText = $_REQUEST["json"];

                $input = JsonDecoder::DecodeJson($jsonText, true);

                JsonConverter::fill_instance($input, $instance);
            } else {
                JsonConverter::fill_instance($_FILES, $instance);

                JsonConverter::fill_instance($_REQUEST, $instance);
            }
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

    private function get_path_param(string $name): string
    {
        // Turn the registered path into a valid regex
        /**
         * @var string $registeredRequestPath
         */
        $registeredRequestPath = preg_replace("/\//", "\\/", $this->requestPath);

        /**
         * @var Request $request
         */
        $request = $this->di->get_service(Request::class);

        preg_match("/^$registeredRequestPath$/", $request->requestPath, $matches);

        $match = $matches[$name];

        error_log("Found parameter '$name' to be '$match' in '$request->requestPath' against path '$registeredRequestPath'");

        return $match;
    }

    private function get_controller_method(): ReflectionMethod
    {
        $reflection = new ReflectionClass($this->controller);

        return $reflection->getMethod($this->methodName);
    }

}