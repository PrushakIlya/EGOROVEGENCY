<?php

function users_fake($db_connect)
{
  $users = ["Dad", "Nick", "Smoke", "TooMe", "Hash", "Cat", "MrDog", "Black", "White", "Sname"];
  $guild_id = [1, 2, null, 3, 4, 5, 6, null, 7, null];
  foreach ($users as $id => $item) {
    $sql = "INSERT INTO users (name,password,level,avatar,guild_id) 
    VALUES (:name,:password,:level,:avatar,:guild_id)";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute(array(
      ":name" => $item, ":password" => password_hash(1234567890, PASSWORD_DEFAULT), ":level" => rand(1, 500),
      ":avatar" => "avatar_default.svg", ":guild_id" => $guild_id[$id]
    ));
  }
}
