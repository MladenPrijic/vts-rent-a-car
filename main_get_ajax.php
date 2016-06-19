<?php
session_start();

if(isset($_SESSION["id_user"])){
  $sess_name = $_SESSION["id_user"];
}

include("php_includes/db_config.php");



if(isset($_SESSION["id_user"])){

    $sql = "SELECT * FROM user WHERE id_user='$sess_name'";

    if(1 > 0)
    {

        $result = mysqli_query($connect,$sql) or die(mysqli_error($connect));

        if (mysqli_num_rows($result)>0)
        {
	        while ($record = mysqli_fetch_array($result,MYSQLI_BOTH))
            {
            echo json_encode(array("$record[firstname]","$record[lastname]","$record[username]","$record[phone]","$record[email]","$record[street]","$record[city]","$record[zip]","$record[country]"));
            }
        }
    }
    else
        echo "No access!";
}
else
echo "No access";
?>
