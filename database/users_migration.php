<?php

$sql = "CREATE TABLE users (id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(20) UNIQUE NOT NULL, password VARCHAR(60) NOT NULL, 
level INTEGER UNSIGNED NOT NULL,avatar VARCHAR(30) NOT NULL,
guild_id INTEGER UNSIGNED,FOREIGN KEY (guild_id) REFERENCES guilds(id), 
date TIMESTAMP NOT NULL)";

return $sql;
