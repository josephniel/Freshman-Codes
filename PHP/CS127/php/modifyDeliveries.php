<?php include_once('./includes/sessionStarter.php'); 

	if(isset($_Session['searchCategory'])){
		$searchCategory = $_SESSION['searchCategory'];
	}
	if(isset($_Session['query'])){
		$queryValue = $_SESSION['query'];
	}
	if(isset($_Session['sortCategory'])){
		$sortCategory = $_SESSION['sortCategory'];
	}
	if(isset($_Session['startSearch'])){
		$startSearch = $_SESSION['startSearch'];
	}
	if(isset($_Session['value'])){
		$value = $_SESSION['value'];
	}
	
	if(isset($_POST['editedEntry'])){
		include_once('./includes/_connect.php');

		$editedEntry = explode(",",$_POST['editedEntry']);
		
		$productId = $editedEntry[0];
		
		$PREVupdateDateOrdered = $editedEntry[1];
		
		$PREVupdateDateReceived = $editedEntry[2];
		
		$dateReceived = $editedEntry[3];
			//Date Received
			$sql="UPDATE deliveriestable SET deliveriestable.dateReceived='".$dateReceived."' WHERE deliveriestable.dateReceived='".$PREVupdateDateReceived."' AND deliveriestable.dateOrdered='".$PREVupdateDateOrdered."' AND deliveriestable.productId='".$productId."'";
			mysqli_query($connect, $sql);
		
		$quantity = $editedEntry[4];
			//Quantity
			$sql="UPDATE deliveriestable SET deliveriestable.rdTotalUnits='".$quantity."' WHERE deliveriestable.dateReceived='".$PREVupdateDateReceived."' AND deliveriestable.dateOrdered='".$PREVupdateDateOrdered."' AND deliveriestable.productId='".$productId."'";
			mysqli_query($connect, $sql);
		
		$lotNumber = $editedEntry[5];
			//lot number
			$sql="UPDATE deliveriestable SET deliveriestable.lotNumber='".$lotNumber."' WHERE deliveriestable.dateReceived='".$PREVupdateDateReceived."' AND deliveriestable.dateOrdered='".$PREVupdateDateOrdered."' AND deliveriestable.productId='".$productId."'";
			mysqli_query($connect, $sql);
		
		$expiryMonth = $editedEntry[6];
			//expiry month
			$sql="UPDATE deliveriestable SET deliveriestable.expiryMonth='".$expiryMonth."' WHERE deliveriestable.dateReceived='".$PREVupdateDateReceived."' AND deliveriestable.dateOrdered='".$PREVupdateDateOrdered."' AND deliveriestable.productId='".$productId."'";
			mysqli_query($connect, $sql);
		
		$expiryYear = $editedEntry[7];
			//expiry year
			$sql="UPDATE deliveriestable SET deliveriestable.expiryYear='".$expiryYear."' WHERE deliveriestable.dateReceived='".$PREVupdateDateReceived."' AND deliveriestable.dateOrdered='".$PREVupdateDateOrdered."' AND deliveriestable.productId='".$productId."'";
			mysqli_query($connect, $sql);
		
		$quantityOfSmallBoxes = $editedEntry[8];
			//Quantity of Small boxes
			$sql="UPDATE deliveriestable SET deliveriestable.rdNumOfSmallBox='".$quantityOfSmallBoxes."' WHERE deliveriestable.dateReceived='".$PREVupdateDateReceived."' AND deliveriestable.dateOrdered='".$PREVupdateDateOrdered."' AND deliveriestable.productId='".$productId."'";
			mysqli_query($connect, $sql);
		
		$quantityOfBigBoxes = $editedEntry[9];
			//Quantity of Big boxes
			$sql="UPDATE deliveriestable SET deliveriestable.rdNumOfBigBox='".$quantityOfBigBoxes."' WHERE deliveriestable.dateReceived='".$PREVupdateDateReceived."' AND deliveriestable.dateOrdered='".$PREVupdateDateOrdered."' AND deliveriestable.productId='".$productId."'";
			mysqli_query($connect, $sql);
		
		$totalExpense = $editedEntry[10];
			//Total Expense
			$sql="UPDATE deliveriestable SET deliveriestable.rdTotalExpense='".$totalExpense."' WHERE deliveriestable.dateReceived='".$PREVupdateDateReceived."' AND deliveriestable.dateOrdered='".$PREVupdateDateOrdered."' AND deliveriestable.productId='".$productId."'";
			mysqli_query($connect, $sql);
		
		$salesInvoice = $editedEntry[11];
			//Invoice
			$sql="UPDATE deliveriestable SET deliveriestable.salesInvoice='".$salesInvoice."' WHERE deliveriestable.dateReceived='".$PREVupdateDateReceived."' AND deliveriestable.dateOrdered='".$PREVupdateDateOrdered."' AND deliveriestable.productId='".$productId."'";
			mysqli_query($connect, $sql);
		
		//Total Quantity
		mysqli_query($connect, "UPDATE dynamicproducttable SET totalQuantity = (select sum(rdTotalUnits) from deliveriestable where productId = '".$productId."') WHERE productId = '".$productId."'");	
	}
	?>

