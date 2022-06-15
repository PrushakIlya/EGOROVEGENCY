<?php
$db_connect = include_once '../config/connect_db.php';
$guild = ["Sky", "KillMe", "Swithers", "PhP", "TheBestRule"];
foreach ($guild as $item) {
  $sql = "INSERT INTO guilds (name,parrent,user_id) VALUES (:name,:parrent,:user_id)";
  $stmt = $db_connect->prepare($sql);
  $stmt->execute(array(":name" => $item, ":parrent" => rand(0, 5), ":user_id" => rand(1, 10)));
}
