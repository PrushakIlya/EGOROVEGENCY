<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="app.css">
  <title>Document</title>
</head>
<body>
  <?php $_SERVER['REQUEST_URI']==='/' && include('../resources/views/registration.php')?>
  <?php $_SERVER['REQUEST_URI']==='/game' && include('../resources/views/game.php') ?>
  <?php $_SERVER['REQUEST_URI']==='/autorization' && include('../resources/views/autorization.php') ?>
  <?php $_SERVER['REQUEST_URI']==='/createGuild' && include('../resources/views/guild.php') ?>
  <script src="js/app.js" defer></script>
</body>
</html>
