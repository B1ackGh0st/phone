<?php

if (isset($_POST["id"])) $ID = $_POST["id"];
if (isset($_POST["table"])) $table = $_POST["table"]

if (isset($ID) AND isset($table)) {

$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

if($table == 'object')  { // Если удаляем объект

  // Выполняем запрос для поиска удаляемого объекта
  $objectSql = "SELECT object WHERE id = '".$ID."'";
  $objectQuery = pg_query($connection, $objectSql);
  $object = pg_fetch_array($objectQuery);
  // Выполняем запрос для поиска подразделений которые привязанны к удаляемому объекту
  $subdivisionSql = "SELECT subdivision WHERE object_id = '".$ID."'";
  $subdivisionQuery = pg_query($connection, $subdivisionSql);
  $subdivision = pg_fetch_array($subdivisionQuery);
  // Выполняем запрос для поиска аббонентов которые привязанны к удаляемому объекту
  $subscriberSql = "SELECT subscriber WHERE object_id = '".$ID."'";
  $subscriberQuery = pg_query($connection, $subscriberSql);
  $subscriber = pg_fetch_array($subscriberQuery);

  // Выполняем запрос на перенисение аббонентов из удаляемого объекта в группу "Без категории"
  $subscriberUpdate = "UPDATE subscriber SET object_id = 0 WHERE object_id = ".$ID;
  $subscriberUpdateQuery = pg_query($connection, $subscriberUpdate);

}
if($table == 'subdivision')  { // Если удаляем подкатегорию
  $subdivisionSql = "SELECT subdivision WHERE id = '".$ID."'";
  $subscriberSql = "SELECT subscriber WHERE subdivision_id = '".$ID."'"
}
if($table == 'subscriber')  {
  $subscriberSql = "SELECT subscriber WHERE id = '".$ID."'"
}



/*
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
*/
}
?>
