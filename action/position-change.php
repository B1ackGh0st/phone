<?php

$up = false;
$down = false;

if (isset($_POST["position"])) $position = $_POST["position"];

if ($position == "position-up") $up = true;
if ($position == "position-down") $down = true;

if (isset($_POST["table"])) $tableName = $_POST["table"];
if (isset($_POST["id"])) $id = $_POST["id"];

if ($up || $down) {
  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  if ($up) {

    $queryPosition = "SELECT * FROM ".$tableName." WHERE id=".$id;
    $aPosition = pg_query($connection, $queryPosition);
    $position = pg_fetch_array($aPosition);

    if ($position['position'] > 1) {

      $newPosition = $position['position']-1;

      $subsId = $id;
      $oldPos = $position['position'];

      if ($tableName == 'object') {
        $newPosQuery = "UPDATE ".$tableName." SET position='".$oldPos."' WHERE position='".$newPosition."'";
        $oldPosQuery = "UPDATE ".$tableName." SET position='".$newPosition."' WHERE id='".$subsId."'";
      }
      if ($tableName == 'subdivision ') {

      }

      if ($tableName == 'subscriber ')  {

      }

      $newPos = pg_query($connection, $newPosQuery);
      $oldPos = pg_query($connection, $oldPosQuery);
    }

  }
  if ($down) {

    // Считаем коллиесктво записей
    $countSql = "SELECT * FROM ".$tableName;
    $countQuery = pg_query($connection, $countSql);

    $count = pg_num_rows($countQuery);

    $queryPosition = "SELECT * FROM ".$tableName." WHERE id=".$id;
    $aPosition = pg_query($connection, $queryPosition);

    $position = pg_fetch_array($aPosition);

    if ($position['position'] < $count) {
      $newPosition = $position['position']+1;

      $subsId = $id;
      $oldPos = $position['position'];

      if ($tableName == 'object') {
        $newPosQuery = "UPDATE ".$tableName." SET position='".$oldPos."' WHERE position='".$newPosition."'";
        $oldPosQuery = "UPDATE ".$tableName." SET position='".$newPosition."' WHERE id='".$subsId."'";
      }
      if ($tableName == 'subdivision ') {

      }

      if ($tableName == 'subscriber ')  {

      }

      $newPos = pg_query($connection, $newPosQuery);
      $oldPos = pg_query($connection, $oldPosQuery);
    }
  }

  $n = array("object_id" => $count);
  echo json_encode($n);

}

?>
