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

     	$sql="UPDATE car SET rented=0 WHERE id_car='$id_car' ";
     	$sql1="UPDATE user SET id_car=0  ";
     	if($connect->query($sql))
     	    {
     		  echo "Car successefully freed!";
     	    }
     	else
     	    {
     	    	echo "Delete error!" .mysqli_error($connect);
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
						        'navigation'=>$row["navigation"]
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
						        'navigation'=>$row["navigation"]
				));
        	}

        	header('Content-Type:application/json;charset=utf-8');
	        echo json_encode($data);

        
     }

if(isset($_POST["user"]))
	{
		

		
				
	        		$sql="SELECT * FROM user";
	        		
	            
	        		$sql1="SELECT * FROM user WHERE id_car IS NOT NULL";
	        		
	        	
	        		$sql2="SELECT * FROM user WHERE id_car IS NULL";
	        		
			

		$data=[];
		$users=[];
		$result=mysqli_query($connect,$sql);
		if($result->num_rows > 0)
			{
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
					array_push($users,array('all'=>$data));
					

			}

			$data=[];
		
		$result=mysqli_query($connect,$sql1);
		
			
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
					array_push($users,array('rented'=>$data));
					

			

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
					

			

    