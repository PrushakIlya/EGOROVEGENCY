<section class="game-section">
  <div class="game wrapper">
    <div class="game_header">
      <h1>Progress</h1>
      <div class="progress">
        <div id="progress_start" class="line"></div>
        <div id="progress_middle" class="line"></div>
        <div id="progress_end" class="line"></div>
      </div>
    </div>
    <div class="game_body">
      <div class="game_area">
        <div class="game_block">
          <?php for ($i = 0; $i < 9; $i++) { ?>
            <div class="cell" id="<?php echo $i ?>" onclick="move(<?php echo $i ?>)"></div>
          <?php } ?>
        </div>
        <form action="/uploadFile" method="POST" enctype="multipart/form-data" id="upload_form" class="upload_form">
          <input type="file" name="avatar">
          <input type="submit" value="Upload Avatar" id="upload_avatar" class="upload_avatar btn">
        </form>
        <a href="/createGuild" id="create_guild" class="create_guild btn">Create Guild</a>
        <div id="link_results"></div>
      </div>
      <div class="game_body-info">
        <div class="game_info-avatar" style="background-image: url(avatars/<?php echo $account['avatar'] ?>)"></div>
        <div class="game_info-account">
          <p class="account_name" id="account_name"><?php echo $account['name'] ?></p>
          <p class="account_level"><span id="account_level"><?php echo $account['level'] ?></span>lvl</p>
          <a href="/logout" class="logout btn">logout</a>
        </div>
      </div>
      <div>
        <?php include '../resources/views/top_guilds.php' ?>
        <?php include '../resources/views/top_users.php' ?>
      </div>
      <?php include '../resources/views/popap.php' ?>
    </div>
  </div>
</section>