<?php
if (isset($_POST["objectPositionUp"])) $up = $_POST["objectPositionUp"];
if (isset($_POST["objectPositionDown"])) $down = $_POST["objectPositionDown"];

if (isset($up) || isset($down)) {
  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  if (isset($up)) {

    $queryPosition = "SELECT id, name, position FROM object WHERE id=".$up;
    $aPosition = pg_query($connection, $queryPosition);
    $position = pg_fetch_row($aPosition);

    if ($position[0] > 1) {

      $newPosition = $position[0]-1;

      $subsId = $up;
      $oldPos = $position[0];

      $newPosQuery = "UPDATE object SET position='".$oldPos."' WHERE position='".$newPosition."'";
      $oldPosQuery = "UPDATE object SET position='".$newPosition."' WHERE id='".$subsId."'";

      $newPos = pg_query($connection, $newPosQuery);
      $oldPos = pg_query($connection, $oldPosQuery);
    }

  }
  if (isset($down)) {

      $queryPosition = "SELECT id, name, position FROM object WHERE id=".$down;
      $aPosition = pg_query($connection, $queryPosition);
      $position = pg_fetch_row($aPosition);

      $newPosition = $position[0]+1;

      $subsId = $down;
      $oldPos = $position[0];

      $newPosQuery = "UPDATE object SET position='".$oldPos."' WHERE position='".$newPosition."'";
      $oldPosQuery = "UPDATE object SET position='".$newPosition."' WHERE id='".$subsId."'";

      $newPos = pg_query($connection, $newPosQuery);
      $oldPos = pg_query($connection, $oldPosQuery);
  }

}
?>
