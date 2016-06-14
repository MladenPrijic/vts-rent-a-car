<?php

include("db_config.php");

if(isset($_POST["id_car_del"]))
     {
     	$id_car=$_POST["id_car_del"];
     	$sql="DELETE FROM car WHERE id_car='$id_car'";
     	if($connect->query($sql))
     	    {
     		  echo "Car successefully deleted!";
     	    }
     	else
     	    {
     	    	echo "Delete error!" .mysqli_error($connect);
     	    }

     }

if(isset($_POST["id_car_free"]))
     {
     	$id_car=$_POST["id_car_free"];
     	$sql="SELECT * FROM car WHERE id_car='$id_car' LIMIT 1 ";
     	$result=mysqli_query($connect,$sql);
     	$row=mysqli_fetch_array($result);
     	if($row["rented"] == 0)
     		{
     			echo "Car already free!";
     			exit();
     		}
     		//////////////////////////////////////////////////
     		$sql2="SELECT * FROM user WHERE id_car='$id_car' LIMIT 1";
     		$res=mysqli_query($connect,$sql2);
     	    $rows=mysqli_fetch_array($res);
     	    $id_user=$rows["id_user"];
     		////////////////////////////////////////////////////
     		// $sql3="SELECT * FROM rentedcars WHERE id_car='$id_car' AND id_user='$id_user' ";
     		// $res1=mysqli_query($connect,$sql3);
     	 //    $rows1=mysqli_fetch_array($res1);
     		/////////////////////////////////////////////////////////

     	$sql="UPDATE car SET rented=0 WHERE id_car='$id_car' ";
     	$sql1="UPDATE user SET id_car= NULL WHERE id_user='$id_user'  ";
     	if($connect->query($sql) && $connect->query($sql1))
     	    {
     		  echo "Car successefully freed!";
     	    }
     	else
     	    {
     	    	echo "Delete error!" .mysqli_error($connect) ;
     	    }

     }

if(isset($_POST["some"]))
	 {
	 	$sql="SELECT * FROM car";

	 	$result=mysqli_query($connect,$sql);
        $data=[];
        	while($row=mysqli_fetch_array($result))
        	           {
        		            if($row["automatic"] == 1)
        		                  {
			                        $row["automatic"]= "Automatic";
		                          }
		                    else
		                          {
			                        $row["automatic"]= "Manual";
		                          }
		                    if($row["navigation"] == 1)
		                          {
			                        $row["navigation"]= "Yes";
		                          }
		                    else
		                          {
			                        $row["navigation"]= "No";
		                          }
		                    if($row["air_conditioning"] == 1)
		                          {
			                        $row["air_conditioning"]= "Yes";
		                          }
		                    else
		                          {
			                        $row["air_conditioning"]= "No";
		                          }
		                           $id_car=$row["id_car"];
		                          $sqll="SELECT * FROM user WHERE id_car='$id_car' LIMIT 1";
		                          $res=mysqli_query($connect,$sqll);
		                          $rows=mysqli_fetch_array($res);
		                          $id_user=$rows["id_user"];

		                          //////////////////////////////////////////////////////
		                          $sqls="SELECT * FROM rentedcars WHERE id_user='$id_user' AND id_car='$id_car' LIMIT 1 ";
		                          $ress=mysqli_query($connect,$sqls);
		                          $rowss=mysqli_fetch_array($ress);
		                          if(!empty($rowss["dateTaken"])){
		                          $dt = new DateTime($rowss["dateTaken"]);
		                          $date = $dt->format('m/d/Y');
		                      }
		                      else{
		                      	$date="/";
		                      }
		                      if(!empty($rowss["dateReturn"])){
		                          $dr= new DateTime($rowss["dateReturn"]);
		                          $dater= $dr->format('m/d/Y');
		                      }
		                      else{
		                      	$dater="/";
		                      }
	                        array_push ($data, array(
	                        	'id_car'=>$row["id_car"],
						        'brand'=>$row["brand"],
						        'model'=>$row["model"],
						        'image'=>$row["image"],
						        'year'=>$row["year"],
						        'price_flat'=>$row["price_flat"],
						        'price_day'=>$row["price_day"],
						        'location'=>$row["location"],
						        'seats'=>$row["seats"],
						        'doors'=>$row["doors"],
						        'automatic'=>$row["automatic"],
						        'air_conditioning'=>$row["air_conditioning"],
						        'luggage'=>$row["luggage"],
						        'description'=>$row["description"],
						        'navigation'=>$row["navigation"],
						        'firstname'=>$rows["firstname"],
						        'lastname'=>$rows["lastname"],
						        'citytaken'=>$rowss["cityPickup"],
						        'datetaken'=>$date,
						        'cityreturn'=>$rowss["cityReturn"],
						        'datereturn'=>$dater
				));
        	}

        	header('Content-Type:application/json;charset=utf-8');
	        echo json_encode($data);

	 }




