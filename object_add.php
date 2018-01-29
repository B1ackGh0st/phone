<?php

if (isset($_POST["object_add_name"])) {

  $host = '127.0.0.1';
  $user = 'postgres';
  $pass = 'postgres';
  $db   = 'phone';

  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  $name = $_POST['object_add_name'];

  $query = "INSERT INTO object (name) VALUES ('$name')";

  pg_query($connection, $query);

	// Формируем массив для JSON ответа
    $result = array(
    	'name' => $name
    );
    // Переводим массив в JSON
    echo json_encode($result);
}


/*
$host = '127.0.0.1';
$user = 'postgres';
$pass = 'postgres';
$db   = 'phone';
$connection = pg_connect ('host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres');
if (!$connection)
{
die('Не удалось соединиться с базой данных');
}
$Query3 = "INSERT INTO object (name) VALUES ('АТЦ')";

if(pg_query($connection, $Query3))  {
  print("Запись");
} else {
  print("Сбой" . pg_last_error());
}
*/
/*
//simple check
$conn = pg_connect($connStr);
$result = pg_query($conn, "select * from pg_stat_activity");
var_dump(pg_fetch_all($result));
*/

?>
