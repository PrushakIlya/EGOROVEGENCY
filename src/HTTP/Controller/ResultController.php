<?php

namespace Prushak\EgorovEgency\HTTP\Controller;

use PDO;
use Prushak\EgorovEgency\HTTP\Models\ResultsModel;
use Prushak\EgorovEgency\HTTP\Models\UsersModel;


class ResultController extends BaseController
{
  private $resultsModel;
  private $usersModel;

  public function __construct()
  {
    $this->resultsModel = new ResultsModel();
    $this->usersModel = new UsersModel();
  }

  //API
  public function results()
  {
    $this->data = json_decode(file_get_contents('php://input'), true);
    $this->resultsModel->insert_results($this->data);
  }
}
