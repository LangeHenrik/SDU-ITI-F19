<?php

namespace Router;

class Router
{
  private $request;
  private $supportedHttpMethods = array(
    "GET",
    "POST"
  );
  function __construct(IRequest $request)
  {
   $this->request = $request;
  }


     function __call($name, $args)
    {
        list($route, $classMethodName) = $args;
        $objectMethod = explode("@", $classMethodName);
        $method = [new $objectMethod[0], $objectMethod[1]];
        if (!in_array(strtoupper($name), $this->supportedHttpMethods))
        {
            $this->invalidMethodHandler();
        }
        $formattedRoute = $this->formatRoute($route);
        $this->{strtolower($name)}[$formattedRoute] = $method;
    }

  private function formatRoute($route)
  {
    $result = rtrim($route, '/');
    if ($result === '')
    {
      return '/';
    }
    return $result;
  }


  private function invalidMethodHandler()
  {
    header($this->request->serverProtocol." 405 Method Not Allowed", true, 405);
    header("Location: /405");
    die();
  }



  private function defaultRequestHandler()
  {
    header($this->request->serverProtocol." 404 Not Found", true, 404);
    header("Location: /404");
    die();
  }

  function resolve()
  {
      $method = $this->getMethod($this->request);
      if(is_null($method))
      {
          $this->defaultRequestHandler();
          return;
      }
      
      echo call_user_func_array($method, array($this->request));

  }



  private function getMethod($request)
    {
        $supportedHttpMethods = $this->{strtolower($request->requestMethod)};
        $formattedRoute = $this->formatRoute(strtok($request->requestUri, "?"));
        $regexedFiendlyRoute = preg_quote($formattedRoute, "/");
        $regex = "/($regexedFiendlyRoute)(\/)?(\?((.*=.*)(&?))+)?/";
        $method = null;
        foreach ($supportedHttpMethods as $k => $v) {
            if (preg_match($regex, $k)) {
                $method = $v;
                break;
            }
        }
        return $method;
    }






  function __destruct()
  {
    $this->resolve();
  }
}