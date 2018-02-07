<?php

$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

echo '<div class="card">
        <div class="card-body">
          <form id="subdivision_add" method="post" action="">
          <div class="form-group row" id="subdivision_add" method="post" action="">
            <label for="subdivision_add_name" class="col-sm-2 col-form-label">Имя подразделения</label>
            <div class="col-sm-8">
              <input type="text" name="subdivision_add_name" id="subdivision_add_name" class="form-control form-control-sm" placeholder="Имя подразделения">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Объект</label>
            <div class="col-sm-8">
              <select class="form-control form-control-sm" name="object_id" id="object_id">
                <option value="0">Без привязки</option>';
                $objectSelectSql = 'SELECT * FROM object';
                $objectSelectQuery = pg_query($connection, $objectSelectSql);
                while($objectSelect = pg_fetch_array($objectSelectQuery)) {
                  echo "<option value=".$objectSelect['id'].">".$objectSelect['name']."</option>";
                }

echo '        </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button id="subdivision-add-btn" class="btn btn-sm btn-primary mb-2">Добавить</button>
            </div>
          </div>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-body">';

        $objectSql = 'SELECT id, name FROM object ORDER BY position ASC';
        $objectQuery = pg_query($connection, $objectSql);
        if(pg_fetch_row($objectQuery)>0)  {
              echo '<select id="object">';
              while($object = pg_fetch_row($objectQuery)) {
                echo "<option value='".$object[0]."'>".$object[1]."</option>";
                }
        }
        echo '</select>
        </div>
      </div>';


      echo '    <div class="card">
              <div class="card-body" id="subdivision-table">';
        $subdivisionSql = "SELECT id, name, position FROM subdivision WHERE object_id = 0 ORDER BY position ASC";
        $subdivisionQuery = pg_query($connection, $subdivisionSql);
        if(pg_fetch_row($subdivisionQuery)>0){
        echo '<table class="table table-bordered table-sm">
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
        '</div>
      </div>';

?>
