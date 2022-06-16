<?php

namespace Prushak\EgorovEgency\HTTP\Controller;

use PDO;
use Prushak\EgorovEgency\HTTP\Models\UsersModel;
use Prushak\EgorovEgency\HTTP\Models\GuildsModel;

class FrontController extends BaseController
{
  private $conn;
  private $usersModel;
  private $guildsModel;

  public function __construct()
  {
    $this->conn = include '../config/connect_db.php';
    $this->usersModel = new UsersModel();
    $this->guildsModel = new GuildsModel();
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

  public function create_guild()
  {
    if (!$_COOKIE && !$_COOKIE['autorized']) return header('Location:/');
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
    $results = $this->usersModel->autorization_check();
    if ($results && password_verify($_POST['password'], $results['password'])) {
      setcookie('autorized', $results['id'], time() + 86400 * 5, '/');
      return header('Location:/game');
    }
    return header('Location:/autorization');
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


  public function store_guild()
  {
    if (!$_COOKIE && !$_COOKIE['autorized']) return header('Location:/');

    $this->guildsModel->insert_quild();

    $id = $this->guildsModel->get_id($_POST["guild_name"]);

    $this->usersModel->update_guild($id);

    return header('Location:/game');
  }



  //API
  public function game_result()
  {
    $level = $this->usersModel->get_name_level_avatar($_COOKIE['autorized'])['level'];
    $this->usersModel->update_level($level);
  }
  //API
  public function check_dublicate($name)
  {
    $results = $this->store->get_user_name();
    foreach ($results as $item) {
      if ($name === $item['name']) return json_encode(false);
    }
    return json_encode(true);
  }
}
