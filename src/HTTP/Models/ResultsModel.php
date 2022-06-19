<?php

namespace Prushak\EgorovEgency\HTTP\Models;

use PDO;

class ResultsModel
{
  private $conn;

  public function __construct()
  {
    $this->conn = include '../config/connect_db.php';
  }

  public function insert_results($results){
    $sql = "INSERT INTO results (result, user_id) VALUES (:result, :user_id)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(":result" => $results,":user_id" => $_COOKIE['autorized']));
  }
}
