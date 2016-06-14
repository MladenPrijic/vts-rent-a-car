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

	$sqls="SELECT * FROM user WHERE id_user='$id_user' LIMIT 1";
	$result=mysqli_query($connect,$sqls);
	$rows=mysqli_fetch_array($result);
	if(!empty($rows["id_car"])){
		echo 1;
		exit();
	}


	/////////////////////////////////////////////////

	$sql="UPDATE car SET rented=1 WHERE id_car='$id_car'";
	$sql1="UPDATE user SET id_car='$id_car' WHERE id_user='$id_user'";
	$sql2="INSERT INTO rentedcars(id_user,id_car,dateTaken,dateReturn,cityPickup,cityReturn) VALUES('$id_user','$id_car','$pickupDate','$returnDate','$pickupCity','$returnCity' )";

	if($connect->query($sql) && $connect->query($sql1) && $connect->query($sql2)){
		echo 2;
	}
	else { echo mysqli_error($connect); }
}
