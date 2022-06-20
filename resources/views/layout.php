<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/app.css">
  <title>Document</title>
</head>

<body>
  <div class="background" style="background-image: url(./img/background.jpg)">
    <?php $_SERVER['REQUEST_URI'] === '/' && include('../resources/views/registration.php') ?>
    <?php $_SERVER['REQUEST_URI'] === '/game' && include('../resources/views/game.php') ?>
    <?php $_SERVER['REQUEST_URI'] === '/autorization' && include('../resources/views/autorization.php') ?>
    <?php $_SERVER['REQUEST_URI'] === '/createGuild' && include('../resources/views/guilds.php') ?>
    <?php $_SERVER['REQUEST_URI'] === '/managementGuild' && include('../resources/views/management_guild.php') ?>
    <?php preg_match('~/getInfo/([0-9]+)~', $_SERVER['REQUEST_URI']) && include('../resources/views/show_user.php') ?>
    <script src="./js/app.js" defer></script>
  </div>

</body>

</html>