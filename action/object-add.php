<?php

if (isset($_POST["name"])) {
  $name = $_POST['name'];

  $host = '127.0.0.1';
  $user = 'postgres';
  $pass = 'postgres';
  $db   = 'phone';

  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  $name = $_POST['name'];

  $objectSelectSql = 'SELECT id FROM object';
  $objectSelectQuery = pg_query($connection, $objectSelectSql);
  $count = pg_num_rows($objectSelectQuery);
  $count = $count+1;

  $query = "INSERT INTO object (name, position) VALUES ('$name', '$count')";

  pg_query($connection, $query);
/*
	// Формируем массив для JSON ответа
    $result = array(
    	'name' => $name
    );
    // Переводим массив в JSON
    echo json_encode($result);*/
}

?>
