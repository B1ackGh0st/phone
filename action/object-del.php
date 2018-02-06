<?php

if (isset($_POST["id"])) {

  $ID = $_POST["id"];

  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  $selectSQLsubd = "SELECT subdivision WHERE object_id = '".$ID."'";

  if ($selectSubd = pg_query($connection, $selectSQLsubd)) {
    while($update = pg_fetch_array($selectSubd)) {
      $updSQLSubd = "UPDATE subdivision SET object_id='0' WHERE id = '".$update['id']."'";
      $updSubd = pg_query($connection, $updSQLSubd);
    }
  }

  $selectSQLsubs = "SELECT subscriber WHERE object_id = '".$ID."'";

  if ($selectSubs = pg_query($connection, $selectSQLsubs)) {
    while ($updateSubs = pg_fetch_array($selectSubs)){
      $updSQLSubs = "UPDATE subscriber SET object_id='0' WHERE id = '".$updateSubs['id']."'";
      $updSubs = pg_query($connection, $updSQLSubs);
    }
  }

  $delSQL = "DELETE FROM object WHERE id = '".$ID."'";
  $del = pg_query($connection, $delSQL);

}
?>
