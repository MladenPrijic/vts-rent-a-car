<?php
session_start();
include("php_includes/db_config.php");

// function cryptPass($pass){
// 		$salt1="oug}|{05=>";
// 		$salt2="y5-7|}h('{";

// 		$pass=md5(md5($salt1) .md5($pass) .md5($salt2));

// 		for($i=0;$i<2;$i++){
// 			$pass = md5($pass);
//             $pass = md5($pass);
//             $pass = bin2hex($pass);
//             $pass = sha1($pass);

// 		}

// 		return $pass;

// 	}

if(isset($_POST["login_username"]) && isset($_POST["login_password"])){
	$username=mysqli_real_escape_string($connect,$_POST["login_username"]);
	$password=$_POST["login_password"];
	$salt1="oug}|{05=>";
    $salt2="y5-7|}h('{";
		$pass=md5(md5($salt1) .md5($password) .md5($salt2));

	$sql="SELECT * FROM user WHERE username='$username' AND password='$pass' LIMIT 1";

	$result=mysqli_query($connect,$sql);
	$row=mysqli_fetch_array($result);
	$id_user=$row["id_user"];

	if($result->num_rows > 0){
		$_SESSION["id_user"]=$id_user;
		header("Location:main.php");
		exit();
	}
	else{
		header("Location: index.php?error=1");
	}

}
// 
