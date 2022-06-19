<?php

namespace Prushak\EgorovEgency\HTTP\Controller;

use PDO;
use Prushak\EgorovEgency\HTTP\Models\UsersModel;
use Prushak\EgorovEgency\HTTP\Models\GuildUsersModel;
use Prushak\EgorovEgency\HTTP\Models\GuildsModel;
use Prushak\EgorovEgency\HTTP\Models\InvitationsModel;

class ManagementController extends BaseController
{
  private $usersModel;
  private $guildUsersModel;
  private $guildsModel;
  private $invitationsModel;

  public function __construct()
  {
    $this->usersModel = new UsersModel();
    $this->guildUsersModel = new GuildUsersModel();
    $this->guildsModel = new GuildsModel();
    $this->invitationsModel = new InvitationsModel();
  }

  public function index_management()
  {
    $guild = $this->usersModel->get_guild_id($_COOKIE['autorized'])[0]['guild_id'];
    $results = $this->usersModel->index();
    include '../resources/views/layout.php';
  }

  public function in_guild()
  {
    $guild = $this->usersModel->get_guild_id($_COOKIE['autorized'])[0]['guild_id'];
    $list_users_in_guild = $this->guildUsersModel->get_users_in_guild($guild);
    return json_encode($list_users_in_guild);
  }

  public function send_invitation(){
    $data = json_decode(file_get_contents('php://input'), true);
    $response =$this->invitationsModel->insert($data['user_id'],$data['guild_id']);
    return json_encode($response);
  }

  public function check_invitations(){
    $results = $this->invitationsModel->index();
    return json_encode($results);
  }
}
