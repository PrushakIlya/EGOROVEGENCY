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
  private $arr = [];
  private $nesting = [];
  private $sum_levels = [];
  private $name;

  public function __construct()
  {
    $this->guildsModel = new GuildsModel();
    $this->usersModel = new UsersModel();
    $this->guildUsersModel = new GuildUsersModel();
  }
  public function parrent()
  {
    $data = json_decode(file_get_contents('php://input'), true);
    return json_encode($this->guildsModel->get_by_id($data));
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
    $this->guildUsersModel->insert($_COOKIE['autorized'], $guild_id);
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

  public function general_level()
  {
    $finish = [];
    $results = $this->guildsModel->select_all();
    foreach ($results as $result) {
      $this->name = $result['name'];
      $this->check_one_circle($result);
      $this->get_sum_nesting_level();
      $this->nesting = [];
    }
    rsort($this->sum_levels);

    $this->sum_levels = array_slice($this->sum_levels, 0, 5);
    for ($i = 0; $i < count($this->sum_levels); $i++) {
      foreach($this->arr as $item){
        $item['level'] === $this->sum_levels[$i] && array_push($finish,$item);
      }
    }
    return json_encode($finish);
  }

  public function get_sum_nesting_level()
  {
    $sum_nesting_level = 0;
    $sum_levels = $this->guildUsersModel->get_guild_level_all();
    foreach ($sum_levels as $item) {
      foreach ($this->nesting as $nesting) {
        $item['id'] === $nesting && $sum_nesting_level += $item['level'];
      }
    }
    array_push($this->arr, ['name' => $this->name, 'level' => $sum_nesting_level]);
    array_push($this->sum_levels, $sum_nesting_level);
  }

  public function check_one_circle($result)
  {
    array_push($this->nesting, $result['id']);
    if ($result['parent']) {
      $guild = $this->guildsModel->get_by_id($result['parent']);
      $this->check_one_circle($guild[0]);
    }
  }
}
