<?php
include 'SPNGSTLLC78653.php';
//fix users index
$query = "UPDATE users SET id = rowid";
$dataBase->exec($query);
//END
?>
