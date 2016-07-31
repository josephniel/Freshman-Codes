<?php
	
	$queryValue = "";
	$queryValue = $_POST['query'];
	
	$searchResult = true;
	
	include_once('./_connect.php');
		
	$sql = "SELECT * FROM inpatienttable WHERE bedNo LIKE '%$queryValue%'";
	$value = mysqli_query($connect, $sql);
 
	if ($value === false || mysqli_num_rows($value) == 0){ 
		echo "<div class='noResults'>No results found.</div>";
		$searchResult = false;
	}
	else{
		$queryCount = 0;
		$results = null;
			
		while($row = mysqli_fetch_array($value)){
			$results[$queryCount] = $row;
			$queryCount++;
		}						
	} 
					
	$queryCount = 0;
					
	if($searchResult){
		while($queryCount<sizeof($results)){ 
			$row = $results[$queryCount]; 
			$queryCount++;
			
			echo "<div id='" . $row['bedNo'] . "' class='redirectInPatient row'" .
					" bedNo='" . $row['bedNo'] . "'" . 
					" patientFirstName='" . $row['patientFirstName'] . "'" .
					" patientMiddleName='" . $row['patientMiddleName'] . "'" .
					" patientLastName='" . $row['patientLastName'] . "'" .
					" checkInDate='" . $row['checkInDate'] . "'" .
					" chosen='0'>".
						"<div class='column1 column'>" . $row['bedNo'] . "</div>" .
						"<div class='column5 column'>" . $row['patientFirstName'] . " " . $row['patientMiddleName'] . " " . $row['patientLastName'] . "</div>" .
						"<div class='column4 column'>" . $row['checkInDate'] . "</div>" . 
				"</div>";
		}
	}
				
	include_once('./ipScript.php');

	?>