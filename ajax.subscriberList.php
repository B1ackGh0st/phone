<?php
if (isset($_POST["id"])) {

  $ID = $_POST["id"];

  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");
  /*
  $query = "SELECT subscriber.id, subscriber.name, subscriber.subdivision_id, subscriber.position, subdivision.id, subdivision.name
  FROM subscriber, subdivision
  WHERE subscriber.subdivision_id = subdivision.id AND subscriber.object_id = ".$ID." ORDER BY subscriber.position ASC";
*/
  //$query = "SELECT id, name FROM subscriber WHERE object_id=".$ID." ORDER BY position ASC";

  $querySubdivision = "SELECT id, name FROM subdivision WHERE object_id=".$ID." ORDER BY position ASC";
  $aSubdivision = pg_query($connection, $querySubdivision);
  echo '<table class="table table-bordered table-sm">
  <thead>
    <tr>
      <th scope="col">Имя</th>
      <th scope="col">Опции</th>
    </tr>
  </thead>
  <tbody>';
  //echo $rowsCount;
  while($subdivision = pg_fetch_array($aSubdivision)) {

    echo '<tr colspan=2><td><h6><strong><center>'.$subdivision['name'].'</center></strong></h6></td></tr>';

    $querySubscriber = "SELECT id, name, position FROM subscriber WHERE subdivision_id=".$subdivision['id']." ORDER BY position ASC";
    $aSubscriber = pg_query($connection, $querySubscriber);

    while($subscriber = pg_fetch_array($aSubscriber)) {
      echo '<tr id=row-'.$subscriber['name'].'><td>('.$subscriber['position'].') '.$subscriber['name'].'</td><td><img src="img/chevron-top-2x.png" id="'.$subscriber['id'].'" class="subscriberPositionUp"> <img src="img/chevron-bottom-2x.png" id="'.$subscriber['id'].'" class="subscriberPositionDown"> <img type="button" src="img/pencil-2x.png" data-toggle="modal" data-target="#exampleModalLong"> <img src="img/trash-2x.png" id="" class="remove-subscriber"></td></tr>';
    }

  }

  echo "</tbody></table>";

}
?>
