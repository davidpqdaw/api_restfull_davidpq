<?php

namespace App;

class Registry
{
  protected static array $registry = [];

  public static function set($key, $value)
  {
    static::$registry[$key] = $value;
  }

  public static function get($key)
  {
    if (!array_key_exists($key, static::$registry)) {
      throw new \Exception("No {$key} is bound in the container.");
    }

    return static::$registry[$key];
  }
}