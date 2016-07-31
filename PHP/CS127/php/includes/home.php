<?php 
	
	session_start();

	/* INPUTS LOGIN TIME TO TIME TABLE */
		include_once('./includes/_connect.php');
		
		date_default_timezone_set("Asia/Manila");
		$date = date("m/d/Y");
		$timeIn = date("h:i:sa");
		
		$fullname = $_SESSION['fullname'];
		$usertype = $_SESSION['usertype'];
		$_SESSION['timeIn'] = $timeIn;
		
		$handler = mysqli_query($connect, "SELECT * FROM timetable WHERE timeOut=' 00:00:00a'");
		$failuser = "";
		while($x = mysqli_fetch_array($handler)){
			$failuser = $x['fullName'];
			echo $failuser;
		}
		if($failuser != '' && $fullname != $failuser){	// prevfailuser != nextuser
			$handler2 = "UPDATE timetable SET timeOut='$timeIn' WHERE  timeOut=' 00:00:00a'";
			mysqli_query($connect, $handler2);
		}
		
		$enter = true;
		if($failuser == $fullname){	// prevfailuser == nextuser
			$enter = false;
		}
		if($usertype != 'Administrator' && $enter){
			$sql = 
				"INSERT INTO timetable 
				VALUES ('" . $date . "','" . $fullname . "', '" . $usertype . "', '" . $timeIn . "',' 00:00:00a')";
			mysqli_query($connect, $sql);
		}
	/* COMPUTES AVERAGE CONSUMPTION */
		$sql = 
			"SELECT productId FROM producttable";
		$productId = mysqli_query($connect, $sql);
		
		while($row1 = mysqli_fetch_array($productId)) {
			$sql = 
				"SELECT date 
				FROM consumptiontable 
				WHERE productId='" . $row1['productId'] . "' 
				ORDER BY date DESC LIMIT 1";
			$latestDate = mysqli_query($connect, $sql);
			
			while($row2 = mysqli_fetch_array($latestDate)) { 
				//if latestDate in consumptiontable != date today
				if($date != $row2['date']) { 
					$sql = 
						"SELECT averageConsumption 
						FROM consumptiontable 
						WHERE productId='" . $row1['productId'] . "'"; //average consumption yesterday
					$aveCons = mysqli_query($connect, $sql);
					
					$sql = 
						"SELECT quantityDispensed 
						FROM consumptiontable 
						WHERE productId='" . $row1['productId'] . "' 
						AND date='" . $row2['date'] . "'";
					$consumed = mysqli_query($connect, $sql);
					
					while($row3 = mysqli_fetch_array($aveCons)) {
						while($row4 = mysqli_fetch_array($consumed)) {
							if($row3['averageConsumption'] == 0){
								$averageConsumptionToday = $row4['quantityDispensed'];
							}
							else{
								//average consumption today = average consumption yesterday (0.7) + consumed yesterday (0.3)
								$averageConsumptionToday = ($row3['averageConsumption'] * 0.7) + ($row4['quantityDispensed'] * 0.3);
							}
							//insert new entries to consumption table
							$sql = 
								"INSERT INTO consumptiontable (date, productId, averageConsumption) 
								VALUES ('" . $date . "', '" . $row1['productId'] . "', '" . $averageConsumptionToday . "')";
							mysqli_query($connect, $sql);
							
							//delete old entries from consumption table
							$sql = 
								"DELETE FROM consumptiontable 
								WHERE productId='" . $row1['productId'] . "' 
								AND date!='" . $date . "' 
								ORDER BY date";
							mysqli_query($connect, $sql);
						}
					}
				}
			}
		}
		
	/* CHECKS FOR EXPIRING PRODUCTS */
		$sql = 
			"SELECT *
			FROM deliveriestable, vendorordertable
			WHERE deliveriestable.productId = vendorordertable.productId
			AND pricePerUnit <> 0
			AND expiryMonth <> 0
			AND expiryYear <> 0";
		$deliveriesTab = mysqli_query($connect, $sql);
		
		$currentMonth = idate("m");		// gets the current month in number form (01-12) in integer type
		$currentYear = idate("Y");		// gets the current year in 4-digit form in integer type
		
		while($row = mysqli_fetch_array($deliveriesTab)) {
			
			$prodID = $row['productId'];
			$expMonth = $row['expiryMonth'];
			$expYear = $row['expiryYear'];
			
			$monthDifference = $expMonth - $currentMonth;
			$yearDifference = $expYear - $currentYear;
			
			// if both expiration month and year have values
			if($expMonth != null && $expYear != null) {		
	
				$sql = 
					"DELETE FROM deliveriestable
					WHERE productId = '" . $prodID . "'
					AND	
						(SELECT isExpiring 
						FROM dynamicproducttable
						WHERE dynamicproducttable.productId = '" . $prodID . "') EQUALS 3
					ORDER BY expiryYear ASC, expiryMonth ASC LIMIT 1;";
				mysqli_query($connect, $sql);
			
				// if current year and expiration year are the same
				// and current month is 3 or less than expiration month
				if(($monthDifference <= 3) && ($monthDifference >= 0) && ($yearDifference == 0)) {
					$sql = 
						"UPDATE dynamicproducttable 
						SET isExpiring = 1 
						WHERE dynamicproducttable.productId = '".$prodID."'";				
					mysqli_query($connect, $sql);
				} 
				else{
					// if current year is one less than expiration year
					if($yearDifference == 1) {			
						// if expiration month is January and current month is October/November/December of previous year
						if(($expMonth == 1) && (($currentMonth == 12) || ($currentMonth == 11) || ($currentMonth == 10))) {		$sql = 
								"UPDATE dynamicproducttable 
								SET isExpiring = 1 
								WHERE dynamicproducttable.productId = '".$prodID."'";		
						}
						// if expiration month is February and current month is November/December of previous year
						if(($expMonth == 2) && (($currentMonth == 12) || ($currentMonth == 11))) {		
							$sql = 
								"UPDATE dynamicproducttable 
								SET isExpiring = 1 
								WHERE dynamicproducttable.productId = '".$prodID."'";		
						}
						// if expiration month is March and current month is December of previous year
						if(($expMonth == 3) && ($currentMonth == 12)) {														
							$sql = 
								"UPDATE dynamicproducttable 
								SET isExpiring = 1 
								WHERE dynamicproducttable.productId = '".$prodID."'";		
						}
						mysqli_query($connect, $sql);
					}
				}
			}
		}
		
  
	mysqli_close($connect);
	
	/* REDIRECTS TO RESPECTIVE HOME PAGES */
	if(isset($_SESSION['usertype']) && !empty($_SESSION['usertype'])) {
		if($_SESSION['usertype'] == 'Assistant Pharmacist'){
			header('location: dispenseOutPatient.php');
		}
		elseif($_SESSION['usertype'] == 'Pharmacist'){
			header('location: activityAssistantPharmacist.php');
		}
		else{
			header('location: activityPharmacist.php');
		}
	}
	else{
		header('location: login.php');
	}
	
?>

