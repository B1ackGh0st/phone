<?php
$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

$queryObject = "SELECT id, name, position FROM object ORDER BY position ASC";
$aObject = pg_query($connection, $queryObject);
if(pg_fetch_row($aObject)>0){
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
//echo $rowsCount;
while($object = pg_fetch_array($aObject)) {
  echo '      <tr id=row-'.$object['id'].'>
                <td>
                  ('.$object['position'].') '.$object['name'].'
                </td>
                <td>
                  <img src="img/chevron-top-2x.png" id="'.$object['id'].'" class="object-position-up">
                  <img src="img/chevron-bottom-2x.png" id="'.$object['id'].'" class="object-position-down">
                  <img type="button" src="img/pencil-2x.png" data-toggle="modal" data-target="#exampleModalLong">
                  <img src="img/trash-2x.png" id="'.$object['id'].'" class="object-del">
                </td>
              </tr>';
}
echo "      </tbody>
          </table>";
}
?>
