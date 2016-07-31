<?php

	/*
	* This block of code gets the rows from different tables that fulfill the 
	* requirements of the data input in the receive deliveries search bar.
	*/
	include_once('./includes/_connect.php');

	$sql = 
		"SELECT * FROM producttable, vendorinfotable, vendorordertable, reordertable 
		WHERE producttable.productId = vendorordertable.productId
		AND vendorordertable.vendorId = vendorinfotable.vendorId
		AND reordertable.productId = producttable.productId 
		AND reordertable.isReceived = 0
		ORDER BY reordertable.dateOrdered, reordertable.timeOrdered";
	$value = mysqli_query($connect, $sql);
		

?>

<div class='rdSearchFunction searchFunction'>
	
	<!-- This displays the search results -->
	
	<h4>Ordered Products</h4>
	
	<div class='tableFormat'>
		<div class='row tableHeaderRow move'>
			<div class='column0 column tableHeader'>Date Ordered</div>
			<div class='column1 column tableHeader'>Product Code</div>
			<div class='column2 column tableHeader'>Generic Name</div>
			<div class='column3 column tableHeader'>Brand Name</div>
		</div>
		<div class='horizontalScroll'>
			
			<?php 
				if ($value === false || mysqli_num_rows($value) == 0){ 
				?>
					<div class='noResults'>No Ordered Products</div>
				<?php
				}
				else{
					$queryCount = 0;
					$results = null;
					while($row = mysqli_fetch_array($value)){
							$results[$queryCount] = $row;
							$queryCount++;
					}	
						
					$queryCount = 0;
					while($queryCount<sizeof($results)){
						
						$row = $results[$queryCount];
						$queryCount++;
						
			?>
			<div id='row<?php echo $queryCount ?>' class='deliveries row' 
				productId='<?php echo $row['productId'] ?>' 
				genericName='<?php echo $row['genericName'] ?>' 
				brandName='<?php echo $row['brandName'] ?>' 
				rdType='<?php echo $row['type'] ?>' 
				dosage='<?php echo $row['dosage'] ?>' 
				description='<?php echo $row['classification'] ?>' 
				productImage='<?php echo $row['imageFilename'] ?>'  
				receivedBy='<?php echo $fullname ?>'				
				dateOrdered='<?php echo $row['dateOrdered'] ?>' 
				timeOrdered='<?php echo $row['timeOrdered'] ?>' 
				pricePerUnit='<?php echo $row['pricePerUnit'] ?>' 
				requestedBy='<?php echo $row['requestedBy'] ?>' 
				validatedBy='<?php echo $row['validatedBy'] ?>' 
				
				numOfSmallBox='<?php echo $row['roNumOfSmallBox'] ?>' 
				numOfBigBox='<?php echo $row['roNumOfBigBox'] ?>' 
				rototalExpense='<?php echo $row['roTotalExpense'] ?>' 
				rototalUnits='<?php echo $row['roTotalUnits'] ?>' 
				
				numOfUnitPerSmallBox='<?php echo $row['noOfUnitPerSmallBox'] ?>' 
				numOfSmallBoxPerBigBox='<?php echo $row['noOfSmallBoxPerBigBox'] ?>' 
				vendorName='<?php echo $row['vendorName'] ?>' 
				vendorId='<?php echo $row['vendorId'] ?>' 
				chosen='0'
			>
					<div class='column0 column'><?php echo $row['dateOrdered']?></div>
					<div class='column1 column'><?php echo $row['productId']?></div>
					<div class='column2 column'><?php echo $row['genericName']?></div>
					<div class='column3 column'><?php echo $row['brandName']?></div>
			</div>
			<?php
					}
				}
			 ?>
		
		</div>
		
	</div>
</div>