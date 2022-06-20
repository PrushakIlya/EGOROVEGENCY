<section class="guild_management-section">
  <div class="guild_management wrapper">
    <h1>Management Guild</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>LvL</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count = 1;
        foreach ($results as $result) { ?>
          <tr>
            <td><?php echo $count++ ?></td>
            <td><?php echo $result['name'] ?></td>
            <td><?php echo $result['level'] ?></td>
            <td><button type="button" class="btn" id="<?php echo 'btn_' . $result['id'] ?>" onclick="invitation(<?php echo $result['id'] ?>,<?php echo $guild ?>)">Invitation</button></td>
            <td id="<?php echo 'info_' . $result['id'] ?>"></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>
<script src="./js/management_guild.js"></script>