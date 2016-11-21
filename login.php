<?php
include 'SPNGSTLLC78653.php';
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$query = "SELECT id,pin FROM admin WHERE username='$username' AND password='$password'";
$query = $dataBase->prepare($query);
$results = $query->execute();
$row = $results->fetchArray(SQLITE3_ASSOC);
$sessionid = $row['id'];
$sessionpin = $row['pin'];
if($row['id']>=1)
{
	$_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
	$_SESSION['id'] = $sessionid;
	$_SESSION['pin'] = $sessionpin;
	$_SESSION['logged-in'] = 1;
}
else
{
	$_SESSION['login-failed'] = 1;
}
}
header( 'Location:index.php' );
?>

<html>

<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Z-SmartAudio">
    <meta name="author" content="Zoeb Chhatriwala [ZOEB.CO.IN]">
    <title>Loging In...</title>
	<link rel="shortcut icon" href="images/logo.png">
	
<style>
.centered
{
  position: fixed;
  top: 30%;
  left:35%;
  text-align:center;
}
</style>
<head>
<body>
<div class="centered">
<img src="images/loading.gif" alt="Loading..."/>
</div>

</body>
</html>