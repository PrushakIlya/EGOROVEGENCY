<?php

namespace Prushak\EgorovEgency\HTTP\Models;

use PDO;

class InvitationsModel
{

  private $conn;

  public function __construct()
  {
    $this->conn = include '../config/connect_db.php';
  }

  public function insert($user_id, $guild_id)
  {
    $sql = "INSERT INTO invitations (user_id,guild_id) VALUES (:user_id,:guild_id)";
    $stmt = $this->conn->prepare($sql);
    $respons = $stmt->execute(array(":user_id" => $user_id, ":guild_id" => $guild_id));
    return $respons;
  }

  public function index()
  {
    $sql = "SELECT * FROM invitations";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }
}
