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
    $stmt->execute(array(":user_id" => $user_id, ":guild_id" => $guild_id));
  }

  public function select_all()
  {
    $sql = "SELECT * FROM invitations";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }
  public function select_by_user($id)
  {
    $sql = "SELECT * FROM invitations  WHERE user_id='{$id}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function select_invitations($id){
    $sql = "SELECT guilds.id,guilds.name,invitations.user_id
    FROM invitations
    JOIN guilds
    ON invitations.guild_id = guilds.id
    WHERE invitations.user_id = '{$id}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function delete($id)
  {
    $sql = "DELETE FROM invitations WHERE id = :user_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":user_id", $id);
    $stmt->execute();
  }
}
