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
    $sql = "INSERT INTO users (name, password, level, avatar,guild_id) VALUES (:username, :password, :level, :avatar,:guild_id)";
    $stmt = $this->conn->prepare($sql);
    $pass_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stmt->execute(array(
      ":username" => $_POST["name"], ":password" => $pass_hash, ":level" => 1,
      ":avatar" => 'avatar_default.svg',":guild_id"=> NULL
    ));
  }

  public function get_name_level_avatar($id)
  {
    $sql = "SELECT name,level,avatar FROM users WHERE id='{$id}'";
    return $this->query_custom($sql);
  }

  public function autorization_check($name)
  {
    $sql = "SELECT id,name,password FROM users WHERE name='{$name}'";
    return $this->query_custom($sql);
  }

  public function update_avatar($name_file)
  {
    $sql = "UPDATE users SET avatar = '{$name_file}'  WHERE id = '{$_COOKIE['autorized']}'";
    $this->conn->query($sql);
  }

  public function update_level($operator, $level)
  {
    switch ($operator) {
      case '-':
        $sql = "UPDATE users SET level = $level-1 WHERE id = '{$_COOKIE['autorized']}'";
        break;
      case '+':
        $sql = "UPDATE users SET level = $level+1 WHERE id = '{$_COOKIE['autorized']}'";
        break;
    }
    $this->conn->query($sql);
  }

  public function update_guild($guild_id)
  {
    $sql = "UPDATE users SET guild_id = $guild_id WHERE id = '{$_COOKIE['autorized']}'";
    $this->conn->query($sql);
  }

  public function get_name()
  {
    $sql = "SELECT name FROM users";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function index()
  {
    $sql = "SELECT name,level FROM users";
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

  private function query_custom($sql)
  {
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$results) return json_encode(false);
    return $results[0];
  }

  // public function get_header($user_id)
  // {
  //   $sql = "SELECT guild_header FROM users WHERE id='{$user_id}'";
  //   $stmt = $this->conn->query($sql);
  //   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //   return $results;
  // }

  public function select_top()
  {
    $sql = "SELECT id,name,level FROM users ORDER BY level DESC LIMIT 5";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function show($id)
  {
    $sql = "SELECT * FROM users WHERE id='{$id}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function header_guild($id)
  {
    $sql = "SELECT guilds.name
    FROM users
    JOIN guilds
      ON users.guild_id = guilds.id
    WHERE users.id = '{$id}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function get_guild_id(){
    $sql = "SELECT guild_id FROM users WHERE id='{$_COOKIE['autorized']}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }
}
