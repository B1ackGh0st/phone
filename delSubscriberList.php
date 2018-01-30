<?php

if (isset($_POST["id"])) {

$ID = $_POST["id"];

$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

$query = "DELETE FROM subscriber WHERE id = '".$ID."'";
$a = pg_query($connection, $query);
echo "";

}
?>
