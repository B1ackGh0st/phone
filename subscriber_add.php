<?php
if (isset($_POST["subscriber_add_name"])) {

  $host = '127.0.0.1';
  $user = 'postgres';
  $pass = 'postgres';
  $db   = 'phone';

  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  $name = trim($_POST['subscriber_add_name']);
  $object_id = trim($_POST['selectObject_id']);
  $subdivision_id = trim($_POST['selectSubdivision_id']);
  $phone0 = $_POST['subscriberPhone0'];
  $phone1 = $_POST['subscriberPhone1'];
  $phone2 = $_POST['subscriberPhone2'];
  $phone3 = $_POST['subscriberPhone3'];
  /*if($phone0 == NULL) $phone0 = 0;
  if($phone1 == NULL) $phone1 = 0;
  if($phone2 == NULL) $phone2 = 0;
  if($phone3 == NULL) $phone3 = 0;*/
  $query = "INSERT INTO subscriber (
    name,
    object_id,
    subdivision_id,
    phone0,
    phone1,
    phone2,
    phone3
  ) VALUES (
    '$name',
    '$object_id',
    '$subdivision_id',
    '$phone0',
    '$phone1',
    '$phone2',
    '$phone3'
  )";

  pg_query($connection, $query);

  $result = array(
  	'name' => $name
  );
  // Переводим массив в JSON
  echo json_encode($result);


/*
  // Формируем массив для JSON ответа
  $result = array(
  	'name' => $name
  );
  // Переводим массив в JSON
  echo json_encode($result);
*/
}
