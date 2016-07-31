<?php 

	include_once('./includes/sessionStarter.php');
	include_once('./includes/_connect.php');
?>

<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
		<div class='content'>
			
			<?php include_once('./includes/submenu.php'); ?>
			
			<?php include_once('./includes/apTimeLogSummary.php'); ?>
			
			<hr class='marginTop'>
			
			<?php include_once('./includes/apActivitySummary.php'); ?>	
			
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>