<?php include_once('./includes/sessionStarter.php') ?>

<html>

	<?php include_once('./includes/bodyUpper.php') ?>
	
		<div class='content reportsContainer'>
			
			<?php include_once('./includes/submenu.php') ?>
				
			<form method='post' class='soiSearchSubmit'>
				<p>
					<b>Search Issuance Date:</b>
					<select id='queryMonth' name='queryMonth' style='padding:5px' class='smallMarginLeft'>
						<option value='0'>Select Month</option>
						<?php 

							include_once('./includes/_connect.php');
							
							$sql = 
								"SELECT DISTINCT LEFT(dispenseId,2) 
								FROM dispensedmedicinetable 
								WHERE 1
								ORDER BY LEFT(dispenseId,2) ASC";
							$result = mysqli_query($connect,$sql);
		
							while($row = mysqli_fetch_array($result)) {
								$dateIssued = $row['LEFT(dispenseId,2)'];
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
						?>
					</select>
					<select id='queryDay' name='queryMonth' style='padding:5px' class='smallMarginLeft'>
						<option value='0'>Select Day</option>
						<?php 

							include_once('./includes/_connect.php');
							
							$sql = 
								"SELECT DISTINCT MID(dispenseId,4,2) 
								FROM dispensedmedicinetable 
								WHERE 1
								ORDER BY MID(dispenseId,4,2) ASC";
							$result = mysqli_query($connect,$sql);
		
							while($row = mysqli_fetch_array($result)) {
								$dateIssued = $row['MID(dispenseId,4,2)'];
							?>
							
							<option value='<?php echo $dateIssued ?>'><?php echo $dateIssued ?></option>
							
							<?php
							}
						?>
					</select>
					<select id='queryYear' name='queryYear' style='padding:5px' class='smallMarginLeft'>
						<option value='0'>Select Year</option>
						<?php 

							include_once('./includes/_connect.php');
							
							$sql = 
								"SELECT DISTINCT MID(dispenseId,7,4) 
								FROM dispensedmedicinetable 
								WHERE 1
								ORDER BY MID(dispenseId,7,4) DESC";
							$result = mysqli_query($connect,$sql);
		
							while($row = mysqli_fetch_array($result)) {
								$dateIssued = $row['MID(dispenseId,7,4)'];
							?>
							
							<option value='<?php echo $dateIssued ?>'><?php echo $dateIssued ?></option>
							
							<?php
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