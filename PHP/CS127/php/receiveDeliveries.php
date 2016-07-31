<?php 
	
	include_once('./includes/sessionStarter.php');
	include_once('./includes/_connect.php');
	  
	/*
	* This block of code adds the received delivery to the Database when the user clicks Receive Delivery after
	* filling up the form. It updates the reorder Table that the order has been received, the total quantityBox
	* of that product, deletes related notifications and updates the activity log.
	*/

	 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finalDelivery'])){
	
		date_default_timezone_set("Asia/Manila");
			$t = microtime(true);
			$micro = sprintf("%06d",($t - floor($t)) * 1000000);
			$date=date("m-d-Y");
			$time = date("h:i:s.".$micro."a");
	
		$finalDelivery = explode(",",$_POST['finalDelivery']);
		
		$i=0;
		$dateOrdered = $finalDelivery[0];
		$timeOrdered = $finalDelivery[1];
		$productId = $finalDelivery[2];
		$vendorId = $finalDelivery[3]; 
		$receivedBy = $finalDelivery[4]; 
		$orderedBy = $finalDelivery[5]; 
		$dateReceived = $finalDelivery[6];
		$rdNumOfSmallBox = $finalDelivery[7]; 
		$rdNumOfBigBox = $finalDelivery[8]; 
		$lotNumber = $finalDelivery[9]; 
		$expiryMonth = $finalDelivery[10]; 
		$expiryYear = $finalDelivery[11]; 
		$rdTotalExpense = $finalDelivery[12]; 
		$salesInvoice = $finalDelivery[13]; 
		$rdTotalUnits = $finalDelivery[14]; 
		$roTotalUnits = $finalDelivery[15]; 
		
		$sql = 
			"INSERT INTO deliveriestable(dateReceived, timeReceived, receivedBy, productId, dateOrdered, timeOrdered, orderedBy, rdNumOfSmallBox, rdNumOfBigBox, rdTotalExpense, roTotalUnits, rdTotalUnits, expiryMonth, expiryYear, vendorId, lotNumber, salesInvoice) 
			VALUES ('" . $dateReceived . "','" . $time . "','" . $receivedBy . "','" . $productId . "','" . $dateOrdered . "','" . $timeOrdered . "','" . $orderedBy . "','" . $rdNumOfSmallBox . "'," . $rdNumOfBigBox . "," . $rdTotalExpense . "," . $roTotalUnits . "," . $rdTotalUnits . "," . $expiryMonth . "," . $expiryYear . ",'" . $vendorId . "','" . $lotNumber . "','" . $salesInvoice . "');";
		mysqli_query($connect, $sql);
		
		//DELETES THE ENTRY THAT HAS BEEN RECEIVED
		$sql = 
			"UPDATE reordertable 
			SET isReceived = 1
			WHERE productId='" . $productId . "' 
			AND dateOrdered='" . $dateOrdered . "';";
		mysqli_query($connect, $sql);
	
		//UPDATES THE TOTAL QUANTITY OF THE ENTRY THAT HAS BEEN RECEIVED
		$sql = 
			"SELECT totalQuantity 
			FROM dynamicproducttable 
			WHERE productId='" . $productId . "';";
		$result = mysqli_query($connect, $sql);
		$totalQuantity = mysqli_fetch_array($result);
		
		$newQuantity = $totalQuantity[0] + $rdTotalUnits;
		$sql = 
			"UPDATE dynamicproducttable 
			SET totalQuantity=" . $newQuantity . " 
			WHERE productId ='" . $productId . "';";
		mysqli_query($connect, $sql);
		
		//DELETES NOTIFICATION ENTRY OF RECEIVED DRUG TO REPLACE EXPIRING DRUGS FROM NOTIFICATIONS
		$sql = 
			"UPDATE dynamicproducttable 
			SET isExpiring = '3'
			WHERE productId = '" . $productId . "'
			AND isExpiring = '2';";
		mysqli_query($connect, $sql);
		
		//DELETES NOTIFICATION ENTRY OF RECEIVED DRUG TO REPLACE LOW ON QUANTITY DRUGS FROM NOTIFICATIONS
		$sql = 
			"UPDATE dynamicproducttable 
			SET isLowOnQuantity = '3'
			WHERE productId = '" . $productId . "'
			AND isLowOnQuantity = '2';";
		mysqli_query($connect, $sql);
		
		/* FOR ACTIVITY LOGS */
			$date2=date("m/d/Y");	// mark
			$dateReceived2 = $dateReceived;
			$dateReceived2[2] = "/";	// mark
			$dateReceived2[5] = "/";
			$writeStr = "delivered" . $dateReceived2;
			$sql = 
				"INSERT INTO activitytable(activityDate, activityTime, activityType, fullName, userType) 
				VALUES('" . $date2 ."', '" . $time . "', '" . $writeStr . "', '" . $receivedBy . "', '" . $usertype . "')";
			mysqli_query($connect, $sql);
		
	}
