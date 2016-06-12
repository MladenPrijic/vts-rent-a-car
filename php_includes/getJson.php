<?php

include("db_config.php");
//$s=$_POST["select"];
$city=$_POST["select"];

$sql="SELECT * FROM car WHERE location='$city' AND rented=0";

$result=mysqli_query($connect,$sql);
$data=array();
$dat=array();
$i=0;
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_array($result)){
		  if($row["automatic"] == 1){
			$row["automatic"]= "Automatic";
		}
		else{
			$row["automatic"]= "Manual";
		}
		if($row["navigation"] == 1){
			$row["navigation"]= "Yes";
		}
		else{
			$row["navigation"]= "No";
		}
		if($row["air_conditioning"] == 1){
			$row["air_conditioning"]= "Yes";
		}
		else{
			$row["air_conditioning"]= "No";
		}
		
		$data[]=array('id_car'=>$row["id_car"],
					  'brand'=>$row["brand"],
					  'model'=>$row["model"],
					  'image'=>$row["image"],
					  'year'=>$row["year"],
					  'price_flat'=>$row["price_flat"],
					  'price_day'=>$row["price_day"],
					  'location'=>$row["location"],
					  'seats'=>$row["seats"],
					  'doors'=>$row["doors"],
					  'automatic'=>$row["automatic"],
					  'air_conditioning'=>$row["air_conditioning"],
					  'luggage'=>$row["luggage"],
					  'description'=>$row["description"],
					  'navigation'=>$row["navigation"]
		);
	}

    header('Content-Type:application/json;charset=utf-8');
    echo json_encode($data);
}
else{
	echo "No";
}
