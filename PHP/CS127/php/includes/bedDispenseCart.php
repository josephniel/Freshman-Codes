<?php

//EDITED!!! NILAGAY KO YUNG REQUESTING PHYSICIAN DROPDOWN BUKAS
?>
<div class='opShoppingCart shoppingCart'>
	<span>Product List</span>
	<form method='post' id='dispenseForm' style='position: relative; overflow: auto;'> 
		<div class='tableFormat'>			
			<div class='row tableHeaderRow move'>
				<div class='column5 column tableHeader'></div>
				<div class='column1 column tableHeader'>Product Code</div>
				<div class='column2 column tableHeader'>Generic Name</div>
				<div class='column3 column tableHeader'>Brand Name</div>
				<div class='column4 column tableHeader'>Quantity</div>
			</div>
			<div class='horizontalScroll dpCart'>
			
			</div>
		</div>
		
		<hr class='marginTop marginBottom'>
		
		<div class='floatLeft'>
			<div class='marginTop smallMarginLeft'>
				<span>Slip Number</span>
				<input required type = 'text' id = 'slipNumber' name = 'slipNumber'>
			</div>
			
			<div class='marginTop smallMarginLeft'>			
			<span>Requesting physician</span>
			<select name='inPatientRP' id='inPatientRP' class='grayBorder' required>
				<option value="" disable selected> -- Select One -- </option>
				<?php							 
					$value = mysqli_query($connect, "SELECT DISTINCT physicianName FROM `requestingphysiciantable` ORDER BY physicianName");		
					while($row = mysqli_fetch_array($value)) {
						$physicianName = $row['physicianName'];
						if($physicianName != NULL || $physicianName != ""){ 
							if ($type == $physicianName)
								echo "<option selected value='$physicianName'>" . ucfirst($physicianName) . "</option>";
							else
								echo "<option value='$physicianName'>" . ucfirst($physicianName) . "</option>";
						}
					}				
				?>
			</select>
			</div>
		</div>
						
		<input type='submit' value='Add Products to Bed' class='orange button marginTop' style='position:absolute;bottom:0;right:10px;'>			
						
		<input type='hidden' name='inPatientBedNo' value = "<?php echo $_SESSION['currentPatient']?>">
		<input type='hidden' name='addedSomething' value = "1">
	</form>
</div>