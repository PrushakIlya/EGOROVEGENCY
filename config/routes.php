<?php

return [
  '/getInfo/([0-9]+)' => 'front/get_info/$1',//api
  '/getTopUsers' => 'front/get_top_users',//api
  '/managementGuild' => 'guild/index_management',
  '/checkLeader' => 'front/check_leader',//api
  '/getTopGuilds' => 'guild/get_top_guilds',//api
  '/parrent' => 'guild/parrent',//api
  '/results' => 'result/results',//api
  '/guilds' => 'guild/index',//api
  '/takeGuild' => 'guild/take_guild', //api
  '/checkParent' => 'guild/check_parent', //api
  '/gameBot' => 'gamebot/game_bot', //api
  '/storeGuild' => 'guild/store_guild',
  '/createGuild' => 'guild/create_guild',
  '/uploadFile' => 'front/upload_file',
  '/levelUp' => 'front/level_up',
  '/levelDown' => 'front/level_down',
  '/autorizationCheck' => 'front/autorization_check',
  '/autorization' => 'front/autorization',
  '/logout' => 'front/logout',
  '/checkDublicate/([a-zA-Z]+)' => 'front/check_dublicate/$1',
  '/bot' => 'front/bot',
  '/store' => 'front/store',
  '/game' => 'front/game',
  '/' => 'front/registration',
];
