<?php

$up = false;
$down = false;

if (isset($_POST["position"])) $positionPOST = $_POST["position"];

if ($positionPOST == "position-up") $up = true;
if ($positionPOST == "position-down") $down = true;

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
        $n = array("id" => $position['id']);
        echo json_encode($n);
      }
      if ($tableName == 'subdivision') {
        $newPosQuery = "UPDATE ".$tableName." SET position='".$oldPos."' WHERE position='".$newPosition."' AND object_id='".$position['object_id']."'";
        $oldPosQuery = "UPDATE ".$tableName." SET position='".$newPosition."' WHERE id='".$subsId."'";
        $n = array("object_id" => $position['object_id']);
        echo json_encode($n);
      }

      if ($tableName == 'subscriber')  {
        $newPosQuery = "UPDATE ".$tableName." SET position='".$oldPos."' WHERE position='".$newPosition."' AND subdivision_id='".$position['subdivision_id']."'";
        $oldPosQuery = "UPDATE ".$tableName." SET position='".$newPosition."' WHERE id='".$subsId."'";
        $n = array("subdivision_id" => $position['subdivision_id']);
        echo json_encode($n);
      }

      $newPos = pg_query($connection, $newPosQuery);
      $oldPos = pg_query($connection, $oldPosQuery);
    }

  }
  if ($down) {

    $queryPosition = "SELECT * FROM ".$tableName." WHERE id=".$id;
    $aPosition = pg_query($connection, $queryPosition);
    $position = pg_fetch_array($aPosition);

    // Считаем коллиесктво записей
    if ($tableName == 'object') {
      $countSql = "SELECT COUNT(*) FROM ".$tableName;
    }
    if ($tableName == 'subdivision') {
      $countSql = "SELECT COUNT(*) FROM ".$tableName." WHERE object_id=".$position['object_id'];
    }
    if ($tableName == 'subscriber')  {
      $countSql = "SELECT COUNT(*) FROM ".$tableName." WHERE subdivision_id=".$position['subdivision_id'];
    }
    $countQuery = pg_query($connection, $countSql);
    $count = pg_fetch_row($countQuery);

    if ($position['position'] < $count) {
      $newPosition = $position['position']+1;

      $subsId = $id;
      $oldPos = $position['position'];

      if ($tableName == 'object') {
        $newPosQuery = "UPDATE ".$tableName." SET position='".$oldPos."' WHERE position='".$newPosition."'";
        $oldPosQuery = "UPDATE ".$tableName." SET position='".$newPosition."' WHERE id='".$subsId."'";
      }
      if ($tableName == 'subdivision') {
        $newPosQuery = "UPDATE ".$tableName." SET position='".$oldPos."' WHERE position='".$newPosition."' AND object_id='".$position['object_id']."'";
        $oldPosQuery = "UPDATE ".$tableName." SET position='".$newPosition."' WHERE id='".$subsId."'";
        $n = array("object_id" => $position['object_id']);
        echo json_encode($n);
      }

      if ($tableName == 'subscriber')  {
        $newPosQuery = "UPDATE ".$tableName." SET position='".$oldPos."' WHERE position='".$newPosition."' AND subdivision_id='".$position['subdivision_id']."'";
        $oldPosQuery = "UPDATE ".$tableName." SET position='".$newPosition."' WHERE id='".$subsId."'";
        $n = array("subdivision_id" => $position['subdivision_id']);
        echo json_encode($n);
      }

      $newPos = pg_query($connection, $newPosQuery);
      $oldPos = pg_query($connection, $oldPosQuery);
    }
  }

}

?>
