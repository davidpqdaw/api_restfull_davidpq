<?php

use App\Database\Connection;
use App\Registry;

require __DIR__ . '/vendor/autoload.php';

Registry::set('config', require 'config.php');
$connection = new Connection(
  Registry::get('config')['database']
);
Registry::set('database', $connection->getConnection());
