<?php 
	function db_connect(){
		$mysql_host = "localhost";
		$mysql_user = "MedMngt";
		$mysql_pass = "f2BsBQDdzXnerwEn";
		$mysql_db = "MedMngt";
		//$mysql_user = "root";
		//$mysql_pass = "";
		//$mysql_db = "doh_web_service";

		$connect = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		set_time_limit (0);
		return $connect;
	}
	
	
	function connect($user_id, $user_password) {
		
		$connect = db_connect();
		$query = 
			"SELECT hospital_password 
			FROM registered_hospitals 
			WHERE hospital_Id = '".$user_id."'";
		$password = mysqli_fetch_array(mysqli_query($connect, $query))[0];
		
		if($password === md5($user_password)){
			return $user_id;
		}
		return false;
	}
	
	function setField($value, $user_id, $field_id){
		
		$connect = db_connect();
		$query = 
				"SELECT field_name 
				FROM fields 
				WHERE field_id = '" . $field_id . "'";
		$type = mysqli_fetch_array(mysqli_query($connect, $query))[0];
		
		if($user_id !== false){
			
			$query = 
				"SELECT COUNT(field_value) 
				FROM field_values 
				WHERE field_id = '" . $field_id . "' 
				AND hospital_id = '" . $user_id . "'";
			$result = mysqli_fetch_array(mysqli_query($connect, $query))[0];
			
			if($result != 0){
				if($value){
					
					$query = 
						"UPDATE field_values
						SET	field_value = '" . mysqli_real_escape_string($connect, $value) . "'
						WHERE field_id = '" . $field_id . "' 
						AND hospital_id = '" . $user_id . "'";
					mysqli_query($connect, $query);
					
					mysqli_close($connect);
					return $type . " has been updated to " . $value . "<br>";
				} else{
					$query = 
						"DELETE FROM field_values
						WHERE field_id = '" . $field_id . "' 
						AND hospital_id = '" . $user_id . "'";
					mysqli_query($connect, $query);
					
					mysqli_close($connect);
					return $type . " has been deleted.<br>";
				}
			}
			else{
				if($value){
					$query = 
						"INSERT INTO `field_values`(`hospital_id`,`field_id`,`field_value`) 
						VALUES ('" . $user_id . "','" . $field_id . "','" . mysqli_real_escape_string($connect, $value) . "')";
					mysqli_query($connect, $query);
					
					mysqli_close($connect);
					return $type . " has been added with value: " . $value . "<br>";
				}
				return false;
			}
		} 
		return false;
	}
	
	function setRemark($remark, $user_id, $field_id){
		
		$connect = db_connect();
		$query = 
				"SELECT field_name 
				FROM fields 
				WHERE field_id = '" . $field_id . "'";
		$type = mysqli_fetch_array(mysqli_query($connect, $query))[0];
		
		if($user_id !== false){
			
			$query = 
				"SELECT COUNT(field_remark) 
				FROM field_remarks 
				WHERE field_id = '" . $field_id . "' 
				AND hospital_id = '" . $user_id . "'";
			$result = mysqli_fetch_array(mysqli_query($connect, $query))[0];
			
			if($result != 0){
				if($remark){
					$query = 
						"UPDATE field_remarks
						SET	field_remark = '" . mysqli_real_escape_string($connect, $remark) . "'
						WHERE field_id = '" . $field_id . "' 
						AND hospital_id = '" . $user_id . "'";
					mysqli_query($connect, $query);
					
					mysqli_close($connect);
					return "Remarks for " . $type . " has been updated: " . $remark . "<br>";
				} else{
					$query = 
						"DELETE FROM field_remarks
						WHERE field_id = '" . $field_id . "' 
						AND hospital_id = '" . $user_id . "'";
					mysqli_query($connect, $query);
					
					mysqli_close($connect);
					return "Remarks for " . $type . " has been deleted.<br>";
				}
			}
			else{
				if($remark){
					$query = 
						"INSERT INTO `field_remarks`(`hospital_id`,`field_id`,`field_remark`) 
						VALUES ('" . $user_id . "','" . $field_id . "','" . mysqli_real_escape_string($connect, $remark) . "')";
					mysqli_query($connect, $query);
					
					mysqli_close($connect);
					return $type . " has been added with remark: " . $remark . "<br>";
				}
				return false;
			}
		} 
		return false;
	}
	
	function differentStaffing($type, $number, $user_id, $permanent, $contractual){
		$field_id = 
			(strtolower($type) == "permanent" ? $permanent : 
				(strtolower($type) == "contractual" ? $contractual : false));
		if($field_id !== false) 
			return setField($number, $user_id, $field_id);
		return false;
	}
	
	function withRemarks($boolean, $remarks, $user_id, $field_id){
		if(is_bool($boolean) && $boolean === true)
			return setField($boolean, $user_id, $field_id) . setRemark($remarks, $user_id, $field_id);
		return false;
	}
	