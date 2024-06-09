<?php

$_ENV = [
  'DB_USER' => 'root',
  'DB_PASSWORD' => '',
  'DB_NAME' => 'api',
  'DB_HOST' => 'localhost',
  'DB_DRIVER' => 'mysql'
];

return [
  'database' => [
    'connection' => $_ENV['DB_DRIVER'] . ':host=' . $_ENV['DB_HOST'],
    'name' => $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'options' => [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ]
  ]
];