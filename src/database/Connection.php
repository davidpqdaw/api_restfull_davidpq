<?php

namespace App\Database;

class Connection {
  protected $connection;

  public function __construct($config) {
    $this->connection = new \PDO(
      $config['connection'].';dbname='.$config['name'],
      $config['username'],
      $config['password'],
      $config['options']
    );
  }

  public function getConnection() {
    return $this->connection;
  }
}