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
	$price=$_POST["price"];

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
	$sql2="INSERT INTO rentedcars(id_user,id_car,dateTaken,dateReturn,cityPickup,cityReturn,price) VALUES('$id_user','$id_car','$pickupDate','$returnDate','$pickupCity','$returnCity','$price' )";

	if($connect->query($sql) && $connect->query($sql1) && $connect->query($sql2)){
		echo 2;
	}
	else { echo mysqli_error($connect); }
}

if($_POST["getprice"]){
	$id_car=$_POST["getprice"];
	$sql="SELECT * FROM car WHERE id_car='$id_car' LIMIT 1";
	$result=mysqli_query($connect,$sql);
	$row=mysqli_fetch_array($result);
	$data=[];
	array_push ($data, array(
	                        	
						        'price_flat'=>$row["price_flat"],
						        'price_day'=>$row["price_day"],
						        
				));
	header('Content-Type:application/json;charset=utf-8');
	echo json_encode($data);
}