if(isset($_POST["cars"]))
	 {
        $cars=$_POST["cars"];
        switch ($cars) {
        	case 'all':
        		$sql="SELECT * FROM car";
        		break;
            case 'rented':
        		$sql="SELECT * FROM car WHERE rented=1";
        		break;
        	case 'free':
        		$sql="SELECT * FROM car WHERE rented=0";
        		break;
        	
        	
        }

        $result=mysqli_query($connect,$sql);
          $data=[];
        	while($row=mysqli_fetch_array($result))
        	           {

        		            if($row["automatic"] == 1)
        		                  {
			                        $row["automatic"]= "Automatic";
		                          }
		                    else
		                          {
			                        $row["automatic"]= "Manual";
		                          }
		                    if($row["navigation"] == 1)
		                          {
			                        $row["navigation"]= "Yes";
		                          }
		                    else
		                          {
			                        $row["navigation"]= "No";
		                          }
		                    if($row["air_conditioning"] == 1)
		                          {
			                        $row["air_conditioning"]= "Yes";
		                          }
		                    else
		                          {
			                        $row["air_conditioning"]= "No";
		                          }
		                          $id_car=$row["id_car"];
		                          $sqll="SELECT * FROM user WHERE id_car='$id_car' LIMIT 1";
		                          $res=mysqli_query($connect,$sqll);
		                          $rows=mysqli_fetch_array($res);
		                          $id_user=$rows["id_user"];

		                          //////////////////////////////////////////////////////
		                          $sqls="SELECT * FROM rentedcars WHERE id_user='$id_user' AND id_car='$id_car' LIMIT 1 ";
		                          $ress=mysqli_query($connect,$sqls);
		                          $rowss=mysqli_fetch_array($ress);
		                          if(!empty($rowss["dateTaken"])){
		                          $dt = new DateTime($rowss["dateTaken"]);
		                          $date = $dt->format('m/d/Y');
		                      }
		                      else{
		                      	$date="/";
		                      }
		                      if(!empty($rowss["dateReturn"])){
		                          $dr= new DateTime($rowss["dateReturn"]);
		                          $dater= $dr->format('m/d/Y');
		                      }
		                      else{
		                      	$dater="/";
		                      }
		                          
	                        array_push ($data, array(
	                        	'id_car'=>$row["id_car"],
						        'brand'=>$row["brand"],
						        'model'=>$row["model"],
						        'image'=>$row["image"],
						        'year'=>$row["year"],
						        'price_flat'=>$row["price_flat"],
						        'price_day'=>$row["price_day"],
						        'location'=>$row["location"],
						        'seats'=>$row["seats"],
						        'doors'=>$row["doors"],
						        'automatic'=>$row["automatic"],
						        'air_conditioning'=>$row["air_conditioning"],
						        'luggage'=>$row["luggage"],
						        'description'=>$row["description"],
						        'navigation'=>$row["navigation"],
						        'firstname'=>$rows["firstname"],
						        'lastname'=>$rows["lastname"],
						        'citytaken'=>$rowss["cityPickup"],
						        'datetaken'=>$date,
						        'cityreturn'=>$rowss["cityReturn"],
						        'datereturn'=>$dater
		                      
				));
        	}

        	header('Content-Type:application/json;charset=utf-8');
	        echo json_encode($data);

        
     }

