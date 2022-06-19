<section class="guild-section">
  <div class="guild wrapper">
    <h1>CREATE GUILD!!!!!!!</h1>
    <form action="/storeGuild" method="POST" name="create_guild" id="create_guild">

      <div class="errors" id="guild-errors_name"></div>
      <div>
        <label for="guild_name">Name</label>
        <input type="text" name="guild_name" id="guild_name">
      </div>

      <div class="errors" id="guild-errors_parent"></div>
      <div>
        <label for="guild_parent">Parent</label>
        <input type="text" name="guild_parent" id="guild_parent">
      </div>

      <input type="submit" value="create" id="form_btn">
      <a href="/game" class="btn">BACK</a>
    </form>
    <table>
      <thead>
        <tr>
          <th class="id">ID</th>
          <th>Name</th>
        </tr>
      </thead>
      <?php
      $count = 0;
      foreach ($results as $item) {
      ?>
        <tbody>
          <tr>
            <td><?php echo ++$count ?></td>
            <td><?php echo $item['name'] ?></td>
          </tr>
        </tbody>
      <?php  }
      ?>
    </table>
  </div>
</section>
<script src="js/guild.js" defer></script>