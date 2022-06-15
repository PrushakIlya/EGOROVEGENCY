<?php

namespace Prushak\EgorovEgency\HTTP\Controller;

use PDO;

class FrontController extends BaseController
{
  private $conn;

  public function __construct()
  {
    $this->conn = include '../config/connect_db.php';
  }

  public function logout()
  {
    setcookie('autorized', '', time() - 1);
    return header('Location:/');
  }

  public function registration()
  {
    if ($_COOKIE && $_COOKIE['autorized']) return header('Location:/game');
    include '../resources/views/layout.php';
  }

  public function create_guild()
  {
    include '../resources/views/layout.php';
  }

  public function store()
  {
    $sql = "INSERT INTO users (name, password, level, avatar) VALUES (:username, :password, :level, :avatar)";
    $stmt = $this->conn->prepare($sql);
    $pass_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stmt->execute(array(":username" => $_POST["name"], ":password" => $pass_hash, ":level" => 1, ":avatar" => 'avatar_default.svg'));
    $id = $this->getIdbyName($_POST["name"]);
    setcookie('autorized', $id, time() + 86400 * 5, '/');
    return header('Location:/game');
  }

  private function getIdbyName($name)
  {
    $sql = "SELECT id FROM users WHERE name='{$name}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($results[0]['id']);
  }

  private function getNameLevelAvatarById($id)
  {
    $sql = "SELECT name,level,avatar FROM users WHERE id='{$id}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results[0];
  }

  public function game()
  {
    if (empty($_COOKIE)) {
      return header('Location:/');
    }
    $account = $this->getNameLevelAvatarById($_COOKIE['autorized']);
    include '../resources/views/layout.php';
  }

  public function autorization()
  {
    if (!empty($_COOKIE)) {
      return header('Location:/game');
    }
    include '../resources/views/layout.php';
  }

  public function autorization_check()
  {
    $sql = "SELECT id,name,password FROM users WHERE name='{$_POST['name']}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results && password_verify($_POST['password'], $results[0]['password'])) {
      setcookie('autorized', $results[0]['id'], time() + 86400 * 5, '/');
      return header('Location:/game');
    }
    return header('Location:/autorization');
  }

  public function upload_file()
  {
    if ($_FILES['avatar']['name'] != '') {
      switch ($_FILES['avatar']['type']) {
        case 'image/png':
          $name_file = uniqid('avatar_') . '.png';
          break;
        case 'image/jpeg':
          $name_file = uniqid('avatar_') . '.jpeg';
          break;
        case 'image/svg+xml':
          $name_file = uniqid('avatar_') . '.svg';
          break;
        default:
          return header('Location:/game');
      }
    }
    move_uploaded_file($_FILES['avatar']['tmp_name'], ($_SERVER['DOCUMENT_ROOT'] . "/avatars/$name_file"));
    $sql = "UPDATE users SET avatar = '{$name_file}'  WHERE id = '{$_COOKIE['autorized']}'";
    $this->conn->exec($sql);
    return header('Location:/game');
  }


  public function store_guild()
  {
    $sql = "INSERT INTO guilds (name,user_id) VALUES (:name,:user_id)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(":name" => $_POST["guild_name"], ":user_id" => $_COOKIE['autorized']));
    return header('Location:/game');
  }

  //API
  public function game_result()
  {
    $level_db = $this->getNameLevelAvatarById($_COOKIE['autorized'])['level'];
    $sql = "UPDATE users SET level = $level_db+1 WHERE id = '{$_COOKIE['autorized']}'";
    $this->conn->exec($sql);
  }
  //API
  public function checkDublicate($name)
  {
    $sql = "SELECT name FROM users";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $item) {
      if ($name === $item['name']) return json_encode(false);
    }
    return json_encode(true);
  }
}
