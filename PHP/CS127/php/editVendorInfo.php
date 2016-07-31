<?php 
	include_once('./includes/sessionStarter.php'); 
	include_once('./includes/_connect.php');

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
	
	if(isset($_POST['updateVendorId'])){
			$sql="UPDATE vendorinfotable SET vendorinfotable.contactNo='".$_POST['updateContactNo']."' 
				WHERE vendorinfotable.contactNo='".$_POST['PREVupdateContactNo']."' AND vendorinfotable.vendorId='".$_POST['updateVendorId']."'";
			mysqli_query($connect, $sql);
		echo "<div class='green notice centerNotice smallMarginTop smallMarginBottom'>Vendor information has been updated</div>";
	}
	?>

<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
	
			<div class='modal'>
			<div class='innerModal'>
			
				<div class='removeModal'>X</div>
				
				<form class='updateForm noMargin' name='updateForm' method='POST' enctype='multipart/form-data' action=''>
					<h1>Update Vendor Information</h1> 

					<p> 
						<b class='blue'>Vendor Id</b><input type='textbox' name='updateVendorId' id='updateVendorId' style='border: none;' readonly>
						<input type='hidden' name='PREVupdateVendorId' id='PREVupdateVendorId'>
					</p> 
					<p> 
						<b class='blue'>Vendor Name</b><input type='textbox' name='updateVendorName' id='updateVendorName' style='border: none;' readonly>
						<input type='hidden' name='PREVupdateVendorName' id='PREVupdateVendorName'>
					</p> 
					<p> 
						<b class='blue'>Contact Number</b><input type='textbox' name='updateContactNo' id='updateContactNo'>
						<input type='hidden' name='PREVupdateContactNo' id='PREVupdateContactNo'>
						<div class='red notice smallMarginTop smallMarginBottom hidden'>Please input contact details!</div>
					</p> 
					
					<button type='button' class='updateSubmit orange button'>Submit</button>
					<div class='hidden' id='rowID'></div>
				</form>
			</div>
		</div>
	
		<div class='content'>
			
			<?php include_once('./includes/submenu.php'); ?>

			<?php include_once('./includes/eviSearchFunction.php'); ?>
			
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>