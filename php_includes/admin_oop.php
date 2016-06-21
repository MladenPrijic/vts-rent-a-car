<?php

include ("db_config.php");

class Car{
	public function __construct(){

	}
	//ZA BRISANJE AUTA
	public function carDelete($id_car){
		$sql="DELETE FROM car WHERE id_car='$id_car' LIMIT 1";
		if($connect->query($sql)){
			echo "Delete succes!";
		}
		else{
			echo mysqli_error($connect);
		}

	}
	//UZIMA AUTO PO ID-U
	public function getCarbyId($id,$limit){
		$sql="SELECT * FROM car WHERE id_car='$id' '$limit'";
		$result=mysqli_query($connect,$sql);
		return $result;
	}
	//UZIMA KORISNIKA PO ID-U
	public function getUserById($id){
		$sql="SELECT * FROM user WHERE id_user='$id' LIMIT 1";
		$result=mysqli_query($connect,$sql);
		return mysqli_fetch_array($result);
	}
	//UZIMA USERA PO ID-U AUTA
	public function getUserCar($id){
		$sql="SELECT * FROM user WHERE id_car='$id' LIMIT 1";
		$result=mysqli_query($connect,$sql);
		return mysqli_fetch_array($result);
	}
	//UZIMA VREDNOSTI IZ RENTED CARS PO USERU I AUTU
	public function getRentedData($id_car,$id_user,$limit){
		$sql="SELECT * FROM rentedcars WHERE id_user='$id_user' AND id_car='$id_car' '$limit'";
		$result=mysqli_query($connect,$sql);
		return mysqli_fetch_array($result);
	}

	// UZIMA SVE AUTE U ZAVISNOSTI DA LI SU IZNAJMLJENI
	public function carsAll($val){
		switch ($val) {
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
		                          $row1=$this->getUserCar($id_car);
		                          $id_user=$row1["id_user"];
		                          //DATE FROM RENTED CARS
		                          $row2=$this->getRentedData($id_user,$id_car);
		                          if(!empty($row2["dateTaken"])){
		                          	$dt = new DateTime($row2["dateTaken"]);
		                            $date = $dt->format('m/d/Y');
		                          }
		                           else
		                           {
		                      	           $date="/";
		                           }
		                           if(!empty($row2["dateReturn"])){
		                          $dr= new DateTime($row2["dateReturn"]);
		                          $dater= $dr->format('m/d/Y');
			                      }
			                      else
			                      {
			                      	$dater="/";
			                      }
                                      //UBACUJE U DATA ARRAY SVE PODATKE
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

}