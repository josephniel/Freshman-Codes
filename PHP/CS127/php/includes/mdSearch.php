<?php

	$queryValue = "";

	$searchCategory = $_POST['searchCategory'];
	$queryValue = $_POST['query'];
	
	$searchResult = true;
	
	include_once('./_connect.php');
					
	$sql = 
		"SELECT * 
		FROM producttable, deliveriestable, dynamicproducttable, vendorinfotable, vendorordertable 
		WHERE producttable.productId = dynamicproducttable.productId
		AND producttable.productId = deliveriestable.productId
		AND deliveriestable.vendorId = vendorinfotable.vendorId 
		AND vendorinfotable.vendorId = vendorordertable.vendorId
		AND vendorordertable.productId = producttable. productId
		AND deliveriestable.dateReceived <> '00-00-0000'
		AND (producttable." . $searchCategory . " LIKE '%" . $queryValue . "%')";
	$value = mysqli_query($connect, $sql);
	
	if ($value === false || mysqli_num_rows($value) == 0){ 
		echo "<div class='noResults'>No results found.</div>";
		$searchResult = false;
	}
	else{
		$queryCount = 1;
		$results = null;
			
		while($row = mysqli_fetch_array($value)){
			$results[$queryCount] = $row;
			$queryCount++;
		}	
		
		$sorted = array();
		
		$sortby = SORT_DESC;
		$columnName = 'dateReceived';
		
		foreach ($results as $key => $column){
			$sorted[$key] = $column[$columnName];				
		}
		array_multisort($sorted, $sortby, $results);	
	} 
					
	$queryCount = 0;
					
	if($searchResult){
		while($queryCount<sizeof($results)){ 
			$row = $results[$queryCount];
			$queryCount++;
		
			echo "<div id='".$row['productId']."' class='updateDeliveries row'".
				" productId='".$row['productId']."'".
				" genericName='".$row['genericName']."'". 
				" brandName='".$row['brandName']."'".
				" type='".$row['type']."'".
				" dosage='".$row['dosage']."'". 
				" classification='".$row['classification']."'". 
				" image='".$row['imageFilename']."'". 
				" receivedBy='".$_POST['fullname']."'".
				" dateReceived='".$row['dateReceived']."'". 
				" dateOrdered='".$row['dateOrdered']."'".
				" lot='".$row['lotNumber']."'".
				" expiryM='".$row['expiryMonth']."'". 
				" expiryY='".$row['expiryYear']."'".
				" price='".$row['pricePerUnit']."'".
				" perBig='".$row['noOfSmallBoxPerBigBox']."'".
				" perSmall='".$row['noOfUnitPerSmallBox']."'".
				" NSBoxes='".$row['rdNumOfSmallBox']."'".
				" NBBoxes='".$row['rdNumOfBigBox']."'".
				" roTotalUnits='".$row['roTotalUnits']."'".
				" QPUnit='".$row['rdTotalUnits']."'". 
				" vendor='".$row['vendorId']."'".
				" vendorName='".$row['vendorName']."'".
				" expense='".$row['rdTotalExpense']."'".
				" received='".$row['receivedBy']."'".
				" requested='".$row['orderedBy']."'".
				" invoice='".$row['salesInvoice']."'". 
				" chosen='0'>".
					"<div class='column0 column'>".$row['dateReceived']."</div>".
					"<div class='column1 column'>".$row['productId']."</div>".
					"<div class='column2 column'>".$row['genericName']."</div>".
					"<div class='column3 column'>".$row['brandName']."</div>".
				"</div>";
	
		}
	}
	
	include_once('./mdModalScript.php');

?>