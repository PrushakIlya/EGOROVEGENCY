<?php

  return [
    '/gameBot' => 'gamebot/game_bot',//api
    '/storeGuild'=>'front/store_guild',
    '/createGuild'=>'front/create_guild',
    '/uploadFile'=>'front/upload_file',
    '/levelUp'=>'front/level_up',
    '/levelDown'=>'front/level_down',
    '/autorizationCheck' => 'front/autorization_check',
    '/autorization' => 'front/autorization',
    '/logout' => 'front/logout',
    '/checkDublicate/([a-zA-Z]+)'=>'front/check_dublicate/$1',
    '/bot' => 'front/bot',
    '/store' => 'front/store',
    '/game' => 'front/game',
    '/' => 'front/registration',
  ];
