<?php
include 'SPNGSTLLC78653.php';
session_start();
if(isset($_POST['name']) && $_POST['name']!="" && $_SESSION['logged-in']==1)
{
if(isset($_FILES['mp3']))
{
$name = htmlspecialchars($_POST['name']);
$filelocation = htmlspecialchars($_FILES['mp3']['name']);
if(strpos($_FILES['mp3']['type'],'audio') !== false)
{
$query = "INSERT INTO audio(id,name,filelocation) VALUES (NULL,'$name','$filelocation')";
$query = $dataBase->prepare($query);
$query->execute();
$target_path = "uploads/";
$target_path = $target_path.basename( $_FILES['mp3']['name']);
if(move_uploaded_file($_FILES['mp3']['tmp_name'],$target_path)) {
    $_SESSION['fileupload'] = 'The file '.basename( $_FILES['mp3']['name']).' has been uploaded';
}
else
{
    $_SESSION['fileupload'] = "There was an error uploading the file, please try again!";
}
}
else
{
	$_SESSION['fileupload'] = "Please upload only audio files";
}
}
}
else if(isset($_POST['name']) && $_POST['name']=="")
{
$_SESSION['fileupload'] = "Please Enter File Name";	
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
    <title>Uploading Please Wait....</title>
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
<h2>File Is Being Uploaded</h1>
</div>

</body>
</html>