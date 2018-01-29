<?php
$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

$queryObject = 'SELECT id, name FROM object';
$aObject = pg_query($connection, $queryObject);

while($rowObject = pg_fetch_row($aObject)) {
echo '<li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#'.$rowObject[1].'" role="tab" aria-controls="subscribers" aria-selected="false">'.$rowObject[1].'</a>
  </li>';

  $querySubscriber = 'SELECT id, name FROM subscriber WHERE object_id='.$rowObject[0];
  $aSubscriber = pg_query($connection, $querySubscriber);

  while($rowSubscriber = pg_fetch_row($aSubscriber)) {
    echo $rowSubscriber[1];
  }
}
?>
