<?php

function users_fake($db_connect)
{
  $users = ["Dad", "Nick", "Smoke", "TooMe", "Hash", "Cat", "MrDog", "Black", "White", "Sname"];
  $guild_id = [1, 4, 2, 3, 5, 2, 1, 5, 1, 1];
  foreach ($users as $id => $item) {
    $sql = "INSERT INTO users (name,password,level,avatar,in_guild,header_guild)
     VALUES (:name,:password,:level,:avatar,:in_guild,:header_guild)";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute(array(
      ":name" => $item, ":password" =>  $pass_hash = password_hash(rand(10, 15), PASSWORD_DEFAULT),
      ":level" => rand(1, 50), ":avatar" => "avatar_defaul.svg", ":in_guild" => $guild_id[$id],
      ":header_guild" => rand(0, 1)
    ));
  }
}
