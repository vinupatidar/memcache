<?php

$hostname = "localhost";
$user = "root";
$password = "";
$database = "pandora";

$conn = mysql_connect($hostname, $user, $password) 
or die("Ooppsss!! Something went wrong");
$dbconn = mysql_select_db($database, $conn) or die(": Ooppsss !! Could not able to connect database");

?>