<?php

	function hasTechnicalCommittee($blood_transfusion, $remark1, $credentials, $remark2, $ethics, $remark3, $fire_safety, $remark4, $grievance, $remark5, $hiv, $remark6, $infection_control, $remark7, $medical_audit, $remark8, $therapeutic, $remark9, $tissue, $remark10, $waste_management, $remark11, $user_id){
		$return = hasBloodTransfusionCommittee($blood_transfusion, $remark1, $user_id);
		$return .= hasCredentialsCommittee($credentials, $remark2, $user_id);
		$return .= hasEthicsCommittee($ethics, $remark3, $user_id);
		$return .= hasFireSafetyCommittee($fire_safety, $remark4, $user_id);
		$return .= hasGrievanceCommittee($grievance, $remark5, $user_id);
		$return .= hasHIVorAIDSCommittee($hiv, $remark6, $user_id);
		$return .= hasInfectionControlCommittee($infection_control, $remark7, $user_id);
		$return .= hasMedicalAuditCommittee($medical_audit, $remark8, $user_id);
		$return .= hasTherapeuticCommittee($therapeutic, $remark9, $user_id);
		$return .= hasTissueCommittee($tissue, $remark10, $user_id);
		$return .= hasWasteManagementCommittee($waste_management, $remark1, $user_id);
		return $return;
	}
	
	function hasAdministrativeCommittee($bidding_and_awards, $remark1, $record_management_improvement, $remark2, $finance, $remark3, $medical_library, $remark4, $medical_records, $remark5, $user_id){
		$return = hasBiddingAndAwardsCommittee($blood_transfusion, $remark1, $user_id);
		$return .= hasRecordManagementImprovementCommittee($credentials, $remark2, $user_id);
		$return .= hasFinanceCommittee($ethics, $remark3, $user_id);
		$return .= hasMedicalLibraryCommittee($fire_safety, $remark4, $user_id);
		$return .= hasMedicalRecordsCommittee($grievance, $remark5, $user_id);
		return $return;
	}

		function hasBloodTransfusionCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 55);
		}
		
		function hasCredentialsCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 56);
		}
		
		function hasEthicsCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 57);
		}
		
		function hasFireSafetyCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 58);
		}
		
		function hasGrievanceCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 59);
		}
		
		function hasHIVorAIDSCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 60);
		}	
		
		function hasInfectionControlCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 61);
		}
		
		function hasMedicalAuditCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 62);
		}
		
		function hasTherapeuticCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 63);
		}
		
		function hasTissueCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 64);
		}
		
		function hasWasteManagementCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 65);
		}
	
		function hasBiddingAndAwardsCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 66);
		}
		
		function hasRecordManagementImprovementCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 67);
		}
		
		function hasFinanceCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 68);
		}
		
		function hasMedicalLibraryCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 69);
		}
		
		function hasMedicalRecordsCommittee($boolean, $remarks, $user_id){
			return withRemarks($boolean, $remarks, $user_id, 70);
		}