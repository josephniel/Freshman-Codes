<?php 
	include_once('./includes/sessionStarter.php'); 
	include_once('./includes/_connect.php');
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		$totalPricePerUnit = $_POST['updatePricePerUnit'] . "." . $_POST['updatePricePerUnitCent'];
		$productId = $_POST['productId'];
		$vendorId = $_POST['vendorId'];
	
		//price per unit
		$sql=
			"UPDATE vendorordertable 
			SET pricePerUnit = " . $totalPricePerUnit . " 
			WHERE productId = '" . $productId . "' 
			AND vendorId = '" . $vendorId . "'";
		mysqli_query($connect, $sql);
		
		//delivery time
		$sql=
			"UPDATE vendorordertable 
			SET deliveryTime= " . $_POST['updateDeliveryTime'] . "
			WHERE productId='" . $productId . "' 
			AND vendorId='" . $vendorId . "'";
		mysqli_query($connect, $sql);
		
		//unit per small
		$sql=
			"UPDATE vendorordertable 
			SET noOfUnitPerSmallBox=".$_POST['updateUnitPerSmall']."
			WHERE productId='".$productId."' 
			AND vendorId='".$vendorId."'";
		mysqli_query($connect, $sql);
		
		//small per big
		if($_POST['updateSmallPerBig'] == '') {
			$sql=
				"UPDATE vendorordertable 
				SET noOfSmallBoxPerBigBox=null
				WHERE productId='".$productId."' 
				AND vendorId='".$vendorId."'";
		}else{
			$sql=
				"UPDATE vendorordertable 
				SET noOfSmallBoxPerBigBox=".$_POST['updateSmallPerBig']."
				WHERE productId='".$productId."' 
				AND vendorId='".$vendorId."'";
		}
		mysqli_query($connect, $sql);
		echo "<div class='green notice centerNotice smallMarginTop smallMarginBottom'>".$productId."'s  vendor product information has been updated.</div>";
	}
	?>

<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
	
			<div class='modal'>
			<div class='innerModal'>
			
				<div class='removeModal'>X</div>
				
				<form class='updateForm' name='updateForm' method='post'>
					<h1>Update Vendor Product Data</h1> 

					<h4>Product Information</h4>
					<div style='overflow:auto'>
						<img class='modalProductImage' src='' />
						<p class='noMargin'> 
							<b class='blue'>Product Id</b>
							<span id='updateProductId'></span>
						</p> 
						<p> 
							<b class='blue'>Generic Name</b>
							<span id='updateGenericName'></span>
						</p> 
						<p> 
							<b class='blue'>Brand Name</b>
							<span id='updateBrandName'></span>
						</p> 
						<p> 
							<b class='blue'>Type</b>
							<span id='updateType'></span>
						</p>
						<p> 
							<b class='blue'>Dose</b>
							<span id='updateDosage'></span>
						</p>
						<p> 
							<b class='blue withInput'>Classification</b>
							<span id='updateClassification'></span>
						</p>
					</div>
					
					<hr>
					<h4>Vendor Product Information</h4>
					<p> 
						<b class='blue'>Vendor Id</b>
						<span id='updateVendorId'></span>
					</p>
					<p> 
						<b class='blue'>Vendor Name</b>
						<span id='updateVendorName'></span>
					</p>
					<p> 
						<b class='green'>Delivery Time</b>
						<input type='number' name='updateDeliveryTime' id='updateDeliveryTime' min=1 class='quantityBox floatLeft'>
						<span class='inputInclude gray'>Day/s</span> 
					</p> 
					<p> 
						<b class='green'>Vendor Price Per Unit</b>
						<span class='inputInclude gray'>Php</span> 
						<input type='number' name='updatePricePerUnit' id='updatePricePerUnit' min=1 class='floatLeft priceBox'>
						
						<span class='inputInclude gray bold'>.</span> 
						
						<input type='number' name='updatePricePerUnitCent' id='updatePricePerUnitCent' min=0 max=99 class='centavoBox'>
					</p> 
					<p> 
						<b class='green'>Number of Unit per Small Box</b><input type='number' name='updateUnitPerSmall' id='updateUnitPerSmall' min=1 class='quantityBox floatLeft'>
						<span class='inputInclude gray'>Boxes</span> 
					</p> 
					<p> 
						<b class='green'>Number of Small Box per Big Box</b><input type='number' name='updateSmallPerBig' id='updateSmallPerBig' min=0 class='quantityBox floatLeft'>
						<span class='inputInclude gray'>Boxes</span> 
					</p> 
					
					<div class='marginTop marginBottom'>
						<p style='font-size: 14px;'>Note: Input <span class='bold'>0</span> if small boxes / big boxes is not applicable.</p>
					</div>
					
					<input type='hidden' name='productId' class='productId'>
					<input type='hidden' name='vendorId' class='vendorId'>
					
					<button type='button' class='updateSubmit orange button'>Submit</button>
					<div class='hidden' id='rowID'></div>
				</form>
			</div>
		</div>
	
		<div class='content'>
			
			<?php include_once('./includes/submenu.php'); ?>
			<?php include_once('./includes/evpSearchFunction.php'); ?>
			
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>