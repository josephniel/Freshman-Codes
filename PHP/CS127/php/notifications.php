<?php 

	include_once('./includes/sessionStarter.php');
	include_once('./includes/_connect.php');
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finalOrder'])){

		$finalOrder = explode(",",$_POST['finalOrder']);
	
		$productId = $finalOrder[1]; 		// product Id
		$vendorId = $finalOrder[2]; 		// vendor Id
		$requestedBy = $finalOrder[3]; 		// requested By
		$dateOrdered = $finalOrder[4]; 		// roDateOrdered
		$numOfSmallBox = $finalOrder[5]; 	// ro Num of Small Box
		$numOfBigBox = $finalOrder[6]; 		// ro Num of Big box
		$totalExpense = $finalOrder[7]; 	// ro Total Expense
		$totalUnits = $finalOrder[8]; 		// ro Total Units
		
		date_default_timezone_set("Asia/Manila");
			$t = microtime(true);
			$micro = sprintf("%06d",($t - floor($t)) * 1000000);
			$time = date("h:i:s.".$micro."a");
		
		$sql = 
			"INSERT INTO reordertable (productId, vendorId, timeOrdered, requestedBy, dateOrdered, roNumOfBigBox, roTotalExpense, roTotalUnits, roNumOfSmallBox) 
			VALUES ('" . $productId . "','" . $vendorId . "','" . $time . "','" . $requestedBy . "','" . $dateOrdered . "'," . $numOfBigBox . "," . $totalExpense . "," . $totalUnits . "," . $numOfSmallBox . ");";
		mysqli_query($connect, $sql);
		
		$notificationType = $finalOrder[0];
		
		if($notificationType == 'loq'){
			$sql = 
				"UPDATE dynamicproducttable 
				SET isLowOnQuantity = '2' 
				WHERE dynamicproducttable.productId = '".$productId."'";
			mysqli_query($connect, $sql);
		}else{
			$sql = 
				"UPDATE dynamicproducttable 
				SET isExpiring='2' 
				WHERE dynamicproducttable.productId = '".$productId."'";
			mysqli_query($connect, $sql);
		}
		
	}
	
	$sql = 
		"UPDATE dynamicproducttable 
		SET isLowOnQuantity = '0' 
		WHERE isLowOnQuantity = '3'";
	mysqli_query($connect, $sql);
	
	$sql = 
		"UPDATE dynamicproducttable 
		SET isExpiring = '0' 
		WHERE isExpiring = '3'";
	mysqli_query($connect, $sql);
	
?>

