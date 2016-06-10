<?php
include("php_includes/db_config.php");


//THis function crypts the password
 // function cryptPass($pass){
	// 	$salt1="oug}|{05=>";
	// 	$salt2="y5-7|}h('{";

	// 	$pass=md5(md5($salt1) .md5($pass) .md5($salt2));

	// 	for($i=0;$i<2;$i++){
	// 		$pass = md5($pass);
 //            $pass = md5($pass);
 //            $pass = bin2hex($pass);
 //            $pass = sha1($pass);

	// 	}

	// 	return $pass;

	// }
//This is checking if the username exists in the database
if(isset($_POST["us"])){
	$username=$_POST["us"];

	if(!empty($username)){
		$sql="SELECT * FROM user WHERE username='$username' LIMIT 1";

		$result=mysqli_query($connect,$sql);
		if($result->num_rows > 0){
			echo "This username is taken!";
		}


	}
}
//This is the function for registering, checks if all input is valid again, checks if username and email exist in
//the databse again, and registers the user. After returns the link for the log in page
if(isset($_POST["u"])){

	$username=mysqli_real_escape_string($connect,$_POST["u"]);
	$first_name=mysqli_real_escape_string($connect,$_POST["fn"]);
	$last_name=mysqli_real_escape_string($connect,$_POST["ln"]);
	$password=$_POST["p"];
	$confirm_password=$_POST["cp"];
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


	if(empty($username) || empty($first_name) || empty($last_name) || empty($password) || empty($confirm_password) || empty($email) || empty($phone) || empty($street) || empty($city) || empty($zip) || empty($country) ){
		echo "You did not fill in all the data!";
		exit();
	}
	elseif(strlen($username) < 4 || strlen($username) > 16){
		echo "Username has to be between 4 and 16 characters!";
		exit();
	}
	elseif($password != $confirm_password){
		echo "Passwords have to match!";
		exit();
	}
	elseif(mysqli_num_rows($result1)){
		echo "Username already taken!";
		exit();
	}
	elseif(mysqli_num_rows(($result2))){
		echo "Email already taken!";
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

		$sql="INSERT INTO user(firstname,lastname,username,password,email,phone,street,city,zip,country) VALUES('$first_name','$last_name','$username','$pass','$email','$phone','$street','$city','$zip','$country')";

		if($connect->query($sql)){
			echo "Registration success! Please log in to continue.";
		}
		else{
			echo "Registration error!";
		}
	}

}
