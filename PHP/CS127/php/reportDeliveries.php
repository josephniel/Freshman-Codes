<?php include_once('./includes/sessionStarter.php') ?>

<html>

	<?php include_once('./includes/bodyUpper.php') ?>
	
		<div class='content reportsContainer'>
			
			<?php include_once('./includes/submenu.php') ?>
					
			<form method='post' class='drSearchSubmit'>
				<p>
					<b>Search Delivery Date:</b>
					<select id='queryMonth' name='queryMonth' style='padding:5px' class='smallMarginLeft'>
						<option value='0'>Select Month</option>
						<?php 

							include_once('./includes/_connect.php');
							
							$sql = 
								"SELECT DISTINCT LEFT(dateReceived,2) 
								FROM deliveriestable 
								WHERE 1
								ORDER BY LEFT(dateReceived,2) ASC";
							$result = mysqli_query($connect,$sql);
		
							while($row = mysqli_fetch_array($result)) {
								$dateIssued = $row['LEFT(dateReceived,2)'];
								if($dateIssued != '00'){
							?>
							
							<option value='<?php echo $dateIssued ?>'>
							
							<?php 
								
									switch($dateIssued){
										case '1': echo 'January'; break;
										case '2': echo 'February'; break;
										case '3': echo 'March'; break;
										case '4': echo 'April'; break;
										case '5': echo 'May'; break;
										case '6': echo 'June'; break;
										case '7': echo 'July'; break;
										case '8': echo 'August'; break;
										case '9': echo 'September'; break;
										case '10': echo 'October'; break;
										case '11': echo 'November'; break;
										case '12': echo 'December'; break;
									}
								
								?>
							
							</option>
							
							<?php
								}
							}
						?>
					</select>
					<select id='queryDay' name='queryMonth' style='padding:5px' class='smallMarginLeft'>
						<option value='0'>Select Day</option>
						<?php 

							include_once('./includes/_connect.php');
							
							$sql = 
								"SELECT DISTINCT MID(dateReceived,4,2) 
								FROM deliveriestable 
								WHERE 1
								ORDER BY MID(dateReceived,4,2) ASC";
							$result = mysqli_query($connect,$sql);
		
							while($row = mysqli_fetch_array($result)) {
								$dateIssued = $row['MID(dateReceived,4,2)'];
								if($dateIssued != '00'){
							?>
							
							<option value='<?php echo $dateIssued ?>'><?php echo $dateIssued ?></option>
							
							<?php
								}
							}
						?>
					</select>
					<select id='queryYear' name='queryYear' style='padding:5px' class='smallMarginLeft'>
						<option value='0'>Select Year</option>
						<?php 

							include_once('./includes/_connect.php');
							
							$sql = 
								"SELECT DISTINCT MID(dateReceived,7,4) 
								FROM deliveriestable 
								WHERE 1
								ORDER BY MID(dateReceived,7,4) DESC";
							$result = mysqli_query($connect,$sql);
		
							while($row = mysqli_fetch_array($result)) {
								$dateIssued = $row['MID(dateReceived,7,4)'];
								if($dateIssued != '0000'){
							?>
							
							<option value='<?php echo $dateIssued ?>'><?php echo $dateIssued ?></option>
							
							<?php
								}
							}
						?>
					</select>
					<input type='submit' value='Search' class="searchButton orange mediumMarginLeft"> 
				</p>
				
			</form>
					
				
			<hr>
			
				<h4>Notes:</h4>
				<p class='marginLeft'>
					<b>Daily report</b>: Fill all 3 boxes (Month, Day, Year).
				</p>
				<p class='marginLeft'>
					<b>Monthly report</b>: Fill the Month select box and the Year select box.
				</p>
				<p class='marginLeft'>
					<b>Yearly report</b>: Fill the Year select box.
				</p>
			
					
			<iframe class='pdfiframe' src=''></iframe>			
				
		</div>
		
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>