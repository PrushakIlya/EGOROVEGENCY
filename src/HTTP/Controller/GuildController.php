<?php

namespace Prushak\EgorovEgency\HTTP\Controller;

use PDO;
use Prushak\EgorovEgency\HTTP\Models\GuildsModel;
use Prushak\EgorovEgency\HTTP\Models\UsersModel;
use Prushak\EgorovEgency\HTTP\Models\GuildUsersModel;

class GuildController extends BaseController
{
  private $usersModel;
  private $guildsModel;
  private $guildUsersModel;

  public function __construct()
  {
    $this->guildsModel = new GuildsModel();
    $this->usersModel = new UsersModel();
    $this->guildUsersModel = new GuildUsersModel();
  }
  public function parrent()
  {
    $data = json_decode(file_get_contents('php://input'), true);
    return json_encode($this->guildsModel->get_parrent($data));
  }
  public function index()
  {

    return json_encode($this->guildsModel->select_all());
  }

  public function create_guild()
  {
    if (!$_COOKIE && !$_COOKIE['autorized']) return header('Location:/');
    $results = $this->guildsModel->select_all();
    include '../resources/views/layout.php';
  }

  public function store_guild()
  {
    if (!$_COOKIE && !$_COOKIE['autorized']) return header('Location:/');
    $parrent_id = $this->guildsModel->get_id($_POST["guild_parent"])[0]['id'];
    $parrent_id ? $this->guildsModel->insert_guild($parrent_id) : $this->guildsModel->insert_guild(NULL);
    $guild_id = $this->guildsModel->get_id($_POST["guild_name"])[0]['id'];
    $this->guildUsersModel->insert($_COOKIE['autorized'],$guild_id);
    $this->usersModel->update_guild($guild_id);
    return header('Location:/game');
  }

  //API
  public function check_parent()
  {
    $data = json_decode(file_get_contents('php://input'), true);
    if (count($this->guildsModel->get_id($data)) > 0) return json_encode(true);
    return json_encode(false);
  }

  //API
  public function get_top_guilds()
  {
    return json_encode($this->guildUsersModel->get_guild_level());
  }

  public function index_management()
  {
    $results = $this->usersModel->index();
    include '../resources/views/layout.php';
  }
}
