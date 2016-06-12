<?php

include ("db_config.php");

$sql="SELECT * FROM user";
$sql2="SELECT * FROM user WHERE id_car IS NOT NULL";
$sql3="SELECT * FROM user WHERE id_car IS NULL";

$result=mysqli_query($connect,$sql2);
if($result->num_rows > 0 ){
while($row=mysqli_fetch_array($result)){
	echo $row["id_user"] .$row["username"] ."<br>";
}
}else{echo "no";}