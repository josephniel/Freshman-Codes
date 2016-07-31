<?php
	
	function updateHospitalName($name, $user_id){
		return setField($name, $user_id, 1);
	}
	
	function updateHospitalAddress($address, $user_id){
		return setField($address, $user_id, 2);
	}
	
	function updateHospitalRegion($region, $user_id){
		return setField($region, $user_id, 3);
	}
	
	function updateHospitalCatchmentPopulation($population, $user_id){
		return setField($population, $user_id, 4);
	}
	
	function updateHospitalContactNumber($contact_number, $user_id){
		return setField($contact_number, $user_id, 5);
	}
	
	function updateHospitalFaxNumber($fax_number, $user_id){
		return setField($fax_number, $user_id, 6);
	}
	
	function updateHospitalEmail($email, $user_id){
		return setField($email, $user_id, 7);
	}
	
	function updateHospitalLevel($level, $user_id){
		return setField($level, $user_id, 8);
	}
	
	function updateHospitalType($type, $user_id){
		return setField($type, $user_id, 9);
	}
	
	function updateHospitalOwnership($ownership, $user_id){
		return setField($ownership, $user_id, 10);
	}
	
	function updateCertification($name, $period, $user_id){
		return updateCertificationName($name, $user_id) 
				. updateCertificationValidationDate($period, $user_id);
	}
		function updateCertificationName($name, $user_id){
			return setField($name, $user_id, 11);
		}
		function updateCertificationValidationDate($period, $user_id){
			return setField($period, $user_id, 12);
		}
	
