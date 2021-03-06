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

  public function insert_guild($parrent)
  {
    $sql = "INSERT INTO guilds (name,parent) VALUES (:name,:parent)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(":name" => $_POST["guild_name"],":parent" => $parrent));
  }

  public function get_id($name)
  {
    $sql = "SELECT id FROM guilds WHERE name='{$name}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function select_all()
  {
    $sql = "SELECT * FROM guilds";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function get_by_id($id){
    $sql = "SELECT id,name,parent FROM guilds WHERE id='{$id}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function get_name($id){
    $sql = "SELECT name FROM guilds WHERE id='{$id}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }
}
