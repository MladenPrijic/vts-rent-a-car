<?php
session_start();

if(isset($_SESSION["id_user"])){
  $sess_name = $_SESSION["id_user"];
}


//var_dump(session_id());
include("php_includes/db_config.php");

$sql = "";
$date= "";
//var_dump($_SERVER['HTTP_REFERER']);

//if(isset($_POST['sql']) AND isset($_POST['token']) AND strlen($_POST['token'])==32)

if(isset($_SESSION["id_user"])){

    //$sql=(int)mysqli_real_escape_string($connection,$_POST['sql']);
    //$date=mysqli_real_escape_string($connection,$_POST['pdate']);

    $sql = "SELECT * FROM user WHERE id_user='$sess_name'";
    //$sqls[2] = "SELECT l.ip_address, l.browser, l.datetime, u.username FROM log as l, user as u WHERE u.id_user=l.id_user AND l.datetime LIKE '$date%'";

    if(1 > 0)
    {
        //$result= mysqli_query($connection,$sqls[$sql]) or die(mysqli_error($connection));
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
