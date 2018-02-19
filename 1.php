<?PHP
$oldPosQuery = "UPDATE subscriber SET position='".$newPosition."' WHERE id='".$subsId."'";

$newPos = pg_query($connection, $newPosQuery);
?>
