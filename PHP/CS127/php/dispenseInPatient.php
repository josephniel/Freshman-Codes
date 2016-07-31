<?php 

	include_once('./includes/sessionStarter.php');
	include_once('./includes/_connect.php');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['checkOut'])){
	
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
		
			//BED NO
			$sql = 
				"UPDATE inpatienttable 
				SET bedNo = '" . $currentInPatientBedNumber . "' 
				WHERE bedNo = '" . $previousInPatientBedNumber . "'";
			mysqli_query($connect, $sql);
			$sql = 
				"UPDATE inpatientproducttable 
				SET bedNo = '" . $currentInPatientBedNumber . "' 
				WHERE bedNo = '" . $previousInPatientBedNumber . "'";
			mysqli_query($connect, $sql);

			//PATIENT NAME
			$sql = 
				"UPDATE inpatienttable 
				SET patientFirstName = '" . $patientFirstName . "' ,
					patientMiddleName = '" . $patientMiddleName . "' ,
					patientLastName = '" . $patientLastName . "'
				WHERE bedNo = '" . $currentInPatientBedNumber . "'";
			mysqli_query($connect, $sql);
			
			//CHECK IN DATE
			$sql = 
				"UPDATE inpatienttable 
				SET checkInDate = '" . $checkInDate . "' 
				WHERE bedNo = '" . $currentInPatientBedNumber . "'";
			mysqli_query($connect, $sql);
	}else if(isset($_POST['checkOut'])){
		
		$bedNo = $_SESSION['currentPatient'];
		
		$sql = "DELETE FROM inpatienttable WHERE inpatienttable.bedNo = '" . $bedNo . "'";
		mysqli_query($connect, $sql);
		
		$sql = "DELETE FROM inpatientproducttable WHERE inpatientproducttable.bedNo = '" . $bedNo . "'";
		mysqli_query($connect, $sql);
		
	}
	
?>
<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
		<div class='content'>
			
			<?php include_once('./includes/submenu.php');?>
			
			<div class='modal'>
				<div class='innerModal'>
				
					<div class='removeModal'>X</div>
					
					<form class='inPatientForm' name='inPatientForm' method='POST' enctype='multipart/form-data' action=''>
						<h1 class='bedHead'>Bed Information</h1> 

						<p> 
							<b class='blue'>Bed</b>
							<input type='text' name='inPatientBedNo' id='inPatientBedNo' required>
							<input type='hidden' name='PREVinPatientBedNo' id='PREVinPatientBedNo'>
						</p> 
						<p> 
							<b class='withInput1 blue'>Patient Name</b>
							<input type='text' name='inPatientFirstName' id='inPatientFirstName' placeholder='First Name' required>
							<br />
							<input type='text' name='inPatientMiddleName' id='inPatientMiddleName' placeholder='Middle Name' class='smallMarginTop' required>
							<br />
							<input type='text' name='inPatientLastName' id='inPatientLastName' placeholder='Last Name' class='smallMarginTop' required>
							
						</p> 
						
						<p> 
							<b class='blue'>Check In Date</b>
							
							<?php 
								date_default_timezone_set("Asia/Manila");
								$yearToday = date('Y');
							?>
								<select name='checkInMonth' id='checkInMonth' class='grayBorder' required>
									<?php $i=1; while($i<=12){ ?> 
									<option value='<?php echo $i; ?>'> 
										<?php echo $i; ?> 
									</option> 
									<?php $i++;} ?>
								</select>
								<select name='checkInDay' id='checkInDay' class='grayBorder' required>
									<?php $i=1; while($i<=31){?> 
									<option value='<?php echo $i; ?>'> 
										<?php echo $i; ?> 
									</option> 
									<?php $i++;} ?>
								</select>
								<select name='checkInYear' id='checkInYear' class='grayBorder' required>
									<?php $i=$yearToday-1; while($i<=$yearToday){ ?> 
									<option value='<?php echo $i; ?>'> 
										<?php echo $i; ?> 
									</option> 
									<?php $i++;} ?>
								</select>
						</p>
						
						<button class='editInPatient orange button'>Confirm Edit</button>
						<div class='marginTop'></div>
						<button class='submitInPatient green button floatRight'></button>
						<div class='hidden' id='rowID'></div>
					</form>
					
				</div>
			</div>
			
			<?php include_once('./includes/ipSearchFunction.php') ?>
			
			<hr class='marginTop'>
			
			<button class="addBed orange button marginBottom">Add New Bed</button>
			
		
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
 </html>