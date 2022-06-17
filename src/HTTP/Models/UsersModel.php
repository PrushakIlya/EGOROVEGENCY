<?php

namespace Prushak\EgorovEgency\HTTP\Models;

use PDO;

class UsersModel
{
  private $conn;

  public function __construct()
  {
    $this->conn = include '../config/connect_db.php';
  }

  public function insert()
  {
    $sql = "INSERT INTO users (name, password, level, avatar) VALUES (:username, :password, :level, :avatar)";
    $stmt = $this->conn->prepare($sql);
    $pass_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stmt->execute(array(":username" => $_POST["name"], ":password" => $pass_hash, ":level" => 1, ":avatar" => 'avatar_default.svg'));
  }

  public function get_name_level_avatar($id)
  {
    $sql = "SELECT name,level,avatar FROM users WHERE id='{$id}'";
    return $this->query($sql);
  }

  public function autorization_check()
  {
    $sql = "SELECT id,name,password FROM users WHERE name='{$_POST['name']}'";
    return $this->query($sql);
  }

  public function update_avatar($name_file)
  {
    $sql = "UPDATE users SET avatar = '{$name_file}'  WHERE id = '{$_COOKIE['autorized']}'";
    $this->conn->query($sql);
  }

  public function update_level($operator)
  {
    $level = $this->get_name_level_avatar($_COOKIE['autorized'])['level'];
    switch ($operator) {
      case '-':$sql = "UPDATE users SET level = $level-1 WHERE id = '{$_COOKIE['autorized']}'";break;
      case '+':$sql = "UPDATE users SET level = $level+1 WHERE id = '{$_COOKIE['autorized']}'";break;
    }
    $this->conn->query($sql);
  }

  public function update_guild($guild_id)
  {
    $sql = "UPDATE users SET in_guild = $guild_id, header_guild=1 WHERE id = '{$_COOKIE['autorized']}'";
    $this->conn->query($sql);
  }

  public function get_user_name()
  {
    $sql = "SELECT name FROM users";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  //API
  public function get_id($name)
  {
    $sql = "SELECT id FROM users WHERE name='{$name}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($results[0]['id']);
  }

  private function query($sql)
  {
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results[0];
  }
}
