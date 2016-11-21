<?php

//Open the database mydb
try{
$dataBase = new SQLite3('db/SmartAudioDB');
}catch(Exception $e)
{
	die("Unable to connect to Database");
}

//Create All Required Tables table
$dataBase->exec("CREATE TABLE IF NOT EXISTS `admin` (
  `id` INTEGER PRIMARY KEY,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `pin` text NOT NULL
) ");

$dataBase->exec("CREATE TABLE IF NOT EXISTS `audio` (
  `id` INTEGER PRIMARY KEY,
  `name` text NOT NULL,
  `filelocation` text NOT NULL
) ");

$dataBase->exec("CREATE TABLE IF NOT EXISTS `users` (
  `id` INTEGER PRIMARY KEY,
  `userid` text NOT NULL,
  `password` text NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `playing` text NOT NULL,
  `loggedin` tinyint(1) NOT NULL
) ");

?>