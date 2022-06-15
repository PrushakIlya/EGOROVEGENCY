<?php

$db_connect = include_once '../config/connect_db.php';
$users = ["Ilya", "Nick", "Smoke", "TooMe", "Hash", "Cat", "MrDog", "Black", "White", "Sname"];
foreach ($users as $id => $item) {
  $sql = "INSERT INTO users (name,password,level,avatar,in_guild,header_guild)
   VALUES (:name,:password,:level,:avatar,:in_guild,:header_guild)";
  $stmt = $db_connect->prepare($sql);
  $stmt->execute(array(
    ":name" => $item, ":password" =>  $pass_hash = password_hash(rand(10, 15), PASSWORD_DEFAULT),
    ":level" => rand(1, 50), ":avatar" => "avatar_defaul.svg", ":in_guild" => rand(0, 5),
    ":header_guild" => rand(0, 1)
  ));
}
