<?php
//Loads the user data in the main.php
include ("db_config.php");
if(isset($_POST["id_user"])){
	$id_user=$_POST["id_user"];
	$sql="SELECT * FROM user WHERE id_user='$id_user' LIMIT 1";
	$result=mysqli_query($connect,$sql);
	$row=mysqli_fetch_array($result);
	$data=[];
	$dat=[];
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
	    $dat["current"]=$data;
	    $data=[];
	$sqls1="SELECT * FROM rentedcars WHERE id_user='$id_user' ORDER BY dateTaken DESC LIMIT 1";
	$result1=mysqli_query($connect,$sqls1);
	while($rows1=mysqli_fetch_array($result1)){
		$car_id=$rows1["id_car"];
    	$sqls2="SELECT * FROM car WHERE id_car='$car_id'";
    	$result2=mysqli_query($connect,$sqls2);
    	$rows2=mysqli_fetch_array($result2);
		$dt = new DateTime($rows1["dateTaken"]);
	    $date = $dt->format('m/d/Y');
	    $dr= new DateTime($rows1["dateReturn"]);
	    $dater= $dr->format('m/d/Y');

		array_push ($data, array(
	                        	'brand'=>$rows2["brand"],
						        'model'=>$rows2["model"],
						        'datetaken'=>$date,
						        'datereturn'=>$dater,
						        'id_car'=>$car_id,
						        'id_user'=>$id_user

				));


	}
	$dat["history"]=$data;
	header('Content-Type:application/json;charset=utf-8');
	echo json_encode($dat);





	}
	else{
		$data=[];
	$sqls1="SELECT * FROM rentedcars WHERE id_user='$id_user' ORDER BY dateTaken DESC LIMIT 1";
	$result1=mysqli_query($connect,$sqls1);
	$rows1=mysqli_fetch_array($result1);
		$car_id=$rows1["id_car"];
    	$sqls2="SELECT * FROM car WHERE id_car='$car_id'";
    	$result2=mysqli_query($connect,$sqls2);
    	$rows2=mysqli_fetch_array($result2);
		$dt = new DateTime($rows1["dateTaken"]);
	    $date = $dt->format('m/d/Y');
	    $dr= new DateTime($rows1["dateReturn"]);
	    $dater= $dr->format('m/d/Y');

		array_push ($data, array(
	                        	'brand'=>$rows2["brand"],
						        'model'=>$rows2["model"],
						        'datetaken'=>$date,
						        'datereturn'=>$dater,
						        'id_car'=>$car_id,
						        'id_user'=>$id_user


				));


	
	$dat["history"]=$data;
	header('Content-Type:application/json;charset=utf-8');
	echo json_encode($dat);




	}

}
//inserts the message in the db
if(isset($_POST["user_id"])){
	$id_user=$_POST["user_id"];
	$id_car=$_POST["id_car"];
	$message=mysqli_real_escape_string($connect,$_POST["message"]);
	if($message==""){
		echo "Write a message for us!";
		exit();
	}
	$sql="INSERT INTO messages(id_user,id_car,message,dateLeft) VALUES ('$id_user','$id_car','$message',now())";
	if($connect->query($sql)){
		echo "Thank you for leaving us feedback!";
	}
	else{
		echo mysqli_error($connect);
	}

}
//requests new password
if(isset($_POST["newpass"])){
	$current=$_POST["current"];
	$new=$_POST["newpass"];
	$conf=$_POST["newconfirm"];
	$id_user=$_POST["id_user"];
	$salt1="oug}|{05=>";
  $salt2="y5-7|}h('{";
	$pass=md5(md5($salt1) .md5($current) .md5($salt2));
	$passNew=md5(md5($salt1) .md5($conf) .md5($salt2));


	if(empty($current) || empty($new) || empty($conf)){
		echo "You did not fill in all the fields!";
		exit();
	}
	if($new != $conf){
		echo "New password and confirm password fields have to match!";
		exit();
	}
	$sql="SELECT * FROM user WHERE id_user='$id_user' AND password='$pass'";
	$result=mysqli_query($connect,$sql);
	if($result->num_rows > 0){
		$sqls="UPDATE user SET password='$passNew' WHERE id_user='$id_user'";
		if($connect->query($sqls)){
			echo "Your password has been changed!";
		}

	}
	else{
		echo "You entered the wrong password!";
	}

}
//Sends a message through the contact form
if(isset($_POST["mess"])){
	$message=$_POST["mess"];
	$firstname=$_POST["firstname"];
	$lastname=$_POST["lastname"];
	$email=$_POST["email"];
	    $to = "me@damir.tech";							 
		$from = $email;
		$subject = $firstname ." " .$lastname ." has contacted you!";
		$mess = $message;
		$headers = "From: $email\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
		mail($to, $subject, $mess, $headers);
		echo "You successefully sent a message! We will respond shortly.";
		exit();

}
