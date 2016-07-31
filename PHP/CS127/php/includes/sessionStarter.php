<?php

	session_start();
	
	/* STORES LAST ACTIVE TIME AS LOG-OUT TIME 
		include('./_connect.php');
	
		date_default_timezone_set("Asia/Manila");
		$timeOut = date("h:i:sa");
		
		$fullname = $_SESSION['fullname'];
		$timeIn = $_SESSION['timeIn'];
		
		$sql = 
			"UPDATE timetable 
			SET timeOut='" . $timeOut . "' 
			WHERE fullName='" . $fullname .  "' 
			AND timeIn='" . $timeIn . "'";
		
		mysqli_query($connect, $sql);
		mysqli_close($connect);*/
	
	$urlString = $_SERVER['PHP_SELF'];
	$urlString = substr($urlString,42);

	/* RETURNS TO PREVIOUS PAGE IF ASSISTANT PHARMACIST TRIES TO ACCESS ADMIN PAGES AND SUPER-ADMIN */
	if( 
	($urlString == 'activityPharmacist.php' || 
	$urlString == 'activityPharmacistTimeLog.php' || 
	$urlString == 'activityPharmacistActivities.php' || 
	$urlString == 'activityAssistantPharmacist.php' || 
	$urlString == 'activityAssistantPharmacistTimeLog.php' || 
	$urlString == 'activityAssistantPharmacistActivities.php' || 
	$urlString == 'adminApproveUsers.php' || 
	$urlString == 'adminDisableUsers.php' || 
	$urlString == 'adminPromoteUsers.php' || 
	$urlString == 'addProduct.php' || 
	$urlString == 'editProduct.php' || 
	$urlString == 'editVendorInfo.php' ||
	$urlString == 'editVendorProduct.php' ||
	$urlString == 'orderProducts.php' || 
	$urlString == 'modifyDeliveries.php') && 
	$_SESSION['usertype'] == 'Assistant Pharmacist'){
		echo "<script>history.go(-1);</script>";
	}
	
	/* RETURNS TO PREVIOUS PAGE IF PHARMACIST TRIES TO ACCESS SUPER-ADMIN PAGES */
	if( 
	($urlString == 'activityPharmacist.php' || 
	$urlString == 'activityPharmacistTimeLog.php' || 
	$urlString == 'activityPharmacistActivities.php' ||  
	$urlString == 'adminApproveUsers.php' || 
	$urlString == 'adminDisableUsers.php' ) && 
	$_SESSION['usertype'] == 'Pharmacist'){
		echo "<script>history.go(-1);</script>";
	}
	
	/* IF THE SESSION IS NOT DEFINED, THERE IS NO ONE LOGGED IN SO NO PAGE CAN BE ACCESSED */
	if(isset($_SESSION['usertype']) && !empty($_SESSION['usertype'])) {
		$fullname = $_SESSION['fullname'];
		$username = $_SESSION['username'];
		$usertype = $_SESSION['usertype'];
		$profileImage = $_SESSION['profileImage'];
	}
	else{
		header('location: ../index.php');
	}
