<?php

class DB extends mysqli{
	public function __construct($host,$user,$pass,$db){
		$this->db= new mysqli($host,$user,$pass,$db);
	}
	//GLAVNE FUNKCIJE
	public function q($sql){
		return mysqli_query($this->db,$sql);
	}

	public function select($what,$table,$where,$limit=""){
		$where=$this->where($where);
		if(!empty($limit)){$limit="LIMIT " .$limit;}
		$sql="SELECT $what FROM $table WHERE $where $limit";
		//return $sql;
		 $result=$this->q($sql);
		 return $result;
		
	}
	
	public function update($table,$set,$where){
		if(empty($table)){return false;}
		if(empty($set)){return false;}
		if(empty($where)){return false;}
		$set=$this->set($set);
		$where=$this->where($where);
		$sql="UPDATE $table SET $set WHERE $where";
		return $sql;
		$result=$this->q($sql);
		return $result;
	}

	public function insert($table,$field,$val){
		if(empty($table)){return false;}
		if(empty($field)){return false;}
		if(empty($val)){return false;}
		$field=$this->insertField($field);
		$val=$this->insertVals($val);
		$sql="INSERT INTO $table($field) VALUES ($val)";
		return $sql;

	}
	public function delete($table,$where,$limit){
		if(empty($table)){return false;}
		if(empty($where)){return false;}
		if(empty($limit)){$limit="";}
		$where=$this->where($where);
		$sql="DELETE FROM $table WHERE $where $limit";
		return $sql;

        $result=$this->q($sql);
        return $result;


	}
	//POMOCNE FUNKCIJE

	public function where($where){
		if(is_array($where)){
			$data="";
			foreach($where as $key=>$val){
				if(!empty($val) || is_numeric($val)){
				$data.=$key ."='" .$val ."' AND ";
			}
			}
			$data=substr($data, 0, -4);
		}
		else{
			return $where;
		}
		
		return $data;
	}

	public function set($set){
		if(is_array($set)){
			$data="";
			foreach($set as $key=>$val){
				if(!empty($val) || is_numeric($val)){
				$data.=$key ."='" .$val ."', ";
			}
			}
			$data=substr($data, 0, -2);
		}
		else{
			return $set;
		}
		return $data;
	}

	public function insertField($fields){
		if(is_array($fields)){
			$data="";
			foreach($fields as $key=>$val){
				$data.="'" .$key ."', ";
			}
			$data=substr($data, 0, -2);
		}
		else{
			return $fields;
		}
		return $data;
	}
	public function insertVals($vals){
		if(is_array($vals)){
			$data="";
			foreach($vals as $key=>$val){
				if(is_string($val)){
				$data.="'" .$val ."', ";
			}
			else{
				$data.=$val .",";

			}
			}
			$data=substr($data, 0, -2);
		}
		else{
			return $vals;
		}
		return $data;

	}

	}


 //$ar=['rented'=>0,'brand'=>'Zastava'];
 //$base=new DB("localhost","vekki","","rent-a-car");
//echo $base->where($ar);
//$result=$base->select("*","car",$ar,"");
//echo $result;
// while($row=mysqli_fetch_array($result)){
// 	echo $row["brand"] ."<br>";
// 	echo $row["model"] ."<br>";
// }
 //echo $base->insert("car",$ar,$ar);


 

