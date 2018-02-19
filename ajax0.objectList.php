<?php
$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");
/*
$query = "SELECT subscriber.id, subscriber.name, subscriber.Object_id, subscriber.position, Object.id, Object.name
FROM subscriber, Object
WHERE subscriber.Object_id = Object.id AND subscriber.object_id = ".$ID." ORDER BY subscriber.position ASC";
*/
//$query = "SELECT id, name FROM subscriber WHERE object_id=".$ID." ORDER BY position ASC";

$queryObject = "SELECT id, name, position FROM object ORDER BY position ASC";
$aObject = pg_query($connection, $queryObject);
echo '<table class="table table-bordered table-sm">
<thead>
  <tr>
    <th scope="col">Наименование</th>
    <th scope="col"></th>
  </tr>
</thead>
<tbody>';
//echo $rowsCount;
while($Object = pg_fetch_array($aObject)) {

  echo '<tr><td>('.$Object['position'].') '.$Object['name'].'</td><td><img src="img/chevron-top-2x.png" id="'.$Object['id'].'" class="objectPositionUp"> <img src="img/chevron-bottom-2x.png" id="'.$Object['id'].'" class="objectPositionDown"> <img type="button" src="img/pencil-2x.png" data-toggle="modal" data-target="#exampleModalLong"> <img src="img/trash-2x.png" id="" class="remove-object"></td></tr>';

}
echo "</tbody></table>";

?>
