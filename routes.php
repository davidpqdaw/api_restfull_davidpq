<?php

$routes = [
  ["pattern" => "/api/users", "method" => "GET", "action" => "UserController@index"],
  ["pattern" => "/api/users", "method" => "POST", "action" => "UserController@store"],
  ["pattern" => "/api/users/{id}", "method" => "GET", "action" => "UserController@show"],
  ["pattern" => "/api/users/{id}", "method" => "PUT", "action" => "UserController@update"],
  ["pattern" => "/api/users/{id}", "method" => "DELETE", "action" => "UserController@destroy"]
];
