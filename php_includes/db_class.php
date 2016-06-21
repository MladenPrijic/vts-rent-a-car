<?php

class DB extends mysqli{
	public function __construct($host,$user,$pass,$db){
		$this->db= new mysqli($host,$user,$pass,$db);
	}
	public function q($sql){
		return mysqli_query($this->db,$sql);
	}

	public function select($what,$table,$where,$limit){
		$where=$this->where($where);
		$sql="SELECT $what FROM $table WHERE $where $limit";
		//return $sql;
		 $result=$this->q($sql);
		 return $result;
		
	}
	public function where($where){
		if(is_array($where)){
			$data="";
			foreach($where as $key=>$val){
				if(!empty($val) || is_numeric($val)){
				$data.=$key ."=" .$val ." AND ";
			}
			}
			$data=substr($data, 0, -4);
		}
		else{
			return $where;
		}
		
		return $data;
	}
}
$ar=['rented'=>0,'brand'=>'Mercedes'];
$base=new DB("sql310.freesubdomain.org","frsb_16959767","vlado107","frsb_16959767_rentacar");
//echo $base->where($ar);
$result=$base->select("*","car",$ar,"");
//echo $result;
while($row=mysqli_fetch_array($result)){
	echo $row["brand"] ."<br>";
	echo $row["model"] ."<br>";
}

