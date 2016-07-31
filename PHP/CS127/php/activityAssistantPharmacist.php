<?php 
	include_once('./includes/sessionStarter.php');
	include_once('./includes/_connect.php');
?>

<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
		<div class='content'>
			
			<?php
			if($usertype == 'Administrator'){
				include_once('./includes/submenu.php'); 
			}
			
			include_once('./includes/aapTimeLogSummary.php');
			?>
			
			<hr class='marginTop'>
			
			<?php include_once('./includes/aapActivitiesSummary.php'); ?>			
			
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>