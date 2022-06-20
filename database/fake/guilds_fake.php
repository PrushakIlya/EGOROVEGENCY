<?php
function guilds_fake($db_connect)
{
  $guilds = ["Sky", "KillMe", "Swithers", "PhP", "TheBestRule", "Testic", "Egency"];
  $parent = [2, null, 5, 1, null, 0, 1, null, null, null];
  foreach ($guilds as $id => $guild) {
    $sql = "INSERT INTO guilds (name,parent) VALUES (:name,:parent)";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute(array(":name" => $guild, ":parent" => $parent[$id]));
  }
}
