<?php
include 'SPNGSTLLC78653.php';
if(isset($_GET['userid']) && isset($_GET['password']) && isset($_GET['playing']))
{
$userid = htmlspecialchars($_GET['userid']);
$password = htmlspecialchars($_GET['password']);
$playing = htmlspecialchars($_GET['playing']);
$query = "SELECT id,accepted FROM users WHERE userid='$userid' AND password='$password'";
$query = $dataBase->prepare($query);
$results = $query->execute();
$row = $results->fetchArray(SQLITE3_ASSOC);
if($row['id']>=1 && $row['accepted']==true)
{
	$temp = $row['id'];
	$query = "UPDATE users SET playing='$playing' WHERE id='$temp'";
	$query = $dataBase->prepare($query);
	$query->execute();
	echo '#PASS';
}
else
{
	echo '#FAIL';
}
}
//END
?>
