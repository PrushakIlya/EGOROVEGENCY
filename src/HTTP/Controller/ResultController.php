<?php

namespace Prushak\EgorovEgency\HTTP\Controller;

use Prushak\EgorovEgency\HTTP\Models\ResultsModel;


class ResultController extends BaseController
{
  private $resultsModel;

  public function __construct()
  {
    $this->resultsModel = new ResultsModel();
  }

  //API
  public function results()
  {
    $this->data = json_decode(file_get_contents('php://input'), true);
    $this->resultsModel->insert_results($this->data);
  }
}
