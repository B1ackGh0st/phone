<?php
if (isset($_POST["id"])) {
$ID = $_POST["id"];
  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  $query = 'SELECT * FROM subdivision WHERE object_id = '.$ID;
  $a = pg_query($connection, $query);
  echo '<table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th scope="col">Наименование</th>
              <th scope="col">Настройки</th>
            </tr>
          </thead>
          <tbody>';
  while($row = pg_fetch_array($a)) {
  echo '<tr><td>('.$row["position"].') '.$row["name"].'</td><td><img src="img/chevron-top-2x.png" id="'.$row['id'].'" class="objectPositionUp"> <img src="img/chevron-bottom-2x.png" id="'.$row['id'].'" class="objectPositionDown"> <img type="button" src="img/pencil-2x.png" data-toggle="modal" data-target="#exampleModalLong"> <img src="img/trash-2x.png" id="" class="remove-object"></td></tr>';
  }
  echo "</tbody></table>";

}
?>
