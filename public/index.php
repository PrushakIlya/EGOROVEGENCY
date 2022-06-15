<?php
include_once '../vendor/autoload.php';
require_once '../routes/Web.php';

$db_connect = require_once '../config/connect_db.php';

$sql_results = require_once '../database/results_migration.php';
$sql_guilds = require_once '../database/guilds_migration.php';
$sql_users = require_once '../database/users_migration.php';

//do not forget create DATABASE egorovegency



try {
  $db_connect->exec($sql_results);
  $db_connect->exec($sql_guilds);
  $db_connect->exec($sql_users);
  echo "Table product has been created";
} catch (PDOException $e) {
}

//FAKE USERS
// $users = ["Ilya", "Nick", "Smoke", "TooMe", "Hash", "Cat", "MrDog", "Black", "White", "Sname"];
// $guild_id = [1, 4, 2, 3, 5, 2, 1, 5, 1, 1];
// foreach ($users as $id => $item) {
//   $sql = "INSERT INTO users (name,password,level,avatar,in_guild,header_guild)
//    VALUES (:name,:password,:level,:avatar,:in_guild,:header_guild)";
//   $stmt = $db_connect->prepare($sql);
//   $stmt->execute(array(
//     ":name" => $item, ":password" =>  $pass_hash = password_hash(rand(10, 15), PASSWORD_DEFAULT),
//     ":level" => rand(1, 50), ":avatar" => "avatar_defaul.svg", ":in_guild" => $guild_id[$id],
//     ":header_guild" => rand(0, 1)
//   ));
// }

//FACE GUILDS IS NOT WORKING
// $guild = ["Sky", "KillMe", "Swithers", "PhP", "TheBestRule"];
// foreach ($guild as $item) {
//   $sql = "INSERT INTO guilds (name,parrent,user_id) VALUES (:name,:parrent,:user_id)";
//   $stmt = $db_connect->prepare($sql);
//   $stmt->execute(array(":name" => $item, ":parrent" => rand(0, 5), ":user_id" => rand(1, 10)));
// }


$web = new Web();
$web->route();
