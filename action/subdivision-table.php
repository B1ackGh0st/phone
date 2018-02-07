<?php
if (isset($_POST['id'])) {

  $id = $_POST['id'];

  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

  $subdivisionSql = "SELECT id, name,position FROM subdivision WHERE object_id='".$id."' ORDER BY position ASC";
  $subdivisionQuery = pg_query($connection, $subdivisionSql);

  echo '    <table class="table table-bordered table-sm">
              <thead>
                <tr>
                  <th scope="col">
                    Наименование
                  </th>
                  <th scope="col">
                  </th>
                </tr>
              </thead>
              <tbody>';
  while($subdivision = pg_fetch_array($subdivisionQuery)) {
    echo '      <tr id=row-'.$subdivision['id'].'>
                  <td>
                    ('.$subdivision['position'].') '.$subdivision['name'].'
                  </td>
                  <td>
                    <img src="img/chevron-top-2x.png" id="'.$subdivision['id'].'" class="subdivision-position-up">
                    <img src="img/chevron-bottom-2x.png" id="'.$subdivision['id'].'" class="subdivision-position-down">
                    <img type="button" src="img/pencil-2x.png" data-toggle="modal" data-target="#exampleModalLong">
                    <img src="img/trash-2x.png" id="'.$subdivision['id'].'" class="subdivision-del">
                  </td>
                </tr>';
  }
  echo "      </tbody>
            </table>";
}
?>
