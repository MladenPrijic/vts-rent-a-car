<?php
include("php_includes/db_config.php");


if(isset($_POST["us"])){

	$current_password=$_POST["p0"];
	$change_password=$_POST["p1"];
	$confirm_password=$_POST["p2"];


	$user_id=$row["id_user"];


	if(empty($current_password) || empty($change_password) || empty($confirm_password)){
		if(empty($current_password)){ echo "<br />Please confirm your current password!"; }
		exit();
	}
	elseif($change_password != $confirm_password){
		echo "Passwords have to match!";
		exit();
	}
	else{
		$salt1="oug}|{05=>";
    $salt2="y5-7|}h('{";
		$pass=md5(md5($salt1) .md5($change_password) .md5($salt2));

		$sql="UPDATE user SET password='$pass' WHERE id_user='$user_id' AND password='$pass'";

		if($connect->query($sql)){
			echo "Data successefully updated.";
		}
		else{
			echo "Update error!";
		}
	}

}