<html>

	<?php include_once('./includes/bodyUpper.php') ?>
	
		<?php include_once('./includes/notificationsModal.php') ?>
		
		<div class='content notificationsArea'>
			
			<hr>
			
			<h4 class='marginTop marginBottom'><center>Low on Quantity</center></h4>
			
			<hr>
			
			<?php 
				$sql = 
					"SELECT COUNT(*) FROM dynamicproducttable 
					WHERE dynamicproducttable.isLowOnQuantity <> 0";
				$row = mysqli_fetch_array(mysqli_query($connect, $sql));
				
				if($row[0] == 0){
			?>	
			
				<h4>There are no low on quantity products at the moment.</h4>
			
			<?php
				}
				else{
					$sql = 
						"SELECT productId, totalQuantity, isLowOnQuantity FROM dynamicproducttable 
						WHERE dynamicproducttable.isLowOnQuantity <> 0";
					$lowOnQuantity = mysqli_query($connect, $sql);
					while($row = mysqli_fetch_array($lowOnQuantity)) {
			
						$sql = 
							"SELECT * FROM producttable, deliveriestable, vendorordertable, vendorinfotable
							WHERE producttable.productId = '" . $row['productId'] . "'
							AND deliveriestable.productId = '" . $row['productId'] . "'
							AND vendorordertable.productId = '" . $row['productId'] . "'
							AND vendorinfotable.vendorId = vendorordertable.vendorId;";
						$row2 = mysqli_fetch_array(mysqli_query($connect, $sql));
			?>
					<div class='notifications lowOnQuantity'>
					
						<p class='notifContent'>
							<?php if($row['isLowOnQuantity'] == 1){ ?>
								<span class='exclamation red'>!</span>
							<?php } else { ?>
								<span class='exclamation orange'>!</span>
							<?php } ?>
							<b><?php echo $row2['brandName'] ?></b> is low on quantity.
							
							<?php if($usertype != 'Assistant Pharmacist'){?>
								<?php if($row['isLowOnQuantity'] == 1){ ?>
									<button class='notificationReorder floatRight green'>Order <?php echo $row2['brandName'] ?></button>
								<?php } else { ?>
									<button class='floatRight orange disabled'><?php echo $row2['brandName'] ?> Ordered</button>
								<?php } ?>
							<?php } ?>
						</p>
						
						<div class='productInformation hidden'>
							<span class='productId'><?php echo $row['productId'] ?></span>
							<span class='genericName'><?php echo $row2['genericName'] ?></span>
							<span class='brandName'><?php echo $row2['brandName'] ?></span>
							<span class='classification'><?php echo $row2['classification'] ?></span>
							<span class='unitPrice'><?php echo $row2['pricePerUnit'] ?></span>
							<span class='requestedBy'><?php echo $fullname ?></span>
							<span class='noOfSBperBB'><?php echo $row2['noOfSmallBoxPerBigBox'] ?></span>
							<span class='noOfUnitsperSB'><?php echo $row2['noOfUnitPerSmallBox'] ?></span>
							<span class='vendorId'><?php echo $row2['vendorId'] ?></span>
							<span class='vendorName'><?php echo $row2['vendorName'] ?></span>
							<span class='vendorContact'><?php echo $row2['contactNo'] ?></span>
							<span class='notificationType'>loq</span>
						</div>
						
						<form method='post' id='notifReorderForm' action='notifications.php'>
							<input type='hidden' name='finalOrder' id='reorderArray'>
						</form>
						
						<hr>
						
						<h4>Details</h4>
						
						<div class='notifDetails column1'>
							<img src='../images/productImages/<?php echo $row2['imageFilename'] ?>' class='notificationImage productImageB'>
						</div>
						<div class='notifDetails column2'>
							<p>
								<b class='gray'>Generic Name</b> <?php echo $row2['genericName'] ?>
							</p>
							<p>
								<b class='gray'>Brand Name</b> <?php echo $row2['brandName'] ?>
							</p>
							<p>
								<b class='gray'>Dosage</b> <?php echo $row2['dosage'] ?>
							</p>
							<p>
								<b class='gray'>Type</b> <?php echo $row2['type'] ?>
							</p>
							<p>
								<?php if($row['isLowOnQuantity'] == 1){ ?>
									<b class='red'>Quantity Left</b> <?php echo $row['totalQuantity'] ?>
								<?php } else { ?>
									<b class='orange'>Quantity Left</b> <?php echo $row['totalQuantity'] ?>
							<?php } ?>
							</p>
						</div>
					
					</div>
			<?php }
				}
			?>
			
			<hr class='marginTop'>
			
			<h4 class='marginTop marginBottom'><center>Expiring</center></h4>
			
			<hr>
			
			<?php 
				$sql = 
					"SELECT COUNT(*) FROM dynamicproducttable 
					WHERE dynamicproducttable.isExpiring <> 0";
				$row = mysqli_fetch_array(mysqli_query($connect, $sql));
				
				if($row[0] == 0){
			?>	
			
				<h4>There are no expiring products at the moment.</h4>
			
			<?php
				}
				else{
					$sql = 
						"SELECT productId, isExpiring FROM dynamicproducttable 
						WHERE dynamicproducttable.isExpiring <> 0";
					$expiring = mysqli_query($connect, $sql);
					while($row = mysqli_fetch_array($expiring)) {
					
						$sql = 
							"SELECT * FROM producttable, deliveriestable, vendorordertable, vendorinfotable
							WHERE producttable.productId = '" . $row['productId'] . "'
							AND deliveriestable.productId = '" . $row['productId'] . "'
							AND vendorordertable.productId = '" . $row['productId'] . "'
							AND vendorinfotable.vendorId = vendorordertable.vendorId;";
						$row2 = mysqli_fetch_array(mysqli_query($connect, $sql));
				
			?>
					<div class='notifications expiring'>
					
						<p class='notifContent'>
							<?php if($row['isExpiring'] == 1){ ?>
								<span class='exclamation red'>!</span>
							<?php } else { ?>
								<span class='exclamation orange'>!</span>
							<?php } ?>
							<b><?php echo $row2['brandName'] ?></b> is expiring.
							<?php if($usertype != 'Assistant Pharmacist'){?>
								<?php if($row['isExpiring'] == 1){ ?>
									<button class='notificationReorder floatRight green'>Order <?php echo $row2['brandName'] ?></button>
								<?php } else { ?>
									<button class='floatRight orange disabled'><?php echo $row2['brandName'] ?> Ordered</button>
								<?php } ?>
							<?php } ?>
						</p>
						
						<div class='productInformation hidden'>
							<span class='productId'><?php echo $row['productId'] ?></span>
							<span class='genericName'><?php echo $row2['genericName'] ?></span>
							<span class='brandName'><?php echo $row2['brandName'] ?></span>
							<span class='classification'><?php echo $row2['classification'] ?></span>
							<span class='unitPrice'><?php echo $row2['pricePerUnit'] ?></span>
							<span class='requestedBy'><?php echo $fullname ?></span>
							<span class='noOfSBperBB'><?php echo $row2['noOfSmallBoxPerBigBox'] ?></span>
							<span class='noOfUnitsperSB'><?php echo $row2['noOfUnitPerSmallBox'] ?></span>
							<span class='vendorId'><?php echo $row2['vendorId'] ?></span>
							<span class='vendorName'><?php echo $row2['vendorName'] ?></span>
							<span class='vendorContact'><?php echo $row2['contactNo'] ?></span>
							<span class='notificationType'>e</span>
						</div>
						
						<form method='post' id='notifReorderForm'>
							<input type='hidden' name='finalOrder' id='reorderArray'>
						</form>
						
						<hr>
						
						<h4>Details</h4>
						
						<div class='notifDetails column1'>
							<img src='../images/productImages/<?php echo $row2['imageFilename'] ?>' class='notificationImage productImageB'>
						</div>
						
						<div class='notifDetails column2'>
							<p>
								<b class='gray'>Generic Name</b> <?php echo $row2['genericName'] ?>
							</p>
							<p>
								<b class='gray'>Brand Name</b> <?php echo $row2['brandName'] ?>
							</p>
							<p>
								<b class='gray'>Dosage</b> <?php echo $row2['dosage'] ?>
							</p>
							<p>
								<b class='gray'>Type</b> <?php echo $row2['type'] ?>
							</p>
							<p>
								<?php if($row['isExpiring'] == 1){ ?>
									<b class='red'>Expiration Date</b> <?php echo $row2['expiryMonth']."-".$row2['expiryYear'] ?>
								<?php } else { ?>
									<b class='orange'>Expiration Date</b> <?php echo $row2['expiryMonth']."-".$row2['expiryYear'] ?>
							<?php } ?>
							</p>
						</div>
					
					</div>
			<?php } 
				}
			?>
		
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>