<section class="show_user-section">
  <div class="show_user wrapper">
    <div style="background-image: url(/avatars/<?php echo $user[0]['avatar'] ?>)" class="img"></div>
    <div class="lvl"><?php echo $user[0]['level'] ?></div>
      <?php if($guild){?>
      <p>Leader: <?php echo $guild[0]['name']?></p>
      <?php }else{?>
        <p>Leader: -------- </p>
      <?php }?>
      
    <div class="in_guild">
      <h2>In Guilds</h2>

      <?php if ($in_guilds){
        foreach ($in_guilds as $guild) { ?>
        <p><?php echo $guild['name'] ?></p>
      <?php }
      }else {?> <p>--------</p><?php }?>
    </div>
    <a href="/game" class="btn">Back</a>
  </div>
</section>
<script src="js/guild.js" defer></script>