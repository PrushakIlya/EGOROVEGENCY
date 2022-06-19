<?php

namespace Prushak\EgorovEgency\HTTP\Controller;

use PDO;
use Prushak\EgorovEgency\HTTP\Models\UsersModel;
use Prushak\EgorovEgency\HTTP\Models\GuildUsersModel;
use Prushak\EgorovEgency\HTTP\Models\GuildsModel;

class FrontController extends BaseController
{
  private $usersModel;
  private $guildUsersModel;
  private $guildsModel;

  public function __construct()
  {
    $this->usersModel = new UsersModel();
    $this->guildUsersModel = new GuildUsersModel();
    $this->guildsModel = new guildsModel();
  }

  public function logout()
  {
    setcookie('autorized', '', time() - 1);
    return header('Location:/');
  }

  public function registration()
  {
    if ($_COOKIE && $_COOKIE['autorized']) return header('Location:/game');
    include '../resources/views/layout.php';
  }

  public function store()
  {
    $this->usersModel->insert();
    $id = $this->usersModel->get_id($_POST["name"]);
    setcookie('autorized', $id, time() + 86400 * 5, '/');
    return header('Location:/game');
  }

  public function game()
  {
    if (empty($_COOKIE)) {
      return header('Location:/');
    }
    $account = $this->usersModel->get_name_level_avatar($_COOKIE['autorized']);
    include '../resources/views/layout.php';
  }

  public function autorization()
  {
    if (!empty($_COOKIE)) {
      return header('Location:/game');
    }
    include '../resources/views/layout.php';
  }

  public function autorization_check()
  {
    $data = json_decode(file_get_contents('php://input'), true);
    $results = $this->usersModel->autorization_check($data[0]);

    if ($results != 'false' && password_verify($data[1], $results['password'])) {
      setcookie('autorized', $results['id'], time() + 86400 * 5, '/');
      return json_encode(true);
    }
    return json_encode(false);
  }

  public function upload_file()
  {
    if ($_FILES['avatar']['name'] != '') {
      switch ($_FILES['avatar']['type']) {
        case 'image/png':
          $name_file = uniqid('avatar_') . '.png';
          break;
        case 'image/jpeg':
          $name_file = uniqid('avatar_') . '.jpeg';
          break;
        case 'image/svg+xml':
          $name_file = uniqid('avatar_') . '.svg';
          break;
        default:
          return header('Location:/game');
      }
      move_uploaded_file($_FILES['avatar']['tmp_name'], ($_SERVER['DOCUMENT_ROOT'] . "/avatars/$name_file"));
      $this->usersModel->update_avatar($name_file);
    }
    return header('Location:/game');
  }

  public function level_up()
  {
    $level = $this->usersModel->get_name_level_avatar($_COOKIE['autorized'])['level'];
    $this->usersModel->update_level('+', $level);
  }
  //API
  public function level_down()
  {
    $level = $this->usersModel->get_name_level_avatar($_COOKIE['autorized'])['level'];
    $level > 1 && $this->usersModel->update_level('-', $level);
  }

  //API
  public function check_dublicate($name)
  {
    $results = $this->usersModel->get_name();
    foreach ($results as $item) {
      if ($name === $item['name']) return json_encode(false);
    }
    return json_encode(true);
  }

  public function get_top_users(){
    return json_encode($this->usersModel->select_top());
  }

  public function get_info($id){
    $in_guilds = $this->guildUsersModel->show($id);
    $user = $this->usersModel->show($id);
    $guild = $this->guildsModel->get_name($user[0]['guild_id']);
    include '../resources/views/layout.php';
  }

  //API
  public function check_leader(){
    $results = $this->usersModel->get_guild_id();
    return json_encode($results);
  }
}
