<?php

$sql = "CREATE TABLE guild_users (user_id INTEGER UNSIGNED NOT NULL,FOREIGN KEY (user_id) REFERENCES users(id), guild_id INTEGER UNSIGNED NOT NULL,FOREIGN KEY (guild_id) REFERENCES guilds(id) , date TIMESTAMP NOT NULL)";

return $sql;
