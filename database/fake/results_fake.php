<?php
function results_fake($db_connect)
{
  $index = 0;
  for ($index; $index < 10; $index++) {
    $sql = "INSERT INTO results (result,user_id) VALUES (:result,:user_id)";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute(array(":result" => "1->cross,4->zero,0->cross,8->zero,2->cross", ":user_id" => rand(1, 10)));
  }
}
