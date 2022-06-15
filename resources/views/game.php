<section class="game-section">
  <div class="game wrapper">
    <div class="game_account">
      <div class="game_account-avatar" style="background-image: url(avatars/<?php echo $account['avatar'] ?>)"></div>
      <div class="game_account-info">
        <p class="account_level"><span id="account_level"><?php echo $account['level'] ?></span>lvl</p>
        <p class="account_name" id="account_name"><?php echo $account['name'] ?></p>
        <a href="/logout" class="logout btn">logout</a>
      </div>
    </div>
    <h1>Progress</h1>
    <div class="progress">
      <div id="progress_start" class="line"></div>
      <div id="progress_middle" class="line"></div>
      <div id="progress_end" class="line"></div>
    </div>
    <div class="game-block">
      <div class="cell" id="0" onclick="move(0)"></div>
      <div class="cell" id="1" onclick="move(1)"></div>
      <div class="cell" id="2" onclick="move(2)"></div>
      <div class="cell" id="3" onclick="move(3)"></div>
      <div class="cell" id="4" onclick="move(4)"></div>
      <div class="cell" id="5" onclick="move(5)"></div>
      <div class="cell" id="6" onclick="move(6)"></div>
      <div class="cell" id="7" onclick="move(7)"></div>
      <div class="cell" id="8" onclick="move(8)"></div>
    </div>
    <form action="/uploadFile" method="POST" enctype="multipart/form-data" name="upload_form" hidden="true" id="upload_avatar" class="upload_avatar">
      <input type="file" name="avatar">
      <input type="submit" value="Upload Avatar" id="upload_avatar" class="btn">
    </form>
      <a href="/createGuild" class="create_guild btn" id="create_guild">Create Guild</a>
  </div>
</section>