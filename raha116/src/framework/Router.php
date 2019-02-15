<?php
declare(strict_types=1);

namespace framework;


use ReflectionClass;
use ReflectionException;
use utilities\IO;
use utilities\strings;

class Router
{
    const VERBS = array("GET", "POST", "PUT", "DELETE");
    /**
     * @var DependencyContainer
     */
    private $di;
    private $resolver;

    public function __construct(DependencyContainer $di)
    {
        $this->di = $di;
        $this->resolver = new RequestResolver();
    }

    public function handle_current_request()
    {
        $this->auto_discover_controllers();

        $path = $_SERVER['REQUEST_URI'];
        $verb = strtolower($_SERVER['REQUEST_METHOD']);


        $handler = $this->resolver->get_handler($path, $verb);

        if (!$handler) {
            $this->no_handler_found();
            return;
        }


        /**
         * @var ActionResult $result
         */
        $result = $handler();

        $this->respond($result);




    }

    private function respond(ActionResult $result)
    {

        http_response_code($result->get_status());
        header("Content-Type: application/json");
        echo $result->to_json();
        echo "\n";
    }

    /**
     * Auto discovers controllers in
     */
    public function auto_discover_controllers()
    {

        $files = $this->get_controller_classes();

        foreach ($files as $file) {
            $this->load_controller_class($file);
        }
    }

    /**
     * Get the files that has controllers based on the convention
     * that all controllers are in the 'controllers' directory
     * and ends with 'Controller.php'
     */
    private function get_controller_classes(): array
    {
        $files = scandir(IO::join_paths(dirname(__FILE__), "../controllers"));

        return array_filter($files, function ($file) {
            return strings::ends_with($file, "Controller.php");
        });
    }

    /**
     * Loads the given controller class
     *
     * @param string $controller_file
     */
    private function load_controller_class(string $controller_file)
    {
        // Remove the php extension, so we can get the controller class name itself.
        $className = "controllers\\" . str_replace(".php", "", $controller_file);

        /** @var ControllerBase $controller */
        $controller = $this->di->get_service($className);

        $handle = $controller->get_controller_path_handle();

        $handled_verbs = $this->get_handled_verbs($controller);

        foreach ($handled_verbs as $verb) {
            $this->resolver->register_handler("/api/$handle/", $verb, new HandlerCallback($controller, $verb));
        }
    }

    /**
     * Based on some conventions, available methods are extracted from the
     * controller and registered
     *
     * @param ControllerBase $controller
     * @return array
     */
    private function get_handled_verbs(ControllerBase $controller): array
    {
        $matchedVerbs = array();

        try {
            $reflection = new ReflectionClass($controller);


            foreach (self::VERBS as $verb) {

                $lowerVerb = strtolower($verb);

                $methods = $reflection->getMethods();
                foreach ($methods as $method) {
                    if ($method->getName() == $lowerVerb) {
                        $matchedVerbs[] = $verb;
                    }
                }
            }

        } catch (ReflectionException $e) {
            die("Failed to reflect on $controller: $e");
        }

        return $matchedVerbs;
    }

    private function no_handler_found()
    {
        http_response_code(404);
        header("Content-Type: application/json");
        die('{"status": "Not Found"}' . "\n");
    }
}