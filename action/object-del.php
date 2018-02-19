<?php

if (isset($_POST["id"])) $ID = $_POST["id"];
if (isset($_POST["table"])) $table = $_POST["table"];

if (isset($ID) AND isset($table)) {

$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

if($table == 'object')  { // Если удаляем объект

  // Выполняем запрос для поиска удаляемого объекта
  $objectDelSql = "SELECT * FROM object WHERE id = '".$ID."'";
  $objectDelQuery = pg_query($connection, $objectDelSql);
  $objectDel = pg_fetch_array($objectDelQuery);

  $objectSql = "SELECT * FROM object WHERE position < '".$objectDel['position']."'";
  $objectQuery = pg_query($connection, $objectSql);

  while ($object = pg_fetch_array($objectQuery)) {
    $newPosition = $object['position']-1;
    $newPosQuery = "UPDATE object SET position='".$newPosition."' WHERE id=".$object['id'];
    pg_query($connection, $newPosQuery);
  }

  $delSQL = "DELETE FROM object WHERE id = '".$ID."'";
  $del = pg_query($connection, $delSQL);

}

/*

  $newPosQuery = "UPDATE object SET position='".$oldPos."' WHERE position<'".$newPosition."'";
  $oldPosQuery = "UPDATE object SET position='".$newPosition."' WHERE id='".$subsId."'";

  // Выполняем запрос для поиска подразделений которые привязанны к удаляемому объекту
  $subdivisionSql = "UPDATE subdivision SET object_id = 0 WHERE object_id = '".$ID."'";
  $subdivisionQuery = pg_query($connection, $subdivisionSql);
  $subdivision = pg_fetch_array($subdivisionQuery);
  // Выполняем запрос для поиска аббонентов которые привязанны к удаляемому объекту
  $subscriberSql = "UPDATE subscriber SET object_id = 0 AND subdivision_id = 0 WHERE object_id = '".$ID."'";
  $subscriberQuery = pg_query($connection, $subscriberSql);
  $subscriber = pg_fetch_array($subscriberQuery);
*/

}

?>
