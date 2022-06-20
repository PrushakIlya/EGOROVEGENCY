<?php
include_once '../vendor/autoload.php';
include_once '../routes/Web.php';

$db_connect = include_once '../config/connect_db.php';

$sql_users = include_once '../database/users_migration.php';
$sql_results = include_once '../database/results_migration.php';
$sql_guilds = include_once '../database/guilds_migration.php';
$sql_guild_users = include_once '../database/guild_users_migration.php';
$sql_invitations = include_once '../database/invitations.php';

include_once '../database/fake/results_fake.php';
include_once '../database/fake/users_fake.php';
include_once '../database/fake/guilds_fake.php';
include_once '../database/fake/guild_users_fake.php';

//do not forget create DATABASE egorovegency

try {
  $db_connect->exec($sql_guilds);
  $db_connect->exec($sql_users);
  $db_connect->exec($sql_results);
  $db_connect->exec($sql_guild_users);
  $db_connect->exec($sql_invitations);

  guilds_fake($db_connect);
  users_fake($db_connect);
  results_fake($db_connect);
  guild_users_fake($db_connect);

  echo "Table product has been created";
} catch (PDOException $e) {
  // echo $e;
}

$web = new Web();
$web->route();
