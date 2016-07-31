<?php

	$urlString = $_SERVER['PHP_SELF'];
	$urlString = substr($urlString,32);

	$rowClass = "";
	if($urlString == 'receiveDeliveries.php' || $urlString == 'orderProducts.php'){
		$rowClass = 'deliveries';
	}
	elseif($urlString == 'purchase.php'){
		$rowClass = 'add';
	}
	
	$startSearch = false;
	$queryValue = "";

	if($startSearch == false){
		$value = false;
		$results = false;
	}
	
	if(isset($_POST['searchCategory']) && isset($_POST['sortCategory']) && isset($_POST['query'])) {
		$searchCategory = $_POST['searchCategory'];
		$sortCategory = $_POST['sortCategory'];
		$queryValue = $_POST['query'];
		$startSearch = true;
	}
	
	if($startSearch){

		include_once('./includes/_connect.php');

		$sql = "SELECT * FROM producttable WHERE $searchCategory LIKE '%$queryValue%'";
		$value = mysqli_query($connect, $sql);
	}

?>

<div class='searchFunction'>
	<form method='post'>
		<p><span>Search:</span><input type='text' name="query" placeholder='Input search query here' class='searchBar' value='<?php echo $queryValue ?>'></p>
		<p><div class='fixedWidth'>Search by</div>
			<select name="searchCategory" class='searchCategory floatLeft'>
				<option value='productId'
				<?php if($startSearch){ if($searchCategory == 'productId'){ echo 'selected'; }} ?>
				>Product Code</option>
				<option value='genericName'
				<?php if($startSearch){ if($searchCategory == 'genericName'){ echo 'selected'; }}else{ echo 'selected'; } ?>
				>Generic Name</option>
				<option value='brandName'
				<?php if($startSearch){ if($searchCategory == 'brandName'){ echo 'selected'; }} ?>
				>Brand Name</option>
			</select>
			<div class='fixedWidth'>Sort by</div>
			<select name="sortCategory" class="searchCategory floatLeft">
				<option value='productIdaz'
				<?php if($startSearch){ if($sortCategory == 'productIdaz'){ echo 'selected'; }} ?>
				>Product Code (A-Z)</option>
				<option value='genericNameaz'
				<?php if($startSearch){ if($sortCategory == 'genericNameaz'){ echo 'selected'; }} ?>
				>Generic Name (A-Z)</option>
				<option value='brandNameaz'
				<?php if($startSearch){ if($sortCategory == 'brandNameaz'){ echo 'selected'; }} ?>
				>Brand Name (A-Z)</option>
				<option value='productIdza'
				<?php if($startSearch){ if($sortCategory == 'productIdza'){ echo 'selected'; }} ?>
				>Product Code (Z-A)</option>
				<option value='genericNameza'
				<?php if($startSearch){ if($sortCategory == 'genericNameza'){ echo 'selected'; }} ?>
				>Generic Name (Z-A)</option>
				<option value='brandNameza'
				<?php if($startSearch){ if($sortCategory == 'brandNameza'){ echo 'selected'; }} ?>
				>Brand Name (Z-A)</option>
			</select>
			<input type='submit' value='Search' class="searchButton">
		</p>
	</form>
	
	<div class='tableFormat'>
		<div class='row tableHeaderRow move'>
			<div class='column1 column tableHeader'>Product Code</div>
			<div class='column2 column tableHeader'>Generic Name</div>
			<div class='column3 column tableHeader'>Brand Name</div>
			<div class='column4 column tableHeader'>Description</div>
		</div>
		<div class='horizontalScroll'>
			
			<?php 
			if($startSearch){
				if ($value === false || mysqli_num_rows($value) == 0){ 
				?>
					<div class='noResults'>No results found.</div>
				<?php
				}
				else{
					$queryCount = 1;
					$results = null;
					if($startSearch){
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
							foreach ($results as $key => $column)
							{
								$sorted[$key] = $column[$columnName];
							}
							array_multisort($sorted, $sortby, $results);
						
					} 
					
					$queryCount = 0;
					while($queryCount<sizeof($results)){ //edited
						$row = $results[$queryCount]; //edited
						$queryCount++;
			?>
			<div id='<?php echo $row['productId'] ?>' class='<?php echo $rowClass ?> row'>
					<div id='column1row<?php echo $queryCount ?>' class='column1 column'><?php echo $row['productId']?></div>
					<div id='column2row<?php echo $queryCount ?>' class='column2 column'><?php echo $row['genericName']?></div>
					<div id='column3row<?php echo $queryCount ?>' class='column3 column'><?php echo $row['brandName']?></div>
					<div id='column4row<?php echo $queryCount ?>' class='column4 column'></div>
			</div>
			<?php
					}
				}
			 }
			 ?>
		
		</div>
		
	</div>
</div>