<html>
	
	<?php include_once('./includes/bodyUpper.php')?>
		
		<div class='modal'>
			<div class='innerModal'>
			
				<div class='removeModal'>X</div>
				
				<form class='updateForm' name='updateForm' method='POST'>
					<h1>Edit Delivery Entry</h1>
					<p> 
						<b class='blue'>Date Ordered</b>
						<span id='updateDateOrdered' class='disabled dateBoxWidth'></span>
						<input type='hidden' name='PREVupdateDateOrdered' id='PREVupdateDateOrdered'>
					</p>
					<p> 
						<b class='blue'>Ordered by</b>
						<input type='textbox' name='updateRequestedBy' id='updateRequestedBy' class='disabled modalInputWidth' readonly>
					</p>	
					<p> 
						<b class='green'>Date Received</b>
						<select name='updateDateReceivedM' id='updateDateReceivedM' class='grayBorder'>
							<?php $i=1; while($i<=12){ ?> 
							<option> 
								<?php echo $i; ?> 
							</option> 
							<?php $i++;} ?>
						</select>
						<select name='updateDateReceivedD' id='updateDateReceivedD' class='grayBorder'>
							<?php $i=1; while($i<=31){ ?> 
							<option> 
								<?php echo $i; ?> 
							</option> 
							<?php $i++;} ?>
						</select>
						<select name='updateDateReceivedY' id='updateDateReceivedY' class='grayBorder'>
							<?php $i=2000; while($i<=2050){ ?> 
							<option> 
								<?php echo $i; ?> 
							</option> 
							<?php $i++;} ?>
						</select>
						<input type='hidden' name='updateDateReceived' id='updateDateReceived'>
						<input type='hidden' name='PREVupdateDateReceived' id='PREVupdateDateReceived'>
	
					</p>
					<p> 
						<b class='blue'>Received by</b>
						<input type='textbox' name='updateReceivedBy' id='updateReceivedBy' class='disabled modalInputWidth' readonly>
					</p>
					<hr>
					<h4>Product Information</h4>
					<div style='overflow:auto'>
						<img class='modalProductImage marginBottom' src='' />
						<p> 
							<b class='blue'>Product Id</b>
							<input type='textbox' name='updateProductId' id='updateProductId' class='disabled modalInputWidth' readonly>
						</p> 
						<p> 
							<b class='blue'>Generic Name</b>
							<input type='textbox' name='updateGenericName' id='updateGenericName' class='disabled modalInputWidth' readonly>
						</p> 
						<p> 
							<b class='blue'>Brand Name</b>
							<input type='textbox' name='updateBrandName' id='updateBrandName' class='disabled modalInputWidth' readonly>
						</p> 
						<p>
							<b class='blue'>Type</b>
							<input type='textbox' name='updateType' id='updateType' class='disabled modalInputWidth' readonly>
						</p>
						<p>
							<b class='blue'>Dosage</b>
							<input type='textbox' name='updateDosage' id='updateDosage' class='disabled modalInputWidth' readonly>
						</p>
						<p>
							<b class='blue' style='line-height:70px;'>Classification</b>
							<input type='textbox' name='updateClassification' id='updateClassification' class='disabled modalInputWidth' readonly>
						</p> 
					</div>
					<p class='noMargin'>
						<b class='blue'>Vendor Name</b>
						<input type='textbox' name='updateVendor' id='updateVendor' class='disabled modalInputWidth' readonly>
					</p>
					<p>
						<b class='blue'>Price Per Unit</b>
						<input type='textbox' name='Price' id='Price' class='priceBox lightgray smallPaddingRight floatLeft noBorder' readonly>
						<span class='inputInclude gray'>Php</span>
					</p> 
					
					<p>
						<b class='blue'>Number of Unit per Small Box</b>
						<input type='textbox' name='PerSmall' id='PerSmall' class='modalInputWidth quantityBox lightgray smallPaddingRight floatLeft noBorder' readonly>
						<span class='inputInclude gray'>Unit / Small Box</span>
					</p> 
					
					<p class='bigBox'>
						<b class='blue'>Number of Small Box per Big Box</b>
						<input type='textbox' name='PerBig' id='PerBig' class='modalInputWidth quantityBox lightgray smallPaddingRight floatLeft noBorder' readonly>
						<span class='inputInclude gray'>Small Box / Big Box</span>
					</p> 
					
					<p>
						<b class='blue'>Total Ordered Units</b>
						<input type='textbox' name='roTotalUnits' id='roTotalUnits' class='modalInputWidth quantityBox lightgray smallPaddingRight floatLeft noBorder' readonly>
						<span class='inputInclude gray'>Units</span>
					</p> 
					
					<hr>
					<h4>Delivery Details</h4>
					<p class='smallBox'> 
						<b class='green'>Number of Small Boxes Received</b>
						<input type='number' min='1' name='updateNSBoxes' id='updateNSBoxes' class='floatLeft editableQuantityBox'>
						<span class='inputInclude gray'>Boxes</span>
					</p> 
					
					<p class='bigBox'> 
						<b class='green'>Number of Big Boxes Received</b>
						<input type='number' min='1' name='updateNBBoxes' id='updateNBBoxes' class='floatLeft editableQuantityBox grayBorder'>
						<span class='inputInclude gray'>Boxes</span>
					</p> 
					<p>
						<b class='green'>Batch Total Units</b>
						<input type='textbox' name='updateQPUnit' id='updateQPUnit' class='modalInputWidth priceBox lightgray smallPaddingRight floatLeft noBorder' readonly style='display:none'>
						<span id='updateQPUnitShown' class='modalInputWidth priceBox lightgray smallPaddingRight floatLeft noBorder'>&nbsp;</span>
						<span class='inputInclude gray'>Units</span>
					</p>
					<p>
						<b class='green'>Total Expense</b>
						<input type='textbox' name='updateExpense' id='updateExpense' class='modalInputWidth priceBox lightgray smallPaddingRight floatLeft noBorder' readonly style='display:none'>
						<span id='updateExpenseShown' class='modalInputWidth priceBox lightgray smallPaddingRight floatLeft noBorder'>&nbsp; </span>
						<span class='inputInclude gray'>Php</span>
					</p>	
					<p> 
						<b class='green'>Expiry Date</b>
						<select name='updateEMonth' id='updateEMonth' class='grayBorder'>
							<?php $i=1; while($i<=12){ ?> 
								<option> 
									<?php echo $i; ?> 
								</option> 
							<?php $i++;} ?>
						</select>
						<input type='hidden' name='PREVupdateEMonth' id='PREVupdateEMonth' >
						<select name='updateEYear' id='updateEYear' class='grayBorder'>
							<?php $i=date('Y'); while($i<=date('Y')+15){ ?> 
								<option> 
									<?php echo $i; ?> 
								</option> 
							<?php $i++;} ?>
						</select>
						<input type='hidden' name='PREVupdateEYear' id='PREVupdateEYear'>
					</p> 				
					<p> 
						<b class='green'>Lot Number</b><input type='textbox' name='updateLot' id='updateLot' class=' grayBorder'>
						<input type='hidden' name='PREVupdateLot' id='PREVupdateLot'>
					</p> 	
					<p> 
						<b class='green'>Sales Invoice</b>
						<input type='textbox' name='updateInvoice' id='updateInvoice' class='grayBorder'>
						<input type='hidden' name='PREVupdateInvoice' id='PREVupdateInvoice'>
					</p>
					<button class='updateDeliveriesSubmit orange button marginTop'>Edit Delivery Entry</button>
					<div class='hidden' id='rowID'></div>
				</form>
			</div>
		</div>
	
		<div class='content'>
			
			<?php include_once('./includes/submenu.php'); ?>
			
			<?php include_once('./includes/mdSearchFunction.php'); ?>
			
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>