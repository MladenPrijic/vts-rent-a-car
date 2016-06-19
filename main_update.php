<?php
include("php_includes/db_config.php");


if(isset($_POST["u"])){

	$username=mysqli_real_escape_string($connect,$_POST["u"]);
	$first_name=mysqli_real_escape_string($connect,$_POST["fn"]);
	$last_name=mysqli_real_escape_string($connect,$_POST["ln"]);
	$password=$_POST["p"];
	$email=$_POST["e"];
	$phone=$_POST["phone"];
	$street=mysqli_real_escape_string($connect,$_POST["s"]);
	$city=mysqli_real_escape_string($connect,$_POST["c"]);
	$zip=$_POST["z"];
	$country=mysqli_real_escape_string($connect,$_POST["co"]);

	$sql="SELECT * FROM user WHERE username='$username' LIMIT 1";
	$sql1="SELECT * FROM user WHERE email='$email' LIMIT 1";

	$result1=mysqli_query($connect,$sql);
	$result2=mysqli_query($connect,$sql1);

	$row=mysqli_fetch_array($result1);
	$user_id=$row["id_user"];


	if(empty($username) || empty($first_name) || empty($last_name) || empty($password) || empty($email) || empty($phone) || empty($street) || empty($city) || empty($zip) || empty($country) ){
		if(empty($password)){ echo "<br />Please confirm your password!"; }
		else { echo "You did not fill in all the data!"; }
		exit();
	}
	elseif(strlen($username) < 4 || strlen($username) > 16){
		echo "Username has to be between 4 and 16 characters!";
		exit();
	}

	elseif(is_numeric($username[0])){
		echo "Username cannot start with a number!";
		exit();
	}
	else{
		$salt1="oug}|{05=>";
    $salt2="y5-7|}h('{";
		$pass=md5(md5($salt1) .md5($password) .md5($salt2));

		$sql="UPDATE user SET firstname='$first_name', lastname='$last_name',username='$username',password='$pass',email='$email',phone='$phone',street='$street',city='$city',zip='$zip',country='$country' WHERE id_user='$user_id' AND password='$pass'";

		if($connect->query($sql)){
			echo "Data successefully updated.";
		}
		else{
			echo "Update error!";
		}
	}

}
