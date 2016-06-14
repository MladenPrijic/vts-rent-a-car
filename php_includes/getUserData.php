<?php
include ("db_config.php");
if(isset($_POST["id_user"])){
	$id_user=$_POST["id_user"];
	$sql="SELECT * FROM user WHERE id_user='$id_user' LIMIT 1";
	$result=mysqli_query($connect,$sql);
	$row=mysqli_fetch_array($result);
	$data=[];
	if(!empty($row["id_car"])){
		$id_car=$row["id_car"];
		$sql1="SELECT * FROM rentedcars WHERE id_car='$id_car' AND id_user='$id_user' LIMIT 1 ";
		$res=mysqli_query($connect,$sql1);
	    $rows=mysqli_fetch_array($res);
	    ////////////////////////////////////////////////
	    $sql2="SELECT * FROM car WHERE id_car='$id_car'";
	    $ress=mysqli_query($connect,$sql2);
	    $rowss=mysqli_fetch_array($ress);
	    //////////////////////////////////////////////////////////
	    if(!empty($rows["dateTaken"])){
		                          $dt = new DateTime($rows["dateTaken"]);
		                          $date = $dt->format('m/d/Y');
		                      }
		                      else{
		                      	$date="/";
		                      }
		                      if(!empty($rows["dateReturn"])){
		                          $dr= new DateTime($rows["dateReturn"]);
		                          $dater= $dr->format('m/d/Y');
		                      }
		                      else{
		                      	$dater="/";
		                      }

	    array_push ($data, array(
	                        	'id_car'=>$rowss["id_car"],
						        'brand'=>$rowss["brand"],
						        'model'=>$rowss["model"],
						        'image'=>$rowss["image"],
						        'year'=>$rowss["year"],
						        'price_flat'=>$rowss["price_flat"],
						        'price_day'=>$rowss["price_day"],
						        'citytaken'=>$rows["cityPickup"],
						        'datetaken'=>$date,
						        'cityreturn'=>$rows["cityReturn"],
						        'datereturn'=>$dater
		                      
				));
	    header('Content-Type:application/json;charset=utf-8');
	        echo json_encode($data);




	}
	else{
		echo "You are currently not renting!";
		exit();
	}

}