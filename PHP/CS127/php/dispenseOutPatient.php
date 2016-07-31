<?php 

	include_once('./includes/sessionStarter.php');
	include_once('./includes/_connect.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$dispensedProducts = array();
		$dispensedProductQuantity = array();
		$x = $y = $z = 0;
		
		foreach($_POST as $products){
			if($x % 2 == 0 && $products != ' '){
				$_SESSION['dispensedProducts']['productQuantity'][$y] = $products;
				$y++;
			}
			else{
				$_SESSION['dispensedProducts']['productNames'][$z] = $products;
				$z++;
			}
			$x++;
		}
		header('Location: dispenseOutPatientFinal.php');
		
	}

 ?>

<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
		<div class='content'>
			
			<?php include_once('./includes/submenu.php'); ?>
			<?php include_once('./includes/opSearchFunction.php') ?>
			<?php include_once('./includes/opDispenseCart.php') ?>
					
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>