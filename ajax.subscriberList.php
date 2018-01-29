<?php
$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

$query = 'SELECT
  sub.id,
  sub.name,
  ob.id,
  ob.name,
  subsc.subdivision_id,
  subsc.object_id,
  subsc.name,
  subsc.phone0,
  subsc.phone1,
  subsc.phone2,
  subsc.phone3
FROM
  subscriber AS subsc,
  subdivision AS sub,
  object AS ob
WHERE
  subsc.object_id = ob.id AND
  subsc.subdivision_id = sub.id
';
$a = pg_query($connection, $query);
echo '<table class="table table-bordered table-sm">
<thead>
  <tr>
    <th scope="col">Имя</th>
    <th scope="col">Объект</th>
    <th scope="col">Подразделение</th>
    <th scope="col">Опции</th>
  </tr>
</thead>
<tbody>';
while($row = pg_fetch_row($a)) {
echo '<tr><td>'.$row[6].'</td><td>'.$row[3].'</td><td>'.$row[1].'</td><td><img src="img/pencil-2x.png"> <img src="img/trash-2x.png"></td></tr>';
}
echo "</tbody></table>";
?>
