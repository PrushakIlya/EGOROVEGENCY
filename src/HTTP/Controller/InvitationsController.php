<?php

namespace Prushak\EgorovEgency\HTTP\Controller;

use PDO;
use Prushak\EgorovEgency\HTTP\Models\UsersModel;
use Prushak\EgorovEgency\HTTP\Models\GuildUsersModel;
use Prushak\EgorovEgency\HTTP\Models\GuildsModel;
use Prushak\EgorovEgency\HTTP\Models\InvitationsModel;

class InvitationsController extends BaseController
{
  private $guildUsersModel;
  private $invitationsModel;

  public function __construct()
  {
    $this->guildUsersModel = new GuildUsersModel();
    $this->invitationsModel = new InvitationsModel();
  }

  public function invitations()
  {
    $results = $this->invitationsModel->select_invitations($_COOKIE['autorized']);
    return json_encode($results);
  }

  public function accept_invite()
  {
    $data = json_decode(file_get_contents('php://input'), true);
    $this->guildUsersModel->insert($data['guild_id'], $data['user_id']);
    $this->invitationsModel->delete($data['user_id']);
  }
}
