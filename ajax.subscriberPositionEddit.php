<?php
if (isset($_POST["subscriberPositionUp"])) $up = $_POST["subscriberPositionUp"];
if (isset($_POST["subscriberPositionDown"])) $down = $_POST["subscriberPositionDown"];

if (isset($up) || isset($down)) {
  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  if (isset($up)) {

    $queryPosition = "SELECT position, object_id, subdivision_id FROM subscriber WHERE id=".$up;
    $aPosition = pg_query($connection, $queryPosition);
    $position = pg_fetch_row($aPosition);

    if ($position[0] > 1) {

      $newPosition = $position[0]-1;

      $subsId = $up;
      $oldPos = $position[0];

      $newPosQuery = "UPDATE subscriber SET position='".$oldPos."' WHERE position='".$newPosition."' AND subdivision_id = '".$position[2]."'";
      $oldPosQuery = "UPDATE subscriber SET position='".$newPosition."' WHERE id='".$subsId."' AND subdivision_id = '".$position[2]."'";

      $newPos = pg_query($connection, $newPosQuery);
      $oldPos = pg_query($connection, $oldPosQuery);
    }

  }
  if (isset($down)) {

    $queryPosition = "SELECT position, object_id, subdivision_id FROM subscriber WHERE id=".$down;
    $aPosition = pg_query($connection, $queryPosition);
    $position = pg_fetch_row($aPosition);

    $newPosition = $position[0]+1;

    $subsId = $down;
    $oldPos = $position[0];

    $newPosQuery = "UPDATE subscriber SET position='".$oldPos."' WHERE position='".$newPosition."' AND subdivision_id = '".$position[2]."'";
    $oldPosQuery = "UPDATE subscriber SET position='".$newPosition."' WHERE id='".$subsId."' AND subdivision_id = '".$position[2]."'";

    $newPos = pg_query($connection, $newPosQuery);
    $oldPos = pg_query($connection, $oldPosQuery);
  }

  $n = array("object_id" => $position[1]);
  echo json_encode($n);

}
?>
