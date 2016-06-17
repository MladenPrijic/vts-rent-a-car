<?php
include ("php_includes/db_config.php");
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if(isset($_POST["forgot_username"])){
	$username=$_POST["forgot_username"];
	$email=$_POST["email"];
	$sql="SELECT * FROM user WHERE username='$username' AND email='$email' LIMIT 1";
	$result=mysqli_query($connect,$sql);
	$row=mysqli_fetch_array($result);
	$id_user=$row["id_user"];
	$newpass=generateRandomString();
	$salt1="oug}|{05=>";
    $salt2="y5-7|}h('{";
	$pass=md5(md5($salt1) .md5($newpass) .md5($salt2));
	$sql1="UPDATE user SET password='$pass' WHERE id_user='$id_user'";
	if($connect->query($sql1)){
		$to = $email;							 
		$from = "me@damir.tech";
		$subject = "Password change";
		$mess = "Your new password is: " .$newpass;
		$headers = "From: $email\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
		mail($to, $subject, $mess, $headers);
		header("Location: index.php?mess=1");
		exit();
	}



}