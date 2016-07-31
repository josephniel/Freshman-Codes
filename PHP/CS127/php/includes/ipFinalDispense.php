<?php 
	
	include_once('./sessionStarter.php');
	include_once('./_connect.php');

	if(isset($_SESSION['dispensedProducts'])){
	
		$user = $fullname;
	
		$x = $y = $z = 0;
		
		$slipNumber = $_SESSION['slipNo'];
		$requestingPhys = $_SESSION['inPatientRP'];
		
		$dispensedProducts = array();
		$dispensedProductQuantity = array();
		
		$dispensedProducts = $_SESSION['dispensedProducts']['productNames'];
		$dispensedProductQuantity = $_SESSION['dispensedProducts']['productQuantity'];
	
		date_default_timezone_set("Asia/Manila");
		$date = date("m/d/Y");
		$time = date("h:i:s a");

		$x = 0;
		$arrlength = count($dispensedProducts);
					
		//ADDING TO INPATIENTPRODUCTTABLE
		for($a = 0; $a < $arrlength; $a++){
						
			$sql =
				"SELECT productId, bedNo, quantity 
				FROM inpatientproducttable 
				WHERE productId = '" . $dispensedProducts[$a] . "' 
				AND bedNo = '" . $_SESSION['currentPatient'] . "'
				AND slipNo = '" .$slipNumber. "'";		
			$checker = mysqli_query($connect, $sql);
						
			if(mysqli_num_rows($checker)==1){
				$sql = 
					"UPDATE inpatientproducttable 
					SET quantity = quantity + " . $dispensedProductQuantity[$a] . " 
					WHERE productId = '" . $dispensedProducts[$a] . "' 
					AND bedNo = '" . $_SESSION['currentPatient'] . "' AND slipNo = '" .$slipNumber. "' ";
			}else if(mysqli_num_rows($checker)==0 && $dispensedProducts[$a]!='1'){
				$sql = 
					"INSERT INTO inpatientproducttable (bedNo, productId, quantity, slipNo, requestingPhysician) 
					VALUES ('" . $_SESSION['currentPatient'] ."', '".$dispensedProducts[$a]."' , ".$dispensedProductQuantity[$a]." , '".$slipNumber."', '" . $requestingPhys . "')";
			}
			mysqli_query($connect, $sql);
		}
					
		for($a = 0; $a < $arrlength; $a++){
			 
			$t = microtime(true);
			$micro = sprintf("%06d",($t - floor($t)) * 1000000);
			$time = date("h:i:s.".$micro."a");
				
			$dispenseId = $date . "-" . $time;
				
			for($b = 0; $b < $dispensedProductQuantity[$a]; $b++){
					
				$sql = 
					"SELECT rdTotalUnits
					FROM deliveriestable 
					WHERE productId = '" . $dispensedProducts[$a] . "' 
					ORDER BY CASE WHEN expiryYear IS NULL OR expiryMonth IS NULL THEN 1 ELSE 0 END, expiryYear ASC, expiryMonth ASC LIMIT 1 ;";
					$totalUnits = mysqli_fetch_array(mysqli_query($connect,$sql));
					
				if($totalUnits['rdTotalUnits'] == 0){
					$sql = 
						"DELETE FROM deliveriestable 
						WHERE productId = '" . $dispensedProducts[$a] . "' 
						ORDER BY CASE WHEN expiryYear IS NULL OR expiryMonth IS NULL THEN 1 ELSE 0 END, expiryYear ASC, expiryMonth ASC LIMIT 1 ;";
					mysqli_query($connect, $sql);
				}
					
				$sql = 
					"UPDATE deliveriestable 
					SET rdTotalUnits = rdTotalUnits - 1 
					WHERE productId = '" . $dispensedProducts[$a] . "' 
					ORDER BY CASE WHEN expiryYear IS NULL OR expiryMonth IS NULL THEN 1 ELSE 0 END, expiryYear ASC, expiryMonth ASC LIMIT 1 ;";
				mysqli_query($connect, $sql);
			}
				
			$sql = 
				"UPDATE dynamicproducttable 
				SET totalQuantity = 
					(SELECT sum(rdTotalUnits) 
					FROM deliveriestable 
					WHERE productId = '" . $dispensedProducts[$a] . "')
				WHERE productId = '" . $dispensedProducts[$a] . "'";
			mysqli_query($connect, $sql);
			if($dispensedProducts[$a] != '1'){
			//EDITED!!!!!
				$sql = 
					"INSERT INTO dispensedmedicinetable (dispenseId, receivedBy, productId, quantity, requestingUnit) 
					VALUES ('" . $dispenseId . "', '" . $user . "', '" . $dispensedProducts[$a] . "' , " . $dispensedProductQuantity[$a] . ", '" . $requestingPhys . "')";
				mysqli_query($connect, $sql);
			}
				
			/* FOR ACTIVITY LOGS */
				$activityType = "issued";
				$sql = 
					"INSERT INTO activitytable(activityDate, activityTime, activityType, fullName, userType)
					VALUES('" . $date ."', '" . $time . "', '" . $activityType . "', '" . $user . "', '" . $usertype . "')";
				mysqli_query($connect, $sql);
			}

			/* UPDATES CONSUMPTION AND NOTIFICATIONS TABLE */
			if(!empty($dispensedProducts)) {
						
				$ctr = 0;
				$quantityDispensed = $dispensedProductQuantity;
						
				foreach($dispensedProducts as $productId) {
				
					$sql = 
						"SELECT quantityDispensed 
						FROM consumptiontable 
						WHERE date = '" . $date . "' 
						AND productId = '" . $productId . "'";
					$row = mysqli_fetch_array(mysqli_query($connect, $sql));
							
					if($row != null){
						$newQuantity = (int)$row['quantityDispensed'] + (int)$quantityDispensed[$ctr]; 
						$sql = 
							"UPDATE consumptiontable 
							SET quantityDispensed='" . $newQuantity . "' 
							WHERE date='" . $date . "' 
							AND productId='" . $productId . "'";
					}
					else {
						if($productId!='1'){
							$sql = 
								"INSERT INTO consumptiontable (date, productId, quantityDispensed) 
								VALUES ('" . $date . "', '" . $productId . "', " . $quantityDispensed[$ctr] . ")";
						}
					}
					mysqli_query($connect, $sql);
							
							
					/* CHECKS IF LOW ON QUANTITY */			
						$sql = 
							"SELECT deliveryTime 
							FROM vendorordertable 
							WHERE productId='" . $productId . "'";
						$deliveryTime = mysqli_query($connect, $sql);
							
						$sql = 
							"SELECT d.totalQuantity, c.averageConsumption 
							FROM dynamicproducttable d, consumptiontable c 
							WHERE d.productId = '" . $productId . "' 
							AND c.productId = d.productId 
							AND c.date = '" . $date . "'";
						$row = mysqli_query($connect, $sql);
							
						while($row2 = mysqli_fetch_array($row)) {
							
							$row3 = mysqli_fetch_array($deliveryTime);
								
							if($row3 == null) {
								$row3['deliveryTime'] = 7;
							}
								
							$var = $row2['averageConsumption'] * $row3['deliveryTime'];
								
							if($row2['totalQuantity'] <= $var) {
								$sql = 
									"UPDATE dynamicproducttable 
									SET isLowOnQuantity = 1 
									WHERE productId = '". $productId . "'";
								mysqli_query($connect, $sql);
							}
						}
							
					$ctr++;
				}
			}
		/* END OF UPDATE CONSUMPTION AND NOTIFICATIONS TABLE */	
	
		unset($_SESSION['dispensedProducts']);
	}
	
	header('Location: ../dispenseInPatientBedInformation.php');