?>

<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
		
		<!-- This is the form that needs to be filled up when receiving a delivery -->
		
		<div class='modal'>
			<div class='innerModal'>
			
				<div class='removeModal'>X</div>
				
				<form class='rdForm'>
					<h1>Request Information</h1> 
					<p> 
						<b class='blue'>Date Ordered</b>
						<span class='rdDateOrdered'></span>
					</p> 
					<p>
						<b class='blue'>Time Ordered</b>
						<span class='rdTimeOrdered'></span>
					</p>
					<p> 
						<b class='blue'>Ordered By</b>
						<input type='textbox' id='rdRequestedBy' class='disabled modalInputWidth' readonly>
					</p> 
					<p>					
					<?php
						$yearToday = date('Y');
						$monthToday = date('m');
						$dayToday = date('d');
					?>					
						<b class=' green'>Date Received</b>
						<select id='rdDateReceivedMonth' class='grayBorder'>
							<?php $i=1; while($i<=12){ ?> 
							<option <?php if($i == $monthToday) { echo "selected";} ?> value='<?php echo $i; ?>'> 
								<?php echo $i; ?> 
							</option> 
						<?php $i++;} ?>
						</select>
						<select id='rdDateReceivedDay' class='grayBorder'>
							<?php $i=1; while($i<=31){ ?> 
							<option  <?php if($i == $dayToday) { echo "selected";} ?> value='<?php echo $i; ?>'> 
								<?php echo $i; ?> 
							</option> 
							<?php $i++;} ?>
						</select>
						<select id='rdDateReceivedYear' class='grayBorder'>
							<?php $i=$yearToday-1; while($i<=$yearToday){ ?> 
							<option <?php if($i == $yearToday) { echo "selected";} ?> value='<?php echo $i; ?>'> 
								<?php echo $i; ?> 
							</option> 
							<?php $i++;} ?>
						</select>
					</p> 
					<p> 
						<b class='blue'>Received by</b>
						<span class='rdReceivedBy'></span>
					</p>
					<hr>
					<h4>Product Information</h4>
					
					<div style='overflow:auto'>
						<img class='modalProductImage marginBottom' src='' />
						<p class='noMargin'> 
							<b class='blue'>Product Id</b>
							<span class='rdProductId'></span>
						</p> 
						<p> 
							<b class='blue'>Generic Name</b>
							<span class='rdgenericName'></span>
						</p> 
						<p> 
							<b class='blue'>Brand Name</b>
							<span class='rdBrandName'></span>
						</p> 
						<p> 
							<b class='blue'>Type</b>
							<span class='rdType'></span>
						</p> 
						<p> 
							<b class='blue'>Dosage</b>
							<span class='rdDosage'></span>
						</p> 
						<p> 
							<b  class='blue' style='line-height:60px'>Classification</b>
							<span class='rdDescription'></span>
						</p>
					</div>
					<p class='noMargin'>
						<b class='blue'>Vendor Name </b>
						<span class='rdVendor'></span>
					</p> 
					<p> 
						<b class='blue'>Price Per Unit</b>
						<span class='PricePerUnit priceBox lightgray smallPaddingRight floatLeft'></span>
						<span class='inputInclude gray'>Php</span>
					</p> 
					<p> 
						<b class='blue'>Number of Unit per Small Box</b>
						<span class='numOfUnitPerSmallBox quantityBox lightgray smallPaddingRight floatLeft'></span>
						<span class='inputInclude gray'>Units / Small Box</span>
					</p>
					<p class='BigBox'> 
						<b class='blue'>Number of Small Box per Big Box</b>
						<span class='numOfSmallBoxPerBigBox quantityBox lightgray smallPaddingRight floatLeft'></span>
						<span class='inputInclude gray'>Small Boxes / Big Box</span>
					</p>	
					<hr>
					<h4>Request Details</h4>
					<p class='BigBox'> 
						<b class='blue'>Requested Number of Big Boxes</b>
						<span class='roNumOfBigBox quantityBox lightgray smallPaddingRight floatLeft'></span>
						<span class='inputInclude gray'>Boxes</span>
					</p> 
					<p class='SmallBox'> 
						<b class='blue'>Requested Number of Small Boxes</b>
						<span class='roNumOfSmallBox quantityBox lightgray smallPaddingRight floatLeft'></span>
						<span class='inputInclude gray'>Boxes</span>
					</p> 
					<p> 
						<b class='blue'>Expected Total Units</b>
						<span class='roTotalUnits quantityBox lightgray smallPaddingRight floatLeft' style='display:none'></span>
						<span class='roTotalUnitsShown quantityBox lightgray smallPaddingRight floatLeft'></span>
						<span class='inputInclude gray'>Units</span>
					</p> 
					<p> 
						<b class='blue'>Expected Total Expense</b>
						<span class='roTotalExpense quantityBox lightgray smallPaddingRight floatLeft' style='display:none'></span>
						<span class='roTotalExpenseShown quantityBox lightgray smallPaddingRight floatLeft'></span>
						<span class='inputInclude gray'>Php</span>
					</p> 
					<hr>
					<h4>Delivery Details</h4>
					<p class='BigBox'> 
						<b class=' green'>Received Number of Big Box</b>
						<input type='number' id='rdNumOfBigBox' min="0" class='floatLeft editableQuantityBox grayBorder'>
						<span class='inputInclude gray'>Boxes</span>
					</p>
					<p class='SmallBox'>
						<b class=' green'>Received Number of Small Box</b>
						<input type='number' id='rdNumOfSmallBox' min="0" class='floatLeft editableQuantityBox grayBorder'>
						<span class='inputInclude gray'>Boxes</span>
					</p>
					<p> 
						<b class=' green'>Total Units</b>
						<span class='rdTotalUnits quantityBox lightgray smallPaddingRight floatLeft' style='display:none'></span>
						<span class='rdTotalUnitsShown quantityBox lightgray smallPaddingRight floatLeft'>0</span>
						<span class='inputInclude gray'>Units</span>
					</p> 
					<p>
						<b class=' green'>Total Expense</b>
						<span class='rdTotalExpense quantityBox lightgray smallPaddingRight floatLeft' style='display:none'></span>
						<span class='rdTotalExpenseShown quantityBox lightgray smallPaddingRight floatLeft'>0</span>
						<span class='inputInclude gray'>Php</span>
					</p>
					<p> 
						<b class='green'>Expiry Date</b>
						<select id='rdEMonth' class='grayBorder'>
							<option class='noOption' value='' selected>Select Month</option>
							<?php $i=1; while($i<=12){ ?> 
								<option> 
									<?php echo $i; ?> 
								</option> 
							<?php $i++;} ?>
						</select>
						<select id='rdEYear' class='grayBorder'>
							<option class='noOption' value='' selected>Select Year</option>
							<?php $i=$yearToday; while($i<=$yearToday+10){ ?> 
								<option> 
									<?php echo $i; ?> 
								</option> 
							<?php $i++;} ?>
						</select>
					</p> 
					<p> 
						<b class=' green'>Lot/Batch Number</b>
						<input type='textbox' id='rdLot' placeholder='Input Lot/Batch Number' class='grayBorder'>
					</p> 
					<p>
						<b class=' green'>Sales Invoice</b>
						<input type='textbox' id='rdSalesInvoice' placeholder='Input Invoice Number' class='grayBorder'>
					</p> 
					<button class='rdSubmit orange button marginTop'>Receive Delivery</button>										
					<div class='hidden' id='rowID'></div>					
				</form>
			</div>
		</div>
		
		<div class='content'>
		
			<?php 
			if($usertype != 'Assistant Pharmacist'){
				include_once('./includes/submenu.php');
			}?>
			
			<?php include_once('./includes/rdSearchFunction.php') ?>
			
			<form method='post' ID='deliveriesForm'>
				<input type='hidden' name='finalDelivery' id='finalDelivery'>
			</form>
		</div>
	
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>