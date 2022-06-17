<?php
function guilds_fake($db_connect){
  $guild = ["Sky", "KillMe", "Swithers", "PhP", "TheBestRule","Testic","Egency","Minsk"];
  foreach ($guild as $item) {
    $sql = "INSERT INTO guilds (name,parrent,user_id) VALUES (:name,:parrent,:user_id)";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute(array(":name" => $item, ":parrent" => rand(0, 5), ":user_id" => rand(41, 50)));
  }
}

