<?php

namespace Prushak\EgorovEgency\HTTP\Controller;


class GamebotController extends BaseController
{
  private $data;

  public function __construct()
  {
    $this->data = json_decode(file_get_contents('php://input'), true);
  }

  public function game_bot()
  {
    $new_item = [];
    return $this->rand_step($new_item);
  }

  private function rand_step($new_item)
  {
    $step = rand(0, 8);
    if ($this->draw()) {
      if ($this->getWinLose('cross')) {
        return json_encode([$step => 'win']);
      }
      return json_encode([$step => 'draw']);
    };
    if ($this->data[$step] === null) {
      $this->data[$step] = 'zero';
      if ($this->getWinLose('cross')) {
        return json_encode([$step => 'win']);
      }
      if ($this->getWinLose('zero')) {
        return json_encode([$step => 'lose']);
      }
      return json_encode([$step => 'zero']);
    }
    return $this->rand_step($new_item);
  }

  private function draw()
  {
    $count = 0;
    for ($index = 0; $index < count($this->data); $index++) {
      !empty($this->data[$index]) && $count++;
    }
    if ($count === 9) return true;
  }

  private function getWinLose($zero_cross)
  {
    if ($this->data[0] === $zero_cross && $this->data[1] === $zero_cross && $this->data[2] === $zero_cross) return true;
    if ($this->data[3] === $zero_cross && $this->data[4] === $zero_cross && $this->data[5] === $zero_cross) return true;
    if ($this->data[6] === $zero_cross && $this->data[7] === $zero_cross && $this->data[8] === $zero_cross) return true;
    if ($this->data[0] === $zero_cross && $this->data[4] === $zero_cross && $this->data[8] === $zero_cross) return true;
    if ($this->data[2] === $zero_cross && $this->data[4] === $zero_cross && $this->data[6] === $zero_cross) return true;
    if ($this->data[0] === $zero_cross && $this->data[3] === $zero_cross && $this->data[6] === $zero_cross) return true;
    if ($this->data[1] === $zero_cross && $this->data[4] === $zero_cross && $this->data[7] === $zero_cross) return true;
    if ($this->data[2] === $zero_cross && $this->data[5] === $zero_cross && $this->data[8] === $zero_cross) return true;
    return false;
  }
}
