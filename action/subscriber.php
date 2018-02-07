<?php
$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

echo '<div class="card">
  <div class="card-body">
    <form id="subscriber_add" method="post" action="">
      <div class="form-group row" id="subscriber_add" method="post" action="">
        <label for="subscriber_add_name" class="col-sm-2 col-form-label">Имя абонента</label>
        <div class="col-sm-6">
          <input type="text" name="subscriber_add_name" id="subscriber_add_name" class="form-control form-control-sm" placeholder="Имя абонента">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Объект</label>
        <div class="col-sm-4">
          <select name="select-object" id="select-objeсt" class="form-control form-control-sm">';

            $query = 'SELECT id, name, position FROM object ORDER BY position ASC';
            $a = pg_query($connection, $query);
            while($array = pg_fetch_array($a)) {
              echo "<option value=".$array['id'].">".$array['name']."</option>";
            }

echo'</select>
        </div>
      </div>
      <div name="selectSubdivision"></div>
      <div class="row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Телефон</label>
        <div class="col">
          <div class="form-group" id="subscriberPhone0">
              <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone0" id="subscriberPhone0" class="form-control form-control-sm" placeholder="Телефон">
          </div>
        </div>
        <div class="col">
          <div class="form-group" id="subscriberPhone1">
              <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone1" id="subscriberPhone1" class="form-control form-control-sm" placeholder="Телефон">
          </div>
        </div>
        <div class="col">
      <div class="form-group" id="subscriberPhone2">
          <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone2" id="subscriberPhone2" class="form-control form-control-sm" placeholder="Телефон">
      </div>
      </div>
      <div class="col">
      <div class="form-group" id="subscriberPhone3">
          <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone3" id="subscriberPhone3" class="form-control form-control-sm" placeholder="Телефон">
        </div>
      </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button id="subscriber_add_btn" class="btn btn-sm btn-success mb-2"><img src="img/plus-2x.png"> Добавить</button>
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
        echo '<select id="object-sabdivision">';
        while($object = pg_fetch_row($objectQuery)) {
          echo "<optgroup label='".$object[1]."'>";

          $subdivisionSql = 'SELECT id, name FROM subdivision WHERE object_id='.$object[0].' ORDER BY position ASC';
          $subdivisionQuery = pg_query($connection, $subdivisionSql);
          if(pg_fetch_row($subdivisionQuery)>0)  {
            while($subdivision = pg_fetch_row($subdivisionQuery)) {
              echo "<option value='".$subdivision[0]."'>".$subdivision[1]."</option>";
            }
          }
        }
        echo '</select>';
  }

  echo '</div></div>
  <div class="card"><div class="card-body" id="subscriber-table">';
  $subscriberSql = "SELECT id, name, position FROM subscriber WHERE subdivision_id='0' ORDER BY position ASC";
  $subscriberQuery = pg_query($connection, $subscriberSql);
  if(pg_fetch_row($subscriberQuery)>0){
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
  while($subscriber = pg_fetch_array($subscriberQuery)) {
    echo '      <tr id=row-'.$subscriber['id'].'>
                  <td>
                    ('.$subscriber['position'].') '.$subscriber['name'].'
                  </td>
                  <td>
                    <img src="img/chevron-top-2x.png" id="'.$subscriber['id'].'" class="subdivision-position-up">
                    <img src="img/chevron-bottom-2x.png" id="'.$subscriber['id'].'" class="subdivision-position-down">
                    <img type="button" src="img/pencil-2x.png" data-toggle="modal" data-target="#exampleModalLong">
                    <img src="img/trash-2x.png" id="'.$subscriber['id'].'" class="subdivision-del">
                  </td>
                </tr>';
  }
}
  echo '</tbody>
        </table>
        </div>
        </div>';
?>
