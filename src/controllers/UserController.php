<?php

namespace App\Controllers;

use App\Registry;
use App\Request;
use PDO;

class UserController
{
  // Muestra todos los usuarios
  public function index()
  {
    try {
      $users = Registry::get('database')->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($users);
    } catch (\Exception $ex) {
      echo $ex->getMessage();
    }
  }

  // Crea un usuario, con los datos enviados desde el cliente (nombre y email)
  public function store(Request $request)
  {
    try {
      if (strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
      } else {
        $data = $_POST;
      }
      if (!isset($data['name']) || !isset($data['email'])) {
        throw new \Exception("Name y email son necesarios.");
      }

      $stmt = Registry::get('database')->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
      $stmt->bindValue(':name', $data['name']);
      $stmt->bindValue(':email', $data['email']);
      $stmt->execute();

      echo "Usuario creado correctamente!";
    } catch (\Exception $ex) {
      echo $ex->getMessage();
    }
  }


  // Muestra un usuario, por su id
  public function show(Request $request)
  {
    try {
      $uri = $request->uri();
      $id = intval(substr($uri, strrpos($uri, '/') + 1));

      $stmt = Registry::get('database')->prepare('SELECT * FROM users WHERE id = :id');
      $stmt->execute(['id' => $id]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$user) {
        throw new \Exception("Usuario con id: $id no encontrado.");
      }

      echo json_encode($user);
    } catch (\Exception $ex) {
      echo $ex->getMessage();
    }
  }

  // Actualiza un usuario, por su id
  public function update(Request $request)
  {
      try {
          $uri = $request->uri();
          $id = intval(substr($uri, strrpos($uri, '/') + 1));
  
          $input = file_get_contents('php://input');
  
          if (strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
              $data = json_decode($input, true);
          } else {
              parse_str($input, $data);
          }
  
          if (!isset($data['name']) || !isset($data['email'])) {
              throw new \Exception("Name and email are required fields.");
          }
  
          $stmt = Registry::get('database')->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
          $stmt->bindValue(':name', $data['name']);
          $stmt->bindValue(':email', $data['email']);
          $stmt->bindValue(':id', $id);
          $stmt->execute();
  
          echo "Usuario actualizado correctamente!";
      } catch (\Exception $ex) {
          echo $ex->getMessage();
      }
  }  

  // Elimina un usuario, por su id
  public function destroy(Request $request)
  {
    try {
      $uri = $request->uri();
      $id = intval(substr($uri, strrpos($uri, '/') + 1)); 

      $stmt = Registry::get('database')->prepare('DELETE FROM users WHERE id = :id');
      $stmt->execute(['id' => $id]);

      echo "Usuario eliminado correctamente!";
    } catch (\Exception $ex) {
      echo $ex->getMessage();
    }
  }
}
