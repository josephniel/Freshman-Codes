<?php 

	$queryValue = '';
	
	$searchCategory = $_POST['searchCategory'];
	$sortCategory = $_POST['sortCategory'];
	$queryValue = $_POST['query'];
	$productList = explode(',',$_POST['productList']);

	$searchResult = true;
	
	include_once('./_connect.php');
		
	$sql = "SELECT * 
	FROM producttable, vendorinfotable, vendorordertable 
	WHERE vendorordertable.productId = producttable.productId 
	AND vendorordertable.vendorId = vendorinfotable.vendorId 
	AND vendorordertable.noOfUnitPerSmallBox <> 'NULL'";
	
	$i = 0;
	while($i<count($productList)){
		$sql .= " AND producttable.productId <> '" . $productList[$i] . "'";
		$i++;
	}
	
	$sql .= "AND producttable.$searchCategory LIKE '%$queryValue%'";
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
		while($queryCount<sizeof($results)){ //edited
			
			$row = $results[$queryCount]; //edited
			$queryCount++;
			
			$sql = "SELECT productId, isReceived FROM reordertable WHERE 1";
			$donotshow = mysqli_query($connect, $sql);
			
			$indicator = true;
			while($row2 = mysqli_fetch_array($donotshow)){
				if($row2['productId'] == $row['productId'] && $row2['isReceived'] == 0){
					$indicator = false;
					if($queryCount < 1){
						echo "<div class='noResults'>No results found.</div>";
					}
				}
			}
			
			if($indicator){
				echo "<div id='a" .$row['productId']. "'>" .  
					"<div id='".$row['productId']."' class='reorder row'".
					" productId='".$row['productId']."'". 
					" genericName='".$row['genericName']."'".
					" brandName='".$row['brandName']."'".
					" type='".$row['type']."'".
					" dosage='".$row['dosage']."'".
					" description='".$row['classification']."'".
					" image='".$row['imageFilename']."'".
					" requestedBy='".$_POST['fullname']."'".			
					" vendorId='".$row['vendorId']."'". 
					" contactNo='".$row['contactNo']."'". 
					" pricePerUnit='".$row['pricePerUnit']."'". 
					" numOfUnitPerSmallBox='".$row['noOfUnitPerSmallBox']."'".
					" numOfSmallBoxPerBigBox='".$row['noOfSmallBoxPerBigBox']."'".
					" vendorName='".$row['vendorName']."'".
					" chosen='0'>".
					"<div class='column1 column'>".$row['productId']."</div>".
					"<div class='column2 column'>".$row['genericName']."</div>".
					"<div class='column3 column'>".$row['brandName']."</div>".
				"</div></div>";
			}
		}
	}
	
	?>