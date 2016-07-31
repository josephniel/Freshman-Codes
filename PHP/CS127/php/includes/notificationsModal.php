<div class='modal notificationsReorder'>
	<div class='innerModal'>
			
		<div class='removeModal'>X</div>
				
		<form class='notificationsReorderForm'>
			<h1>Re-order Form</h1> 
			<p> 
				<b class='green'>Date Ordered:</b>
				<?php 
					date_default_timezone_set("Asia/Manila");
					$yearToday = date('Y');
					$monthToday = date('m');
					$dayToday = date('d'); 
				?>
					<select id='roDateOrderedMonth' class='grayBorder'>
						<?php $i=1; while($i<=12){ ?> 
						<option <?php if($i == $monthToday) { echo "selected";} ?> value='<?php echo $i; ?>'> 
							<?php echo $i; ?> 
						</option> 
						<?php $i++;} ?>
					</select>
					<select id='roDateOrderedDay' class='grayBorder'>
						<?php $i=1; while($i<=31){ ?> 
						<option  <?php if($i == $dayToday) { echo "selected";} ?> value='<?php echo $i; ?>'> 
							<?php echo $i; ?> 
						</option> 
						<?php $i++;} ?>
					</select>
					<select id='roDateOrderedYear' class='grayBorder'>
						<?php $i=$yearToday-1; while($i<=$yearToday){ ?> 
						<option <?php if($i == $yearToday) { echo "selected";} ?> value='<?php echo $i; ?>'> 
							<?php echo $i; ?> 
						</option> 
						<?php $i++;} ?>
					</select>
			</p> 
			<p> 
				<b class='blue'>Ordered By</b>
				<span class='roRequestedBy'></span>
			</p> 
			<hr>
			<h4>Product Information</h4>
			<p> 
				<b class='blue'>Product Id</b>
				<span class='roProductId'></span>
			</p> 
			<p> 
				<b class='blue'>Generic Name</b>
				<span class='rogenericName'></span>
			</p> 
			<p> 
				<b class='blue'>Brand Name</b>
				<span class='roBrandName'></span>
			</p> 
			<p> 
				<b class='blue' style='line-height:60px;'>Classification</b>
				<span class='roDescription'></span>
			</p>
			<p>
				<b class='blue'>Vendor Name </b>
				<span class='roVendor'></span>
				<input type='hidden' id='vendorId'>
			</p> 
			<p>
				<b class='blue'>Vendor Contact: </b>
				<span class='ContactNo'></span>
			</p> 
			<p> 
				<b class='blue'>Price Per Unit</b>
				<span class='roPricePerUnit priceBox lightgray smallPaddingRight floatLeft'></span>
				<span class='inputInclude gray'>Php</span>
			</p> 
				
			<p class='BigBox'> 
				<b class='blue'>Number of Small Box per Big Box</b>
				<span class='roNumOfSmallBoxPerBigBox quantityBox lightgray smallPaddingRight floatLeft'></span>
				<span class='inputInclude gray'>Small Boxes / Big Box</span>
			</p>			
			<p> 
				<b class='blue'>Number of Unit per Small Box</b>
				<span class='roNumOfUnitPerSmallBox quantityBox lightgray smallPaddingRight floatLeft'></span>
				<span class='inputInclude gray'>Units / Small Box</span>
			</p> 
			<p class='BigBox'> 
				<b class='green'>Number of Big Box</b>
				<input type='number' id='roNumOfBigBox' min="0" class='floatLeft editableQuantityBox grayBorder'>
				<span class='inputInclude gray'>Boxes</span>
			</p>	
			<p class='SmallBox'> 
				<b class='green'>Number of Small Box</b>
				<input type='number' id='roNumOfSmallBox' min="1" class='floatLeft editableQuantityBox grayBorder'>
				<span class='inputInclude gray'>Boxes</span>
			</p>
			<p>
				<b class='blue'>Total Expense</b>
				<span class='roTotalExpense priceBox lightgray smallPaddingRight floatLeft' style='display:none'>0</span>
				<span class='roTotalExpenseShown priceBox lightgray smallPaddingRight floatLeft'>0</span>
				<span class='inputInclude gray'>Php</span>
			</p>
			<p>
				<b class='blue'>Total Units</b>
				<span class='roTotalUnits priceBox lightgray smallPaddingRight floatLeft' style='display:none'>0</span>
				<span class='roTotalUnitsShown priceBox lightgray smallPaddingRight floatLeft'>0</span>
				<span class='inputInclude gray'>Units</span>
			</p>
		
			<button class='nroSubmit orange button'>Order Product</button>
		
			<input type='hidden' id='roNumOfSmallBoxPerBigBox'>
			<input type='hidden' id='roNumOfUnitPerSmallBox'>
		</form>
	</div>
</div>