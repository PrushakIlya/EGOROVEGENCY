<section class="guild-section">
  <div class="guild wrapper">
    <h1>CREATE GUILD!!!!!!!</h1>
    <form action="/storeGuild" method="POST" name="create_guild">
      <label for="guild_name"></label>
      <div class="errors" id="guild_errors"></div>
      <input type="text" name="guild_name" id="guild_name">
      <input type="submit" value="create" id="form_btn">
    </form>
  </div>
</section>
<script src="js/guild.js" defer></script>