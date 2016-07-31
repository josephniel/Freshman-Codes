<?php 
	
	include_once('./sessionStarter.php');
	include_once('./_connect.php');
	
	if(isset($_POST['addBed'])){	
	
		$_SESSION['currentPatient'] = $_POST['inPatientBedNo'];
		
		$sql = 
			"INSERT INTO inpatienttable (bedNo, patientFirstName, patientMiddleName, patientLastName, requestingPhysician, checkInDate) 
			VALUES ('" . $_POST['inPatientBedNo'] . "','" . $_POST['inPatientFirstName'] . "','" . $_POST['inPatientMiddleName'] . "','" . $_POST['inPatientLastName'] . "','" . $_POST['inPatientRP'] . "','" . $_POST['checkInMonth'] . "-" . $_POST['checkInDay'] . "-" .  $_POST['checkInYear'] . "');";
		mysqli_query($connect, $sql);
	}
	
	if(isset($_POST['inPatientBedNo'])){
	
		$_SESSION['currentPatient'] = $_POST['inPatientBedNo'];
	
		$currentInPatientBedNumber = $_POST['inPatientBedNo'];
		$previousInPatientBedNumber = $_POST['PREVinPatientBedNo'];
		$patientFirstName = $_POST['inPatientFirstName'];
		$patientMiddleName = $_POST['inPatientMiddleName'];
		$patientLastName = $_POST['inPatientLastName'];
		
		$checkInDay = $_POST['checkInDay'];
			if(strlen($checkInDay) < 2){
				$checkInDay = '0' . $checkInDay;
			}
		$checkInMonth = $_POST['checkInMonth'];
			if(strlen($checkInMonth) < 2){
				$checkInMonth = '0' . $checkInMonth;
			}
		$checkInDate = $checkInMonth . "-" . $checkInDay . "-" . $_POST['checkInYear']; 
	
		$sql =
			"INSERT INTO `inpatienttable`(`bedNo`, `patientFirstName`, `patientMiddleName`, `patientLastName`, `checkInDate`) VALUES ('".$currentInPatientBedNumber."','".$patientFirstName."','".$patientMiddleName."','".$patientLastName."','".$checkInDate."')";
		mysqli_query($connect, $sql);
	}
	
	header('Location: ../dispenseInPatientBedInformation.php');