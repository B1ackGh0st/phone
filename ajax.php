<?php
$host = '127.0.0.1';
$user = 'postgres';
$pass = 'postgres';
$db   = 'phone';

$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

$object_id = $_POST['object_id'];

switch ($_POST['action']){
  case "showSubdivision":
    echo '<div class="form-group row">
      <label for="selectSubdivision_id" class="col-sm-2 col-form-label">Подразделение</label>
      <div class="col-sm-4"><select name="selectSubdivision_id" id="selectSubdivision_id" class="form-control form-control-sm"><option value="0">Без категории</option>';
    $query = "SELECT * FROM subdivision WHERE object_id = '$object_id'";
    $a = pg_query($connection, $query);
      while ($row = pg_fetch_array($a)) {
        echo "<option value=".$row['id'].">".$row['name']."</option>";
      };
    echo '</select></div></div>';
  break;
};

?>
