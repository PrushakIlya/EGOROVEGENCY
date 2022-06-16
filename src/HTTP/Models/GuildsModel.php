<?php

namespace Prushak\EgorovEgency\HTTP\Models;

use PDO;

class GuildsModel
{

  private $conn;

  public function __construct()
  {
    $this->conn = include '../config/connect_db.php';
  }

  public function insert_quild()
  {
    $sql = "INSERT INTO guilds (name,user_id) VALUES (:name,:user_id)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(":name" => $_POST["guild_name"], ":user_id" => $_COOKIE['autorized']));
  }

  public function get_id($name)
  {
    $sql = "SELECT id FROM guilds WHERE name='{$name}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results[0]['id'];
  }
}
