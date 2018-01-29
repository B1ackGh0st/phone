<?php

if (isset($_POST["subdivision_add_name"])) {

  $host = '127.0.0.1';
  $user = 'postgres';
  $pass = 'postgres';
  $db   = 'phone';

  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  $name = $_POST['subdivision_add_name'];
  $object_id = $_POST['object_id'];

  $query = "INSERT INTO subdivision (name, object_id) VALUES ('$name', '$object_id')";

  pg_query($connection, $query);

	// Формируем массив для JSON ответа
    $result = array(
    	'name' => $name
    );
    // Переводим массив в JSON
    echo json_encode($result);
}
