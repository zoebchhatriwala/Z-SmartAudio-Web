<?php
include 'SPNGSTLLC78653.php';
if(isset($_GET['userid']) && isset($_GET['password']) && isset($_GET['pin']))
{
$userid = htmlspecialchars($_GET['userid']);
$password = htmlspecialchars($_GET['password']);
$pin = htmlspecialchars($_GET['pin']);
$query = "SELECT id FROM users WHERE userid='$userid'";
$query = $dataBase->prepare($query);
$results = $query->execute();
$row = $results->fetchArray(SQLITE3_ASSOC);
$query2 = "SELECT id FROM admin WHERE pin='$pin'";
$query2 = $dataBase->prepare($query2);
$results2 = $query2->execute();
$row2 = $results2->fetchArray(SQLITE3_ASSOC);
if($row['id']>=1)
{
	echo '#FAIL';
}
else if($row2['id']<1)
{
	echo '#FAIL';
}
else
{
	$query = "INSERT INTO users(id,userid,password,accepted,playing,loggedin) VALUES (NULL,'$userid','$password','0','Not Playing','0')";
	$query = $dataBase->prepare($query);
	$query->execute();
	echo '#PASS';
}
}
//END
?>
