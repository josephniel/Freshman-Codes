<?php
	include_once('./includes/sessionStarter.php');
	include_once('./includes/_connect.php');

	if(isset($_SESSION['dispensedProducts'])){
	
		$user = $fullname;
	
		$x = $y = $z = 0;
	
		$dispensedProducts = array();
		$dispensedProductQuantity = array();
		
		$dispensedProducts = $_SESSION['dispensedProducts']['productNames'];
		$dispensedProductQuantity = $_SESSION['dispensedProducts']['productQuantity'];
	
		date_default_timezone_set("Asia/Manila");
		$date = date("m/d/Y");
		$time = date("h:i:s a");
	
	?>
	
<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
		<div class='content'>
		
			<p class='marginBottom'>You will be redirected back in <b class='countdown'>10</b> seconds</p>
			
			<h2>Transaction Details</h2>
				
			<p class='noMargin'><b>Date:</b> <?php echo $date . ", " . $time?></p>
			<p class='noMargin'><b>Issued By:</b> <?php echo $user ?></p>
				
			<table style='width:100%;line-height:40px;' class='grayBorder marginTop'>
			
				<tr style='text-align:left' class='grayBorder yellow'>
					<th style='width:30%;padding:0 10px;'>Generic Name</th>
					<th style='width:30%;padding:0 10px;'>Brand Name</th>
					<th style='width:10%;padding:0 10px;'>Dosage</th>
					<th style='width:10%;padding:0 10px;'>Type</th>
					<th style='width:7%;padding:0 10px;'>Qtty</th>
					<th style='width:13%;padding:0 10px;'>Subtotal</th>
				<tr>
	<?php
		$arrlength = count($dispensedProductQuantity);
		for($x = 0; $x < $arrlength; $x++){

			$sql = 
				"SELECT genericName, brandName, dosage, type, sellingPrice 
				FROM producttable, dynamicproducttable 
				WHERE dynamicproducttable.productId = '" . $dispensedProducts[$x] . "' 
				AND producttable.productId = '" . $dispensedProducts[$x] . "'";
			
			$row = mysqli_fetch_array(mysqli_query($connect,$sql));
			
			$subTot = (float)$row['sellingPrice'] * (float)$dispensedProductQuantity[$x];
			$grandTotArray[$x] = (float)$subTot;
			 
	?>
			<tr class='grayBorder lightyellow'>
				<td style='width:30%;padding:0 10px;'><?php echo $row['genericName'] ?></td>
				<td style='width:30%;padding:0 10px;'><?php echo $row['brandName'] ?></td>
				<td style='width:10%;padding:0 10px;'><?php echo $row['dosage'] ?></td>
				<td style='width:10%;padding:0 10px;'><?php echo $row['type'] ?></td>
				<td style='width:7%;padding:0 10px;'><?php echo $dispensedProductQuantity[$x] ?></td>
				<td style='width:13;padding:0 10px;'><b>Php </b><?php echo number_format($subTot, 2) ?></td>
			<tr>
			
	<?php } ?>
			
			<tr>
				<th colspan='6'>Grand Total: <?php echo number_format(array_sum($grandTotArray),2) ?> Pesos</th>
			</tr>
	
		</table>
		
	
	<?php	
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
			
			$sql = 
				"INSERT INTO dispensedmedicinetable (dispenseId, receivedBy, productId, quantity, requestingUnit) 
				VALUES ('" . $dispenseId . "', '" . $user . "', '" . $dispensedProducts[$a] . "' , " . $dispensedProductQuantity[$a] . ", 'Out-patient')";
			mysqli_query($connect, $sql);
			
			
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
						$sql = 
							"INSERT INTO consumptiontable (date, productId, quantityDispensed) 
							VALUES ('" . $date . "', '" . $productId . "', " . $quantityDispensed[$ctr] . ")";
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
	?>		
		
		<a href='dispenseOutPatient.php'>		
			<button class='orange button marginTop'>Go Back</button>
		</a>
		
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
	<script type="text/javascript">
		$(function(){
		
			function countdown() {
				$i = parseInt($('.countdown').html());
				if ($i == 1) {
					location.href = 'dispenseOutPatient.php';
				}
				$('.countdown').html($i-1);
			}
			setInterval(function(){countdown();},1000);
			
		});
	</script>
		
</html>

<?php } else{ header('Location: dispenseOutPatient.php'); } ?>