<?php

	function updatePermanentStaff($specialist, $surgeon, $physician, $chief_nurse, $supervising_nurse, $staff_nurse, $staff_nurse_ccu, $nursing_attendant, $midwife, $dentist, $physical_therapist, $pharmacist, $medical_technician, $radiologist, $medical_records_officer, $medical_social_worker, $engineer, $user_id){
		$return = updateNumberOfSpecialist('permanent', $specialist, $user_id);
		$return .= updateNumberOfSurgeon('permanent', $surgeon, $user_id);
		$return .= updateNumberOfPhysician('permanent', $physician, $user_id);
		$return .= updateNumberOfChiefNurse('permanent', $chief_nurse, $user_id);
		$return .= updateNumberOfSupervisingNurse('permanent', $supervising_nurse, $user_id);
		$return .= updateNumberOfStaffNurse('permanent', $staff_nurse, $user_id);
		$return .= updateNumberOfStaffNurseCCU('permanent', $staff_nurse_ccu, $user_id);
		$return .= updateNumberOfNursingAttendant('permanent', $nursing_attendant, $user_id);
		$return .= updateNumberOfMidwife('permanent', $midwife, $user_id);
		$return .= updateNumberOfDentist('permanent', $dentist, $user_id);
		$return .= updateNumberOfPhysicalTherapist('permanent', $physical_therapist, $user_id);
		$return .= updateNumberOfPharmacist('permanent', $pharmacist, $user_id);
		$return .= updateNumberOfMedicalTechnician('permanent', $medical_technician, $user_id);
		$return .= updateNumberOfRadiologist('permanent', $radiologist, $user_id);
		$return .= updateNumberOfMedicalRecordsOfficer('permanent', $medical_records_officer, $user_id);
		$return .= updateNumberOfMedicalSocialWorker('permanent', $medical_social_worker, $user_id);
		$return .= updateNumberOfEngineer('permanent', $engineer, $user_id);
		return $return;
	}
	
	function updateContractualStaff($specialist, $surgeon, $physician, $chief_nurse, $supervising_nurse, $staff_nurse, $staff_nurse_ccu, $nursing_attendant, $midwife, $dentist, $physical_therapist, $pharmacist, $medical_technician, $radiologist, $medical_records_officer, $medical_social_worker, $engineer, $user_id){
		$return = updateNumberOfSpecialist('contractual', $specialist, $user_id);
		$return .= updateNumberOfSurgeon('contractual', $surgeon, $user_id);
		$return .= updateNumberOfPhysician('contractual', $physician, $user_id);
		$return .= updateNumberOfChiefNurse('contractual', $chief_nurse, $user_id);
		$return .= updateNumberOfSupervisingNurse('contractual', $supervising_nurse, $user_id);
		$return .= updateNumberOfStaffNurse('contractual', $staff_nurse, $user_id);
		$return .= updateNumberOfStaffNurseCCU('contractual', $staff_nurse_ccu, $user_id);
		$return .= updateNumberOfNursingAttendant('contractual', $nursing_attendant, $user_id);
		$return .= updateNumberOfMidwife('contractual', $midwife, $user_id);
		$return .= updateNumberOfDentist('contractual', $dentist, $user_id);
		$return .= updateNumberOfPhysicalTherapist('contractual', $physical_therapist, $user_id);
		$return .= updateNumberOfPharmacist('contractual', $pharmacist, $user_id);
		$return .= updateNumberOfMedicalTechnician('contractual', $medical_technician, $user_id);
		$return .= updateNumberOfRadiologist('contractual', $radiologist, $user_id);
		$return .= updateNumberOfMedicalRecordsOfficer('contractual', $medical_records_officer, $user_id);
		$return .= updateNumberOfMedicalSocialWorker('contractual', $medical_social_worker, $user_id);
		$return .= updateNumberOfEngineer('contractual', $engineer, $user_id);
		return $return;
	}

		function updateNumberOfSpecialist($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 21, 38);
		}
		function updateNumberOfSurgeon($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 22, 39);
		}
		function updateNumberOfPhysician($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 23, 40);
		}
		function updateNumberOfChiefNurse($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 24, 41);
		}
		function updateNumberOfSupervisingNurse($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 25, 42);
		}
		function updateNumberOfStaffNurse($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 26, 43);
		}
		function updateNumberOfStaffNurseCCU($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 27, 44);
		}
		function updateNumberOfNursingAttendant($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 28, 45);
		}
		function updateNumberOfMidwife($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 29, 46);
		}
		function updateNumberOfDentist($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 30, 47);
		}
		function updateNumberOfPhysicalTherapist($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 31, 48);
		}
		function updateNumberOfPharmacist($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 32, 49);
		}
		function updateNumberOfMedicalTechnician($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 33, 50);
		}
		function updateNumberOfRadiologist($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 34, 51);
		}
		function updateNumberOfMedicalRecordsOfficer($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 35, 52);
		}
		function updateNumberOfMedicalSocialWorker($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 36, 53);
		}
		function updateNumberOfEngineer($type, $number, $user_id){
			return differentStaffing($type, $number, $user_id, 37, 54);
		}	