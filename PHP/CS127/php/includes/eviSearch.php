<?php

	$queryValue = "";

	$searchCategory = $_POST['searchCategory'];
	$sortCategory = $_POST['sortCategory'];
	$queryValue = $_POST['query'];
	
	$searchResult = true;
	
	include_once('./_connect.php');
					
	$sql = "SELECT * FROM vendorinfotable
		WHERE $searchCategory LIKE '%$queryValue%'";
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
						
		if($sortCategory == 'vendorIdaz'){
			$sortby = SORT_ASC;
			$columnName = 'vendorId';
		}else if($sortCategory == 'vendorNameaz'){
			$sortby = SORT_ASC;
			$columnName = 'vendorName';
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
			
			echo "<div id='".$row['vendorId']."' class='editVendorInfo row'".
					" vendorId='".$row['vendorId']."'". 
					" vendorName='".$row['vendorName']."'".
					" contactNo='".$row['contactNo']."'>".
						"<div class='column1 column'>".$row['vendorId']."</div>".
						"<div class='column2 column'>".$row['vendorName']."</div>".
						"<div class='column3 column'>".$row['contactNo']."</div>".
				"</div>";
				
		}
	}
	
	include_once('./eviScript.php');
	
	?>