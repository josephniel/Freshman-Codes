<?php 
	include_once('./includes/sessionStarter.php'); 
	include_once('./includes/_connect.php');
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finalOrder'])){
		if($_POST['finalOrder'] != ''){
			$finalOrder = explode(",",$_POST['finalOrder']);
			//product Id, vendorId, requestedBy, roDateOrdered, roNumOfBigBox, roTotalExpense, roTotalUnits, roNumOfSmallBox. 8 Elements.
			$i=0;
			while($i<count($finalOrder)){
				$productId = $finalOrder[$i]; // product Id
				$vendorId = $finalOrder[$i+1]; // vendor Id
				$requestedBy = $finalOrder[$i+2]; // requested By
				$dateOrdered = $finalOrder[$i+3]; // roDateOrdered
				$numOfBigBox = $finalOrder[$i+4]; // ro Num of Big bix
				$totalExpense = $finalOrder[$i+5]; // ro Total Expense
				$totalUnits = $finalOrder[$i+6]; // ro Total Units
				$numOfSmallBox = $finalOrder[$i+7]; // ro Num of Small Box
				
			date_default_timezone_set("Asia/Manila");
				$t = microtime(true);
				$micro = sprintf("%06d",($t - floor($t)) * 1000000);
				$time = date("h:i:s.".$micro."a");
				
				$sql = 
					"INSERT INTO reordertable (dateOrdered, productId, timeOrdered,vendorId, requestedBy, roNumOfBigBox, roTotalExpense, roTotalUnits, roNumOfSmallBox) 
					VALUES ('" . $dateOrdered . "','" . $productId . "','" . $time . "','" . $vendorId . "','" . $requestedBy . "'," . $numOfBigBox . "," . $totalExpense . "," . $totalUnits . "," . $numOfSmallBox . ");";
				mysqli_query($connect, $sql);
				$i=$i+8;

				/* FOR ACTIVITY LOGS */
				$date2=date("m/d/Y");	
				$dateOrdered2 = $dateOrdered;
				$dateOrdered2[2] = "/";	
				$dateOrdered2[5] = "/";
				$writeStr = "ordered";
				$sql = 
					"INSERT INTO activitytable(activityDate, activityTime, activityType, fullName, userType) 
					VALUES('" . $date2 ."', '" . $time . "', '" . $writeStr . "', '" . $requestedBy . "', '" . $usertype . "')";
				mysqli_query($connect, $sql);

			}
		}else{
			echo 'No ordered products.';
		}
	}
?>
<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
		
		<div class='modal'>
			<div class='innerModal'>
			
				<div class='removeModal'>X</div>
				
				<form class='rdForm'>
					<h1>Re-order Form</h1> 
					<p> 
						<b class='green'>Date Ordered:</b>
						<?php $yearToday = date('Y'); ?>
							<select id='roDateOrderedMonth' class='grayBorder'>
								<?php $i=1; while($i<=12){ ?> 
								<option value='<?php echo $i; ?>'> 
									<?php echo $i; ?> 
								</option> <?php $i++;} ?>
							</select>
							<select id='roDateOrderedDay' class='grayBorder'>
								<?php $i=1; while($i<=31){ ?> 
								<option value='<?php echo $i; ?>'> 
									<?php echo $i; ?> 
								</option> 
								<?php $i++;} ?>
							</select>
							<select id='roDateOrderedYear' class='grayBorder'>
								<?php $i=$yearToday-1; while($i<=$yearToday){ ?>
								<option value='<?php echo $i; ?>'> 
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
					
					<div style='overflow:auto'>	
						<img class='modalProductImage' src='' />
						<p class='noMargin'> 
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
							<b class='blue'>Type</b>
							<span class='roType'></span>
						</p> 
						<p> 
							<b class='blue'>Dose</b>
							<span class='roDosage'></span>
						</p> 
						<p> 
							<b class='blue' style='line-height:60px;'>Classification</b>
							<span class='roDescription'></span>
						</p>
					</div>
					
					<hr>
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
						<input type='number' id='roNumOfBigBox' min=1 class='floatLeft editableQuantityBox grayBorder'>
						<span class='inputInclude gray'>Boxes</span>
					</p>	
					<p class='hidden numberOfBigBoxError errorNotice'>
						<span class='notice red'>Input number of big box</span>
					</p>
					<p class='SmallBox'> 
						<b class='green'>Number of Small Box</b>
						<input type='number' id='roNumOfSmallBox' min=1 class='floatLeft editableQuantityBox grayBorder'>
						<span class='inputInclude gray'>Boxes</span>
					</p>
					<p class='hidden numberOfSmallBoxError errorNotice'>
						<span class='notice red'>Input number of small box</span>
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
					
					<input type='hidden' id='isEdit'>
					
					<button class='roSubmit orange button marginTop' type='button'>Include to Order List</button>
					<button class='roEdit orange button marginTop' type='button'>Edit Order</button>
					
					<div class='hidden' id='rowID'></div>
					<input type='hidden' id='roNumOfSmallBoxPerBigBox'>
					<input type='hidden' id='roNumOfUnitPerSmallBox'>
					
				</form>
			</div>
		</div>
				
		<div class='content'>
			
			<?php include_once('./includes/roSearchFunction.php') ?>
			<?php include_once('./includes/roOrderCart.php') ?>
			
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>