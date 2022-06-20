<?php

return [
  '/acceptInvite' => 'invitations/accept_invite', //api
  '/invitations' => 'invitations/invitations', //api

  '/checkInvitations' => 'management/check_invitations', //api
  '/sendInvitation' => 'management/send_invitation', //api
  '/inGuild' => 'management/in_guild', //api
  '/managementGuild' => 'management/index_management',

  '/results' => 'result/results', //api
  
  '/gameBot' => 'gamebot/game_bot', //api

  '/getInfo/([0-9]+)' => 'front/get_info/$1', //api
  '/getTopUsers' => 'front/get_top_users', //api
  '/checkLeader' => 'front/check_leader', //api
  '/getTopGuilds' => 'guild/general_level', //api
  '/parrent' => 'guild/parrent', //api
  '/guilds' => 'guild/index', //api
  '/takeGuild' => 'guild/take_guild', //api
  '/checkParent' => 'guild/check_parent', //api
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
