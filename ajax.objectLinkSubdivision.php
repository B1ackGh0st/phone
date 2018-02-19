<?php
$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

$queryObject = 'SELECT id, name FROM object ORDER BY position ASC';
$aObject = pg_query($connection, $queryObject);

echo '<ul class="nav">';
while($rowObject = pg_fetch_row($aObject)) {
  echo '<li class="nav-item"><button class="subdivisionList btn btn-link" id="'.$rowObject[0].'">'.$rowObject[1].'</button></li>';
}
echo '</ul>';

?>