if(isset($_POST["user"]))
	{
		

		
				
	        		
	        		
	            
	        		$sql1="SELECT * FROM user WHERE id_car IS NOT NULL";
	        		
	        	
	        		$sql2="SELECT * FROM user WHERE id_car IS NULL";
	        		
	        		

	        		
			

		$data=[];
		$users=[];
		$result=mysqli_query($connect,$sql1);
		if($result->num_rows > 0)
			{
				while($row=mysqli_fetch_array($result))
					{
						$car=$row["id_car"];
						$sql3="SELECT * FROM car WHERE id_car='$car' LIMIT 1 ";
						$res=mysqli_query($connect,$sql3);
						$rowc=mysqli_fetch_array($res);
						$carName=$rowc["brand"] ." " .$rowc["model"];

						array_push ($data, array(
	                        	'id_user'=>$row["id_user"],
						        'firstname'=>$row["firstname"],
						        'lastname'=>$row["lastname"],
						        'username'=>$row["username"],
						        'email'=>$row["email"],
						        'phone'=>$row["phone"],
						        'street'=>$row["street"],
						        'city'=>$row["city"],
						        'zip'=>$row["zip"],
						        'country'=>$row["country"],
						        'car_name'=>$carName,
						        'id_car'=>$car,
						        
				        ));


					}
					array_push($users,array('rented'=>$data));
					

			}

			$data=[];
		
		$result=mysqli_query($connect,$sql2);
		
			
				while($row=mysqli_fetch_array($result))
					{
						array_push ($data, array(
	                        	'id_user'=>$row["id_user"],
						        'firstname'=>$row["firstname"],
						        'lastname'=>$row["lastname"],
						        'username'=>$row["username"],
						        'email'=>$row["email"],
						        'phone'=>$row["phone"],
						        'street'=>$row["street"],
						        'city'=>$row["city"],
						        'zip'=>$row["zip"],
						        'country'=>$row["country"],
						        
				        ));


					}
					array_push($users,array('free'=>$data));
					

			

			


					
					
					header('Content-Type:application/json;charset=utf-8');
	                echo json_encode($users);
}

if(isset($_POST["b"])){
	
	$brand=mysqli_real_escape_string($connect,$_POST["b"]);
	$model=mysqli_real_escape_string($connect,$_POST["m"]);
	$year=mysqli_real_escape_string($connect,$_POST["y"]);
	$image=$_POST["i"];
	$pricef=$_POST["pf"];
	$priced=$_POST["pd"];
	$location=$_POST["l"];
	$seats=$_POST["s"];
	$doors=$_POST["d"];
	$automatic=$_POST["a"];
	$air_conditioning=$_POST["ac"];
	$luggage=$_POST["lu"];
	$navigation=$_POST["n"];
	$description=mysqli_real_escape_string($connect,$_POST["de"]);

	if(empty($brand) || empty($model) || empty($year) || empty($pricef) || empty($priced) || empty($location) || empty($seats) || empty($doors) || empty($automatic) ||  empty($air_conditioning) || empty($luggage) || empty($navigation) || empty($description) || empty($image) ){
		echo "You did not fill in all the fields!";
	}
	else{
		$sql="INSERT INTO car(brand,model,image,year,price_flat,price_day,location,seats,doors,automatic,air_conditioning,luggage,description,navigation)  VALUES('$brand','$model','$image','$year','$pricef', '$priced','$location','$seats','$doors','$automatic','$air_conditioning','$luggage','$description','$navigation' )";
		if($connect->query($sql)){
			echo "You successefully inserted " .$brand ." " .$model;
		}
		else{
			echo "Insert error!" .mysqli_error($connect);
		}
	}
}
					

			

    