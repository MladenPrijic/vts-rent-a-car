<?php
$host="localhost";
$user="root";
$pass="toor";
$database="rent-a-car";

$connect=new mysqli($host, $user, $pass, $database);

if($connect->connect_error)
{
	die("Cant connect to database $database!");
}

?>
