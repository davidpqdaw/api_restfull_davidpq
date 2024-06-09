<?php

namespace App;

class Request
{
  protected array $uri;
  protected string $method;
  protected array $params = [];

  function __construct()
  {
    $this->uri = parse_url($_SERVER['REQUEST_URI']);
    $this->method = $_SERVER['REQUEST_METHOD'];
  }

  function uri()
  {
    return $this->uri['path'] ?? '/';
  }


  function method()
  {
    return $this->method;
  }

  function params()
  {
    return $this->params;
  }

  function setParams($params)
  {
    $this->params += $params;
  }
}