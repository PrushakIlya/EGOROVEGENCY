<?php
function guild_users_fake($db_connect){
  $guild_id = [1, 2, 3, 3, 4, 5, 6, 3, 7, 4];
  for ($i=0;$i<10;$i++) {
    $sql = "INSERT INTO guild_users (user_id,guild_id) VALUES (:user_id,:guild_id)";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute(array(":user_id" => $i+1, ":guild_id" => $guild_id[$i]));
  }
}

