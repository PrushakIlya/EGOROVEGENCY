<?php
include_once '../vendor/autoload.php';
include_once '../routes/Web.php';

$db_connect = include_once '../config/connect_db.php';

$sql_users = include_once '../database/users_migration.php';
$sql_results = include_once '../database/results_migration.php';
$sql_guilds = include_once '../database/guilds_migration.php';

//do not forget create DATABASE egorovegency

$tt = require_once('../database/fake/users_fake.php');

try {
  $db_connect->exec($sql_results);
  $db_connect->exec($sql_users);
  $db_connect->exec($sql_guilds);
  echo "Table product has been created";
} catch (PDOException $e) {

}

//FAKE USERS
// include_once '../database/fake/users_fake.php';
// users_fake($db_connect);

//FAKE GUILDS
// include_once '../database/fake/guilds_fake.php';
// guilds_fake($db_connect);

$web = new Web();
$web->route();
