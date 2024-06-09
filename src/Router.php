<?php

namespace App;

use App\Request;
use App\Controllers\UserController;

class Router
{
  protected Request $request;
  protected array $routes;

  public function __construct(Request $request, array $routes)
  {
    $this->request = $request;
    $this->routes = $routes;
  }

  public function dispatch()
  {
    $uri = $this->request->uri();
    $method = $this->request->method();

    //echo "URI: $uri, Method: $method\n";

    foreach ($this->routes as $route) {
      $pattern = $route['pattern'];
      $routeMethod = $route['method'];
      $action = $route['action'];

      if ($this->matchesRoute($pattern, $uri) && $routeMethod === $method) {
        [$controller, $method] = explode('@', $action);
        $this->executeAction($controller, $method);
        return;
      }
    }

    $this->notFound();
  }

  protected function matchesRoute($pattern, $uri)
  {
    $pattern = str_replace('/', '\/', $pattern);
    $pattern = preg_replace('/\{[^\}]*\}/', '[^\/]+', $pattern);
    return preg_match("/^{$pattern}$/", $uri);
  }

  protected function executeAction($controller, $method)
  {
    $controller = "App\\Controllers\\{$controller}";
    $controllerInstance = new $controller();
    $controllerInstance->$method($this->request);
  }

  protected function notFound()
  {
    http_response_code(404);
    echo "404 - Not Found";
  }
}
