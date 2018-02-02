<?php
$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

$queryObject = 'SELECT id, name FROM object';
$aObject = pg_query($connection, $queryObject);

//echo $rowsCount;

while($rowObject = pg_fetch_row($aObject)) {

  echo '<li class="nav-item"><button class="objectLink btn btn-link" id="'.$rowObject[0].'">'.$rowObject[1].'</button></li>';

}
?>
