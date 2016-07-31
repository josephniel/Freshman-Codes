<?php 
	require_once('./assets/class/lib/nusoap.php');
	
	$server = new soap_server();
	
	require_once('./assets/class/class.main.php');
	require_once('./assets/class/class.general-information.php');
	require_once('./assets/class/class.bed.php');
	require_once('./assets/class/class.staffing.php');
	require_once('./assets/class/class.committee.php');
	require_once('./assets/class/class.other-facility.php');
	require_once('./assets/class/class.financial-status.php');	

	$server->register('connect');
	
	$server->register('updateHospitalName');
	$server->register('updateHospitalAddress');
	$server->register('updateHospitalRegion');
	$server->register('updateHospitalCatchmentPopulation');
	$server->register('updateHospitalContactNumber');
	$server->register('updateHospitalFaxNumber');
	$server->register('updateHospitalEmail');
	$server->register('updateHospitalLevel');
	$server->register('updateHospitalType');
	$server->register('updateHospitalOwnership');
	$server->register('updateCertification');
		
	$server->register('updateAuthorizedNumberOfBeds');
	$server->register('updateNumberOfBedsByPay');
	$server->register('updateNumberOfBedsByService');
		$server->register('updateNumberOfBedsMedicine');
		$server->register('updateNumberOfBedsObstetrics');
		$server->register('updateNumberOfBedsGynecology');
		$server->register('updateNumberOfBedsPediatrics');
		$server->register('updateNumberOfBedsPediaSurgery');
		$server->register('updateNumberOfBedsAdultSurgery');
	
	$server->register('updatePermanentStaff');
	$server->register('updateContractualStaff');
		$server->register('updateNumberOfSpecialist');
		$server->register('updateNumberOfSurgeon');
		$server->register('updateNumberOfPhysician');
		$server->register('updateNumberOfChiefNurse');
		$server->register('updateNumberOfSupervisingNurse');
		$server->register('updateNumberOfStaffNurse');
		$server->register('updateNumberOfStaffNurseCCU');
		$server->register('updateNumberOfNursingAttendant');
		$server->register('updateNumberOfMidwife');
		$server->register('updateNumberOfDentist');
		$server->register('updateNumberOfPhysicalTherapist');
		$server->register('updateNumberOfPharmacist');
		$server->register('updateNumberOfMedicalTechnician');
		$server->register('updateNumberOfRadiologist');
		$server->register('updateNumberOfMedicalRecordsOfficer');
		$server->register('updateNumberOfMedicalSocialWorker');
		$server->register('updateNumberOfEngineer');
	
	$server->register('hasTechnicalCommittee');
		$server->register('hasBloodTransfusionCommittee');
		$server->register('hasCredentialsCommittee');
		$server->register('hasEthicsCommittee');
		$server->register('hasFireSafetyCommittee');
		$server->register('hasGrievanceCommittee');
		$server->register('hasHIVorAIDSCommittee');
		$server->register('hasInfectionControlCommittee');
		$server->register('hasMedicalAuditCommittee');
		$server->register('hasTherapeuticCommittee');
		$server->register('hasTissueCommittee');
		$server->register('hasWasteManagementCommittee');
	$server->register('hasAdministrativeCommittee');
		$server->register('hasBiddingAndAwardsCommittee');
		$server->register('hasRecordManagementImprovementCommittee');
		$server->register('hasFinanceCommittee');
		$server->register('hasMedicalLibraryCommittee');
		$server->register('hasMedicalRecordsCommittee');
	
	$server->register('hasOtherFacility');
		$server->register('hasBloodBank');
		$server->register('hasBloodStation');
		$server->register('hasDialysisClinic');
		$server->register('hasDrugTestingLab');
		$server->register('hasHIVTestingLab');
		$server->register('hasWaterTestingLab');
		$server->register('hasKidneyTransplantFacility');
		$server->register('hasAmbulatorySurgicalClinic');
		$server->register('hasNewbornScreening');
		
	$server->register('updateFinancialStatus');
		$server->register('updateTotalBudget');
		$server->register('updateTotalIncome');
		$server->register('updateTotalExpenditures');
	
	$server->service($HTTP_RAW_POST_DATA);