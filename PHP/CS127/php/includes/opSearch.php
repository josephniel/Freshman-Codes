<?php
	
	$queryValue = "";

	$searchCategory = $_POST['searchCategory'];
	$sortCategory = $_POST['sortCategory'];
	$queryValue = $_POST['query'];
	
	$searchResult = true;
	
	include_once('./_connect.php');
		
	$sql = "UPDATE dynamicproducttable SET totalQuantity = (select sum(rdTotalUnits) from deliveriestable where deliveriestable.productId = dynamicproducttable.productId)";
	mysqli_query($connect, $sql);
	
	if($searchCategory == 'productId'){
		$sql = 
			"SELECT * 
			FROM producttable, dynamicproducttable, vendorordertable
			WHERE producttable.productId = dynamicproducttable.productId 
			AND producttable.productId = vendorordertable.productId
			AND dynamicproducttable.totalQuantity <> 0 
			AND dynamicproducttable.sellingPrice <> 0
			AND vendorordertable.pricePerUnit <> 0
			AND (producttable.productId LIKE '%$queryValue%')";
	} else{
		$sql = 
			"SELECT * 
			FROM producttable, dynamicproducttable, vendorordertable
			WHERE producttable.productId = dynamicproducttable.productId 
			AND producttable.productId = vendorordertable.productId
			AND dynamicproducttable.totalQuantity <> 0 
			AND dynamicproducttable.sellingPrice <> 0
			AND vendorordertable.pricePerUnit <> 0
			AND ($searchCategory LIKE '%$queryValue%')";
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
						
		if($sortCategory == 'productIdaz'){
			$sortby = SORT_ASC;
			$columnName = 'productId';
		}else if($sortCategory == 'genericNameaz'){
			$sortby = SORT_ASC;
			$columnName = 'genericName';
		}else if($sortCategory == 'brandNameaz'){
			$sortby = SORT_ASC;
			$columnName = 'brandName';
		}else if($sortCategory == 'productIdza'){
			$sortby = SORT_DESC;
			$columnName = 'productId';
		}else if($sortCategory == 'genericNameza'){
			$sortby = SORT_DESC;
			$columnName = 'genericName';
		}else if($sortCategory == 'brandNameza'){
			$sortby = SORT_DESC;
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
			
			echo "<div id='".$row['productId']."' class='add row'".
					" productId='".$row['productId']."'". 
					" genericName='".$row['genericName']."'".
					" brandName='".$row['brandName']."'".
					" quantity='".$row['totalQuantity']."'".
					" chosen='0'>".
						"<div class='column2 column'>".$row['genericName']."</div>".
						"<div class='column3 column'>".$row['brandName']."</div>".
						"<div class='column4 column'>".$row['totalQuantity']."</div>". 
						"<div class='column1 column'> <b>₱ </b>".$row['sellingPrice']."</div>".
				"</div>";
						
		}
	}
				
	include_once('./opScript.php');

	?>