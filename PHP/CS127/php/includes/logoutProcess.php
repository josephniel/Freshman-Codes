<?php
	/* STARTS SESSION */
		session_start(); 
		
	/* SETS LOGOUT TIME FOR USER */
		include_once('./_connect.php');
	
		date_default_timezone_set("Asia/Manila");
		$timeOut = date("h:i:sa");
		
		$fullname = $_SESSION['fullname'];
		$timeIn = $_SESSION['timeIn'];
		
		$sql = 
			"UPDATE timetable 
			SET timeOut='" . $timeOut . "' 
			WHERE fullName='" . $fullname .  "' 
			AND timeIn='" . $timeIn . "'";
		
		mysqli_query($connect, $sql);
		mysqli_close($connect);
	
	/* CLEARS SESSION AFTER LOGGING OUT */
		session_unset(); 
		session_destroy();
	
	/* REDIRECTS BACK TO HOME */
		header('Location: ../../index.php');