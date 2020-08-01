<?php

$servername = "localhost";
$username = "root";
$password = "";
try
{
	
$conn = new PDO("mysql:host=$servername:3308;dbname=userinfo", $username, $password);
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
?>