<?php
if (isset($_POST["id"])) {

  $ID = $_POST["id"];

  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  $query = "SELECT id, name FROM subscriber WHERE object_id=".$ID." ORDER BY position ASC";
  $a = pg_query($connection, $query);
  echo '<table class="table table-bordered table-sm">
  <thead>
    <tr>
      <th scope="col">Имя</th>
      <th scope="col">Опции</th>
    </tr>
  </thead>
  <tbody>';
  //echo $rowsCount;
  while($row = pg_fetch_row($a)) {
  echo '<tr id=row-'.$row[1].'><td>'.$row[1].'</td><td><img src="img/chevron-top-2x.png"> <img src="img/chevron-bottom-2x.png"> <img type="button" src="img/pencil-2x.png" data-toggle="modal" data-target="#exampleModalLong"> <img src="img/trash-2x.png" id="" class="remove-subscriber"></td></tr>';

  }
  echo "</tbody></table>";

}
?>
