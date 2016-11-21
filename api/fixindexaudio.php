<?php
include 'SPNGSTLLC78653.php';
//fix audio index
$query = "ALTER TABLE audio id = rowid";
$dataBase->exec($query);
//END
?>
