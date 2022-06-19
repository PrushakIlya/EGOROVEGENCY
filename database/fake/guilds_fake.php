<?php
function guilds_fake($db_connect){
  $guilds = ["Sky", "KillMe", "Swithers", "PhP", "TheBestRule","Testic","Egency"];
  $parrent = [2, null , 5, 1, null, 0 ,1, null, null ,null];
  foreach ($guilds as $id=>$guild) {
    $sql = "INSERT INTO guilds (name,parrent) VALUES (:name,:parrent)";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute(array(":name" => $guild, ":parrent" => $parrent[$id]));
  }
}

