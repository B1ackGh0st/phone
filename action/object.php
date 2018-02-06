<?php
$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

echo '<div class="card">
        <div class="card-body">
          <form class="form-inline" id="object-add" method="post" action="">
            <label <label class="sr-only" for="name">Объект</label>
            <input type="text" name="name" id="name" class="form-control mb-2 mr-sm-2 form-control-sm" placeholder="Имя объекта">
            <button id="object-add-btn" class="btn btn-sm btn-primary mb-2">Добавить</button>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-body" id="object-table">';

$queryObject = "SELECT id, name, position FROM object ORDER BY position ASC";
$aObject = pg_query($connection, $queryObject);
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
          </table>
        </div>
      </div>";

?>
