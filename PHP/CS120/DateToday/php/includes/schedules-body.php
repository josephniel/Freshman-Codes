<?php 
/*
Date Today
The Internet's Most Notorious Dating Site

Authors: 

Joseph Niel Tuazon
	Website: http://josephnieltuazon.tumblr.com
	Email: josephnieltuazon@yahoo.com
Ruahden Dang-Awan
	Email: 
*/

	// Start Session to get preference
	session_start();
	$preference = $_SESSION['welcomeForm']['preference'];
	
	// Load the XML file
	$xml = simplexml_load_file("xml_".$preference.".xml");
	
	if(count($_POST)>0){
		$valid = true;
		
		if($preference=="female"){
			if( isset($_POST['sched2']) && isset($_POST['sched6'])){
				$valid = false;
			}elseif(isset($_POST['sched0']) && isset($_POST['sched9'])){
				$valid = false;
			}elseif(isset($_POST['sched3']) && isset($_POST['sched11'])){
				$valid = false;
			}elseif(isset($_POST['sched8']) && isset($_POST['sched16'])){
				$valid = false;
			}
		}else{
			if( isset($_POST['sched21']) && isset($_POST['sched29'])){
				$valid = false;
			}elseif(isset($_POST['sched24']) && isset($_POST['sched33'])){
				$valid = false;
			}elseif(isset($_POST['sched22']) && isset($_POST['sched30'])){
				$valid = false;
			}elseif(isset($_POST['sched25']) && isset($_POST['sched30'])){
				$valid = false;
			}elseif(isset($_POST['sched23']) && isset($_POST['sched36'])){
				$valid = false;
			}elseif(isset($_POST['sched23']) && isset($_POST['sched37'])){
				$valid = false;
			}
		}
		
		if($valid){
			$_SESSION['welcomeForm']['price'] = $_POST['total-price'];
			$_SESSION['schedules'] = array();
			for($i = 0; $i < 40; $i++){
				$currentKey = "sched" . $i;
				if(isset($_POST[$currentKey])){
					$nodes = $xml->xpath("//sched[@index='" . $i . "']");
					$nodes[0]->attributes()->{"available"} = "0";
					$xml->asXml("xml_".$preference.".xml");
					$_SESSION['schedules'][$currentKey] = $_POST[$currentKey];
				}
			}
			header("Location: ./mail");
			exit;
		}
		else{
			echo "<div data-alert class='alert-box'>There are conflicting schedules. Please fix your schedule.<a href='#' class='close'>&times;</a></div>";
		}
	}
	else{
		echo "<div data-alert class='alert-box'>Please select at least one schedule.<a href='#' class='close'>&times;</a></div>";
	}
	
	function scheduleTable($currentSched){
		
		echo "
			<div class='medium-6 columns'>
				<div class='box'>
					<div class='schedule-header'>
						<img src='" . $currentSched->images->image[0] . "' />
						<span>
							<h2>" . $currentSched->name . "</h2>
							<p>&ldquo;" . $currentSched->description->Quote . "&rdquo;</p>
						</span>
					</div>
					<table>";
						for($i = 0; $i < 4; $i++){
						
							$class = preg_replace("/[\s_]/", "-", $currentSched->scheds->sched[$i]);
		echo "
							<tr ";
								if($currentSched->scheds->sched[$i]->attributes()->{'available'} == 0){
									echo "class='disabled'";
								}
								else{
									echo "class='enabled'";
								}
		echo">
								<td width='25%'>
									<input type='checkbox' id='sched" . $currentSched->scheds->sched[$i]->attributes()->{'index'} . "' class='" . $class . " sched-radio' value='" . $currentSched->price . "' ";
										if($currentSched->scheds->sched[$i]->attributes()->{'available'} == 0){
											echo "disabled";
										}
		echo "/>
								</td>
								<td width='50%'><label for='sched" . $currentSched->scheds->sched[$i]->attributes()->{'index'} . "'>" .
									$currentSched->scheds->sched[$i]
								. "</label></td>
								<td width='25%'>
									P " . $currentSched->price . "
								</td>
							</tr>";
						}
		echo "
					</table>
				</div>
			</div>
		";
	}
	
?>

<div class='row'>
	<h1>Available Schedules</h1>
</div>

<div id='schedules-container'>

	<div class='row'>
		<?php 
		if($_SESSION['dates']['date1'] != "" || $_SESSION['dates']['date1'] != null){ 
			scheduleTable($xml->dateDetails[0]);
		}
		if($_SESSION['dates']['date2'] != "" || $_SESSION['dates']['date2'] != null){ 
			scheduleTable($xml->dateDetails[1]);
		}
		if($_SESSION['dates']['date3'] != "" || $_SESSION['dates']['date3'] != null){ 
			scheduleTable($xml->dateDetails[2]);
		}
		if($_SESSION['dates']['date4'] != "" || $_SESSION['dates']['date4'] != null){ 
			scheduleTable($xml->dateDetails[3]);
		}
		if($_SESSION['dates']['date5'] != "" || $_SESSION['dates']['date5'] != null){ 
			scheduleTable($xml->dateDetails[4]);
		}
		?>
	</div>
	
</div>

<div id='sched-total-price'>
		<div class='row box' data-equalizer>
			<div class='medium-9 columns' style='display:table;' data-equalizer-watch>
				<h2 style='display:table-cell;vertical-align:middle'> Total Price: P <span id='total-price'>0.00</span> </h2>
			</div>
			<form id='schedForm' class='medium-3 columns' method='post' action='./schedules' data-equalizer-watch>
				<input type='hidden' id='total-price-hidden' name='total-price' value='0' />
				<button type='submit' class='button expand'>Next</button>
			</form>
		</div>
</div>
