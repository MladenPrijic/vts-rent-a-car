<?php
session_start();
include("db_config.php");

exit();
	$username=mysqli_real_escape_string($connect,$_POST["username"]);
	$password=$_POST["password"];
	$salt1="oug}|{05=>";
  $salt2="y5-7|}h('{";
	$pass=md5(md5($salt1) .md5($password) .md5($salt2));

	$sql="SELECT * FROM user WHERE username='$username' AND password='$pass' LIMIT 1";

	$result=mysqli_query($connect,$sql);
	$row=mysqli_fetch_array($result);
	$id_user=$row["id_user"];

	if($result->num_rows > 0){
		$_SESSION["id_user"]=$id_user;
		echo 1;
		exit();
	}
	else{
		echo 2;
	}
