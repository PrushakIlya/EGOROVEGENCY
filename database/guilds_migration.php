<?php

$sql = "CREATE TABLE guilds (id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(20) UNIQUE NOT NULL, parrent INTEGER UNSIGNED,user_id INTEGER UNSIGNED, FOREIGN KEY (user_id) REFERENCES guilds(id), date TIMESTAMP NOT NULL)";

return $sql;