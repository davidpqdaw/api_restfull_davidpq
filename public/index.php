<?php

use App\Database\Connection;
use App\Registry;
use App\Request;
use App\Router;

require __DIR__ . '/../vendor/autoload.php';

require '../routes.php';
require '../bootstrap.php';

try {
  $request = new Request();

  $router = new Router($request, $routes);
  $router->dispatch();
} catch (\Exception $ex) {
  echo $ex->getMessage();
}