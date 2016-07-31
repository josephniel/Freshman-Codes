<?php include_once('./includes/sessionStarter.php'); 
//EDITED!!!!! tinanggal yung requesting physician
?>

<html>

	<?php include_once('./includes/bodyUpper.php') ?>
		<div class='content'>
		
			<?php include_once('./includes/submenu.php') ?>
			
			<div style='overflow:auto'>
				<a href='dispenseInPatientIssueProduct.php'>
					<button class='button orange floatLeft'>Add Products to Patient Bed</button>	
				</a>
				<form method='post' id='checkOutForm' class='floatLeft noMargin'>
					<input type='button' value='Check-Out Patient' class='checkOut orange button marginLeft'>
				</form>
			</div>
			
			<div class='withLabel'>
			
				<h4 class='marginTop'>Bed Information: </h4>
			
			<?php 
			
					$currentBedNumber = $_SESSION['currentPatient'];
			
					$subTot = [];
				
					$sql = 
						"SELECT * 
						FROM inpatienttable 
						WHERE bedNo = '" . $currentBedNumber . "'";
					$bedQuery = mysqli_query($connect, $sql);
					$bed = mysqli_fetch_array($bedQuery);
					
			?>
				
				<p>
					<b class='yellow'>Patient Name: </b>
					<?php echo $bed['patientFirstName'] . " " . $bed['patientMiddleName'] . " " . $bed['patientLastName'] ?>
				</p>
				<p>
					<b class='yellow'>Bed: </b>
					<?php echo $bed['bedNo'] ?>
				</p>

				<p>
					<b class='yellow'>Check-in Date: </b>
					<?php echo $bed['checkInDate'] ?>
				</p>	
			</div>
				
			<hr>
				
			<p>
				<b>Current Product Bill: </b>
			</p>
				
			<table style='width:100%;line-height:40px;' class='grayBorder marginTop marginBottom'>
			
				<tr style='text-align:left' class='grayBorder yellow'>
					<th style='width:30%;padding:0 10px;'>Generic Name</th>
					<th style='width:30%;padding:0 10px;'>Brand Name</th>
					<th style='width:20%;padding:0 10px;'>Selling price</th>
					<th style='width:7%;padding:0 10px;'>Qtty</th>
					<th style='width:13%;padding:0 10px;'>Subtotal</th>
				<tr>
				
			<?php 
				$sql = 
					"SELECT DISTINCT productId 
					FROM inpatientproducttable 
					WHERE bedNo = '" . $currentBedNumber . "'";
				$bedQuery = mysqli_query($connect, $sql);
					
				while ($bed = mysqli_fetch_array($bedQuery)){
						
					$sql = 
						"SELECT producttable.genericName, producttable.brandName, dynamicproducttable.sellingPrice 
						FROM producttable,dynamicproducttable 
						WHERE producttable.productId = '" . $bed[0] . "' 
						AND dynamicproducttable.productId = '" . $bed[0] . "'";
					$productQuery = mysqli_query($connect, $sql);
					$product = mysqli_fetch_array($productQuery);
						
					$sql =
						"SELECT SUM(quantity) 
						FROM inpatientproducttable
						WHERE inpatientproducttable.productId = '" . $bed[0] . "'";
					$quantityQuery = mysqli_query($connect, $sql);
					$quantity = mysqli_fetch_array($quantityQuery);
					
					$subtotal = number_format((float)$quantity[0] * (float)$product['sellingPrice'] ,2);
					$sellingPrice = number_format($product['sellingPrice'],2);
			?>
				
				<tr class='grayBorder lightyellow'>
					<td style='width:30%;padding:0 10px;'><?php echo $product['genericName'] ?></td>
					<td style='width:30%;padding:0 10px;'><?php echo $product['brandName'] ?></td>
					<td style='width:20%;padding:0 10px;'><?php echo $sellingPrice ?></td>
					<td style='width:7%;padding:0 10px;'><?php echo $quantity[0] ?></td>
					<td style='width:13%;padding:0 10px;'><b>P </b><?php echo $subtotal ?></td>
				</tr>
						
			<?php	
					$subTot[] = $quantity[0] * $product['sellingPrice'];
				}
			?>
				<tr>
					<th colspan='6'>Grand Total: <?php echo number_format(array_sum($subTot),2) ?> Pesos</th>
				</tr>
					
			</table>
			
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	<?php include_once('./includes/ipScript.php') ?>
</html>