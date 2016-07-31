<?php
	$html = "<h4>Time-in / Time-Out Log</h4>";

	include_once('./includes/_connect.php');
	
	$result = mysqli_query($connect,"SELECT * FROM timetable WHERE usertype='Assistant Pharmacist'");;
		
	$html .= "<div class='timeIn defaultTable'>
		<div class='row tableHeaderRow'>
			<div class='column1 column'>Full Name</div>
			<div class='column2 column'>Time-In</div>
			<div class='column3 column'>Time-Out</div>
			<div class='column4 column'>Time Spent</div>
		</div>";
		
	function computeTimeSpent($date, $timein, $timeout){
		$q = new DateTime($date . " " . $timein);
		$w = new DateTime($date . " " . $timein);
		if(strcmp($timeout, "00:00:00am") > 0){
			$w = new DateTime($date . " " . $timeout);
		}
		$string = "";
		if($timeout != ""){
			$result = $w->diff($q);
			if ($result->h > 0){
				if($result->h == 1)
					$string .= $result->h.' hour, ';
				else
					$string .= $result->h.' hours, ';
			}
			if ($result->i > 0){
				if($result->i == 1)
					$string .= $result->i.' minute ';
				else
					$string .= $result->i.' minutes ';
			}
			if ($result->s > 0 && $result->h <=0) {
				if($result->s == 1)
					$string .= $result->s.' second ';
				else
					$string .= $result->s.' seconds ';
			}
		}
		return $string;
	}

	$count = mysqli_num_rows($result);
	$htmlArray = array($count);
	$i=0;

	while(($row = mysqli_fetch_array($result)) && ($i<$count)) {
		$htmlArray[$i] = "<div class='row'>";
		$htmlArray[$i] .= "<div class='column1 column'>" . $row['fullName'] . "</div>";
		$htmlArray[$i] .= "<div class='column2 column'>" . $row['timeIn'] . "</div>";
		$htmlArray[$i] .= "<div class='column3 column'>" . $row['timeOut'] . "</div>";
		$timeSpent = computeTimeSpent($row['date'], $row['timeIn'], $row['timeOut']);
		$htmlArray[$i] .= "<div class='column4 column'>" . $timeSpent . "</div>";
		$htmlArray[$i] .= "</div>";
		$i++;
	}

	if($count>=5){
		for($i=0; $i<5; $i++){
			$html .= $htmlArray[$count-1-$i];
		}
	}
	else {
		for($i=0; $i<$count; $i++){
			$html .= $htmlArray[$count-1-$i];
		}
	}

	function displayMore($html, $count, $htmlArray){
		if($count>5)
		for($i=5; $i<$count; $i++){
			$html .= $htmlArray[$count-1-$i];
		}
	}	

	$html .= "</div><a href='activityAssistantPharmacistTimeLog.php'>
		<button type='button' class='orange button'>View All</button></a>";

	echo $html;

?>

