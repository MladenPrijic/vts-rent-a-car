<?php

include("db_config.php");
//Car delete
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
//Make car free again
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
//Loads all cars and their data
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



//get all, rented or free cars
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
//Loads users from the db
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
					if(!empty($data[0])){
					array_push($users,array('rented'=>$data));
				}
				else{
					array_push($users,array('rented'=>"Empty!"));

				}
				

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
//Inserts a new car in the db
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

	if(empty($brand) || empty($model) || empty($year) || empty($pricef) || empty($priced) || empty($location) || empty($seats) || empty($doors) || empty($luggage) || empty($description) || empty($image) ){
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
//gets the user data from the database, rent history, current rent
if(isset($_POST["id_carr"])){
	$id_car=$_POST["id_carr"];
	$firstname=$_POST["userr"];
	$sql="SELECT * FROM user WHERE id_car='$id_car' AND firstname='$firstname' LIMIT 1";
	
	$result=mysqli_query($connect,$sql);
	$row=mysqli_fetch_array($result);
	$id_user=$row["id_user"];
	
	////////////////////////////////////////////////////////////////
	$sql1="SELECT * FROM car WHERE id_car='$id_car' LIMIT 1";
	$res=mysqli_query($connect,$sql1);
	$rows=mysqli_fetch_array($res);
	/////////////////////////////////////////////////////////////////
    $sql3="SELECT * FROM rentedcars WHERE id_user='$id_user' AND id_car='$id_car' LIMIT 1";
    $ress=mysqli_query($connect,$sql3);
    $rowss=mysqli_fetch_array($ress);
	/////////////////////////////////////////////////////////////////
	$data=[];
	$dat=[];
	                              $dt = new DateTime($rowss["dateTaken"]);
		                          $date = $dt->format('m/d/Y');
			                      
			                      $dr= new DateTime($rowss["dateReturn"]);
		                          
		                          $dater= $dr->format('m/d/Y');
		                      	  
		                      
		                          
		                      
	array_push ($data, array(
	                        	
						        'firstname'=>$row["firstname"],
						        'lastname'=>$row["lastname"],
						        'username'=>$row["username"],
						        'email'=>$row["email"],
						        'phone'=>$row["phone"],
						        'brand'=>$rows["brand"],
						        'model'=>$rows["model"],
						        'image'=>$rows["image"],
						        'year'=>$rows["year"],
						        'price_flat'=>$rows["price_flat"],
						        'price_day'=>$rows["price_day"],
						        'citytaken'=>$rowss["cityPickup"],
						        'datetaken'=>$date,
						        'cityreturn'=>$rowss["cityReturn"],
						        'datereturn'=>$dater

						       
						        
						        
				        ));
	$dat["rented"]=$data;

	$data=[];
	array_push ($data, array(
	                        	
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
	$dat["userData"]=$data;
	


	$sql3="SELECT * FROM rentedcars WHERE id_user='$id_user'";
    $resss=mysqli_query($connect,$sql3);
    
    $dataa=[];
    while($rowsss=mysqli_fetch_array($resss)){
    	$car_id=$rowsss["id_car"];
    	$sqls="SELECT * FROM car WHERE id_car='$car_id'";
    	$r=mysqli_query($connect,$sqls);
    	$rr=mysqli_fetch_array($r);
    	$dt = new DateTime($rowsss["dateTaken"]);
	    $date = $dt->format('m/d/Y');
	    $dr= new DateTime($rowsss["dateReturn"]);
	    $dater= $dr->format('m/d/Y');
	      
	    
	  	  


    array_push ($dataa, array(
	                        	
						        'brand'=>$rr["brand"],
						        'model'=>$rr["model"],
						        'datetaken'=>$date,
						        'datereturn'=>$dater

						       
						        
						        
				        ));
}
$dat["history"]=$dataa;



	
header('Content-Type:application/json;charset=utf-8');
	                echo json_encode($dat);



}


//	Loads user data				
if(isset($_POST["id_userr"])){
	$id_user=$_POST["id_userr"];
	$firstname=$_POST["userr"];
	$sql="SELECT * FROM user WHERE id_user='$id_user' AND firstname='$firstname' LIMIT 1";
	
	$result=mysqli_query($connect,$sql);
	$row=mysqli_fetch_array($result);
	/////////////////////////////////////////////////////////////////////
	$data=[];
	$dat=[];
	array_push ($data, array(
	                        	
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
	$dat["userData"]=$data;
	$data=[];
	$sql1="SELECT * FROM rentedcars WHERE id_user='$id_user'";
	$res=mysqli_query($connect,$sql1);
	while($rows=mysqli_fetch_array($res)){
		$car_id=$rows["id_car"];
    	$sqls="SELECT * FROM car WHERE id_car='$car_id'";
    	$ress=mysqli_query($connect,$sqls);
    	$rowss=mysqli_fetch_array($ress);
    	$dt = new DateTime($rows["dateTaken"]);
	    $date = $dt->format('m/d/Y');
	    $dr= new DateTime($rows["dateReturn"]);
	    $dater= $dr->format('m/d/Y');

		array_push ($data, array(
	                        	
						        'brand'=>$rowss["brand"],
						        'model'=>$rowss["model"],
						        'datetaken'=>$date,
						        'datereturn'=>$dater
						        

						       
						        
						        
				        ));

	}
	$dat["history"]=$data;
	header('Content-Type:application/json;charset=utf-8');
	echo json_encode($dat);




}
//Checks if the car is already rented
if(isset($_POST["id_car_rentt"])){
	$id_car=$_POST["id_car_rentt"];
	$sqls="SELECT * FROM car WHERE id_car='$id_car' LIMIT 1";
	$res=mysqli_query($connect,$sqls);
	$row=mysqli_fetch_array($res);
	if($row["rented"] == 1){
		echo "This car is already rented!";
		exit();
	}
	$sql="UPDATE car SET rented=1 WHERE id_car='$id_car'";
	if($connect->query($sql)){
		echo "Car successefully rented!";
	}
}
//loads messages from the database
if(isset($_POST["showMessage"])){
	$id_car=$_POST["showMessage"];
	$sql="SELECT * FROM messages WHERE id_car='$id_car'";
	$result=mysqli_query($connect,$sql);
	$data=[];
	while($row=mysqli_fetch_array($result)){
		$id_user=$row["id_user"];
		$sql1="SELECT * FROM user WHERE id_user='$id_user' LIMIT 1";
		$result1=mysqli_query($connect,$sql1);
		$row1=mysqli_fetch_array($result1);
		$dt = new DateTime($row["dateLeft"]);
	    $date = $dt->format('m/d/Y');
		array_push ($data, array(
	                        	
						        'message'=>$row["message"],
						        'dateleft'=>$date,
						        'firstname'=>$row1["firstname"],
						        'lastname'=>$row1["lastname"]
						        

						       
						        
						        
				        ));


	}
	header('Content-Type:application/json;charset=utf-8');
	echo json_encode($data);

}

    