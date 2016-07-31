<?php

	$queryValue = "";

	$searchCategory = $_POST['searchCategory'];
	$sortCategory = $_POST['sortCategory'];
	$queryValue = $_POST['query'];
	
	$searchResult = true;
	
	include_once('./_connect.php');
	
	$sql = "";
	if  ($searchCategory == "productId") {
		$sql = 
			"SELECT vo.vendorId, vo.deliveryTime, vo.pricePerUnit, vo.noOfUnitPerSmallBox, vo.noOfSmallBoxPerBigBox, vi.vendorName, vo.productId, p.genericName, p.brandName, p.dosage, p.type, p.classification, p.imageFilename
			FROM vendorordertable vo, vendorinfotable vi, producttable p 
			WHERE vo.vendorId=vi.vendorId AND vo.productId=p.productId 
			AND vo.productId LIKE '%$queryValue%'";
	}
	else {
		$sql = "SELECT vo.vendorId, vo.deliveryTime, vo.pricePerUnit, vo.noOfUnitPerSmallBox, vo.noOfSmallBoxPerBigBox, vi.vendorName, vo.productId, p.genericName, p.brandName, p.dosage, p.type, p.classification, p.imageFilename
			FROM vendorordertable vo, vendorinfotable vi, producttable p 
			WHERE vo.vendorId=vi.vendorId AND vo.productId=p.productId 
			AND $searchCategory LIKE '%$queryValue%'";
	}
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
						
		if($sortCategory == 'vendorNameaz'){
			$sortby = SORT_ASC;
			$columnName = 'vendorName';
		}else if($sortCategory == 'genericNameaz'){
			$sortby = SORT_ASC;
			$columnName = 'genericName';
		}else if($sortCategory == 'brandNameaz'){
			$sortby = SORT_ASC;
			$columnName = 'brandName';
		}
			
		$sorted = array();
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
			$tempRowPricePerUnit = explode(".",$row['pricePerUnit']);
			echo "<div id='".$row['vendorId']."' class='editVendorProduct row'".
					" vendorId='".$row['vendorId']."'". 
					" vendorName='".$row['vendorName']."'".
					" productId='".$row['productId']."'".
					" genericName='".$row['genericName']."'". 
					" brandName='".$row['brandName']."'".
					" type='".$row['type']."'".
					" dosage='".$row['dosage']."'".
					" classification='".$row['classification']."'".
					" image='".$row['imageFilename']."'".
					" deliveryTime='".$row['deliveryTime']."'". 
					" smallPerBig='".$row['noOfSmallBoxPerBigBox']."'". 
					" unitPerSmall='".$row['noOfUnitPerSmallBox']."'". 
					" pricePerUnit='".$tempRowPricePerUnit[0]."'". 
					" pricePerUnitCent='".end($tempRowPricePerUnit)."'>". 
						"<div class='column1 column'>".$row['vendorName']."</div>".
						"<div class='column2 column'>".$row['genericName']."</div>".
						"<div class='column3 column'>".$row['brandName']."</div>".
				"</div>";
		}
	}
	
	include_once('./evpScript.php');
	
	?>