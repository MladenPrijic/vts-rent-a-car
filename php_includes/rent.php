<?php
session_start();
$id_user=$_SESSION["id_user"];
include("db_config.php");
if(isset($_POST["id_car"])){
	$id_car=$_POST["id_car"];
	$pickupCity=$_POST["pickupCity"];
	$returnCity=$_POST["returnCity"];
	$pickupDate=$_POST["pickupDate"];
	$returnDate=$_POST["returnDate"];

	$sql="UPDATE car SET rented=1 WHERE id_car='$id_car'";
	$sql1="UPDATE user SET id_car='$id_car' WHERE id_user='$id_user'";
	$sql2="INSERT INTO rentedcars(id_user,id_car,dateTaken,dateReturn) VALUES('$id_user','$id_car','$pickupDate','$returnDate' )";

	if($connect->query($sql) && $connect->query($sql1) && $connect->query($sql2)){
		echo "Yes";
	}
	else { echo mysqli_error($connect); }
}
