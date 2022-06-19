<?php

namespace Prushak\EgorovEgency\HTTP\Models;

use PDO;

class GuildUsersModel
{

  private $conn;

  public function __construct()
  {
    $this->conn = include '../config/connect_db.php';
  }

  public function get_guild_level()
  {
    $sql = "SELECT guilds.id,guilds.parent, SUM(users.level) as level,guilds.name
            FROM users
            JOIN guild_users
              ON users.id = guild_users.user_id
            JOIN guilds
              ON guilds.id = guild_users.guild_id
            GROUP BY guilds.name ORDER BY level DESC LIMIT 5";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function get_guild_level_all()
  {
    $sql = "SELECT guilds.id, SUM(users.level) as level,guilds.name
            FROM users
            JOIN guild_users
              ON users.id = guild_users.user_id
            JOIN guilds
              ON guilds.id = guild_users.guild_id 
            GROUP BY guilds.name";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function show($id)
  {
    $sql = "SELECT guilds.name
    FROM users
    JOIN guild_users
      ON users.id = guild_users.user_id
    JOIN guilds
      ON guilds.id = guild_users.guild_id
    WHERE users.id = '{$id}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function insert($user_id, $guild_id)
  {
    $sql = "INSERT INTO guild_users (user_id,guild_id) VALUES (:user_id,:guild_id)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(":user_id" => $user_id, ":guild_id" => $guild_id));
  }
  public function get_users_in_guild($id)
  {
    $sql = "SELECT users.name,users.id,guilds.id as guild
            FROM users
            JOIN guild_users
              ON users.id = guild_users.user_id
            JOIN guilds
              ON guilds.id = guild_users.guild_id 
            WHERE guilds.id = '{$id}'";
    $stmt = $this->conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }


}
