<?php

	function hasOtherFacility($blood_bank, $remark1, $blood_station, $remark2, $dialysis_clinic, $remark3, $drug_testing, $remark4, $hiv_testing, $remark5, $water_testing, $remark6, $kidney_transplant, $remark7, $ambulatory_surgical, $remark8, $newborn_screening, $remark9, $user_id){
		$return = hasBloodBank($blood_bank, $remark1, $user_id);
		$return .= hasBloodStation($blood_station, $remark2, $user_id);
		$return .= hasDialysisClinic($dialysis_clinic, $remark3, $user_id);
		$return .= hasDrugTestingLab($drug_testing, $remark4, $user_id);
		$return .= hasHIVTestingLab($hiv_testing, $remark5, $user_id);
		$return .= hasWaterTestingLab($water_testing, $remark6, $user_id);
		$return .= hasKidneyTransplantFacility($kidney_transplant, $remark7, $user_id);
		$return .= hasAmbulatorySurgicalClinic($ambulatory_surgical, $remark8, $user_id);
		$return .= hasNewbornScreening($newborn_screening, $remark9, $user_id);
		return $return;
	}

	function hasBloodBank($boolean, $remarks, $user_id){
		return withRemarks($boolean, $remarks, $user_id, 71);
	}
	
	function hasBloodStation($boolean, $remarks, $user_id){
		return withRemarks($boolean, $remarks, $user_id, 72);
	}
	
	function hasDialysisClinic($boolean, $remarks, $user_id){
		return withRemarks($boolean, $remarks, $user_id, 73);
	}
	
	function hasDrugTestingLab($boolean, $remarks, $user_id){
		return withRemarks($boolean, $remarks, $user_id, 74);
	}
	
	function hasHIVTestingLab($boolean, $remarks, $user_id){
		return withRemarks($boolean, $remarks, $user_id, 75);
	}
	
	function hasWaterTestingLab($boolean, $remarks, $user_id){
		return withRemarks($boolean, $remarks, $user_id, 76);
	}
	
	function hasKidneyTransplantFacility($boolean, $remarks, $user_id){
		return withRemarks($boolean, $remarks, $user_id, 77);
	}
	
	function hasAmbulatorySurgicalClinic($boolean, $remarks, $user_id){
		return withRemarks($boolean, $remarks, $user_id, 78);
	}
	
	function hasNewbornScreening($boolean, $remarks, $user_id){
		return withRemarks($boolean, $remarks, $user_id, 79);
	}