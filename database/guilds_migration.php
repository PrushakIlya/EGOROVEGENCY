<?php

$sql = "CREATE TABLE guilds (id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(20) UNIQUE NOT NULL,
parent INTEGER UNSIGNED, date TIMESTAMP NOT NULL)";

return $sql;
