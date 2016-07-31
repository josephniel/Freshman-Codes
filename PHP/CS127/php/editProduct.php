<?php 
	include_once('./includes/sessionStarter.php');
	include_once('./includes/_connect.php');

	if(isset($_Session['searchCategory'])){
		$searchCategory = $_SESSION['searchCategory'];
	}
	if(isset($_Session['query'])){
		$queryValue = $_SESSION['query'];
	}
	if(isset($_Session['sortCategory'])){
		$sortCategory = $_SESSION['sortCategory'];
	}
	if(isset($_Session['startSearch'])){
		$startSearch = $_SESSION['startSearch'];
	}
	if(isset($_Session['value'])){
		$value = $_SESSION['value'];
	}
	
	if(isset($_POST['updateProductId'])){
		//error check kung may kapareho sa product table yung product Id
		$maykaparehas = true;
		$updateProductId = $_POST['updateProductId'];
		$prevProductId = $_POST['PREVupdateProductId'];
		$sellingPrice = $_POST['updateSellPrice'].".".$_POST['updateSellPriceDecimal'];
		
		if($updateProductId != $prevProductId){
			while($maykaparehas){
				$sql = "SELECT productId FROM producttable WHERE productId='".$updateProductId."'";
				$value = mysqli_query($connect, $sql);
				$maykaparehas = false;
					
				$row = mysqli_fetch_array($value);
				if($row['productId']==$updateProductId){
					$maykaparehas = true;
					$updateProductIdNum = substr($updateProductId, 6, 1);
					$updateProductIdNum++;
					$updateProductId = substr($updateProductId, 0, 6).$updateProductIdNum;	
				}
			}
		}
		//product ID update
			$sql=
			"UPDATE producttable,dynamicproducttable
			SET producttable.productId='".$updateProductId."',dynamicproducttable.productId='".$updateProductId."' 
			WHERE producttable.productId='".$_POST['PREVupdateProductId']."' AND dynamicproducttable.productId='".$_POST['PREVupdateProductId']."'";				
			mysqli_query($connect, $sql);
				
		// consumptiontable
			$sql= "UPDATE consumptiontable SET productId='".$updateProductId."'	WHERE productId='".$_POST['PREVupdateProductId']."'";		
			mysqli_query($connect, $sql);
		// deliveriestable	
			$sql= "UPDATE deliveriestable SET productId='".$updateProductId."' WHERE productId='".$_POST['PREVupdateProductId']."'";		
			mysqli_query($connect, $sql);
		// dispensedmedicinetable		
			$sql= "UPDATE dispensedmedicinetable SET productId='".$updateProductId."' WHERE productId='".$_POST['PREVupdateProductId']."'";	
			mysqli_query($connect, $sql);
		// inpatientordertable	
			$sql= "UPDATE inpatientordertable SET productId='".$updateProductId."'	WHERE productId='".$_POST['PREVupdateProductId']."'";	
			mysqli_query($connect, $sql);
		// reordertable	
			$sql= "UPDATE reordertable SET productId='".$updateProductId."'	WHERE productId='".$_POST['PREVupdateProductId']."'";		
			mysqli_query($connect, $sql);
		// vendorordertable	
			$sql= "UPDATE vendorordertable SET productId='".$updateProductId."'	WHERE productId='".$_POST['PREVupdateProductId']."'";		
			mysqli_query($connect, $sql);
			
		//generic Name
			$sql="UPDATE producttable SET producttable.genericName='".$_POST['updateGenericName']."' WHERE producttable.genericName='".$_POST['PREVupdateGenericName']."' AND producttable.productId='".$updateProductId."'";
			mysqli_query($connect, $sql);
		//brand Name
			$sql="UPDATE producttable SET producttable.brandName='".$_POST['updateBrandName']."' WHERE producttable.brandName='".$_POST['PREVupdateBrandName']."' AND producttable.productId='".$updateProductId."'";
			mysqli_query($connect, $sql);
		//Type
			$sql="UPDATE producttable SET producttable.type='".$_POST['updateType']."' WHERE producttable.type='".$_POST['PREVupdateType']."' AND producttable.productId='".$updateProductId."'";
			mysqli_query($connect, $sql);
		//Dosage
			$sql="UPDATE producttable SET producttable.dosage='".$_POST['updateDosage']."' WHERE producttable.dosage='".$_POST['PREVupdateDosage']."' AND producttable.productId='".$updateProductId."'";
			mysqli_query($connect, $sql);
		//Selling price
			$sql="UPDATE dynamicproducttable SET dynamicproducttable.sellingPrice='".$sellingPrice."' WHERE dynamicproducttable.sellingPrice='".$_POST['PREVupdateSellPrice']."' AND dynamicproducttable.productId='".$updateProductId."'";
			mysqli_query($connect, $sql);
		
		echo "<div class='green notice centerNotice smallMarginBottom smallMarginTop'>".$updateProductId." (previously ".$prevProductId.") has been updated.</div>";
		
		//image
			if(isset($_FILES["updateImage"]["name"])){
				$target_dir = "../images/productImages/";
				$temp = explode(".",$_FILES["updateImage"]["name"]);
				
				if (!end($temp) == "") {
					$filename = $updateProductId . '.' . end($temp);
					$filepath = $target_dir . $filename;
					$info = getimagesize($_FILES['updateImage']['tmp_name']);
					if ($_FILES['updateImage']['error'] !== UPLOAD_ERR_OK) 
					   echo "<div class='red notice centerNotice smallMarginBottom smallMarginTop'>Upload failed with error code " . $_FILES['file']['error'] . "</div>";
					if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG))
					   echo "<div class='red notice centerNotice smallMarginBottom smallMarginTop'>Image is not a gif/png/jpg</div>";
					else {
						move_uploaded_file($_FILES["updateImage"]["tmp_name"], $filepath);
						echo "<div class='green notice centerNotice smallMarginBottom smallMarginTop'>The file " . $filename . " has been uploaded</div>";
						$setImage = "UPDATE producttable SET producttable.imageFilename='" . $filename . "' WHERE producttable.productId='".$updateProductId."'";
						mysqli_query($connect,$setImage);
					}
				}
			}
		// -earl-
		//classification
			
			$sql="UPDATE producttable SET producttable.classification='".htmlspecialchars_decode($_POST['hiddenUpdateClassification']).": ".htmlspecialchars_decode($_POST['hiddenUpdateSubClassification'])."' WHERE producttable.productId='".$updateProductId."'";
			mysqli_query($connect, $sql);
	}
	?>

<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
	
			<div class='modal'>
			<div class='innerModal'>
			
				<div class='removeModal'>X</div>
				
				<form class='updateForm' name='updateForm' method='POST' enctype='multipart/form-data' action=''>
					<h1>Update Product Information</h1> 

					<p> 
						<b class='orange'>Product Id</b>
						<input type='textbox' name='updateProductId' id='updateProductId' style='border: none;' readonly>
						<input type='hidden' name='PREVupdateProductId' id='PREVupdateProductId'>
					</p> 
					<p> 
						<b class='blue'>Generic Name</b>
						<input type='textbox' name='updateGenericName' id='updateGenericName' class='grayBorder'>
						<input type='hidden' name='PREVupdateGenericName' id='PREVupdateGenericName'>
					</p> 
					<p> 
						<b class='blue'>Brand Name</b>
						<input type='textbox' name='updateBrandName' id='updateBrandName' class='grayBorder'>
						<input type='hidden' name='PREVupdateBrandName' id='PREVupdateBrandName'>
					</p> 
					<p>
						<b class='blue'>Type</b>
						<select name='updateType' id='updateType' class='grayBorder'>
							<?php							 
								$value = mysqli_query($connect, "SELECT DISTINCT type FROM `producttable` ORDER BY type");		
								while($row = mysqli_fetch_array($value)) {
									$medForm = $row['type'];
									if($medForm != NULL || $medForm != ""){ 
							?>		
								<option value='<?php echo $medForm ?>'><?php echo ucfirst($medForm) ?></option>
							<?php 
									}
								}				
							?>
							<option value='' selected> Others </option>
						</select>
						<input type='hidden' name='PREVupdateType' id='PREVupdateType'>
					</p>
					<p>
						<b class='blue'>Dosage</b>
						<input type='textbox' name='updateDosage' id='updateDosage' class='grayBorder'>
						<input type='hidden' name='PREVupdateDosage' id='PREVupdateDosage'>
					</p>
					<p>
						<b class='blue'>Selling price</b>
						<span class='inputInclude gray'>Php</span>
						<input type='number' name='updateSellPrice' id='updateSellPrice' class='grayBorder' >
						<input type='number' name='updateSellPriceDecimal' id='updateSellPriceDecimal' class='grayBorder'>
						<input type='hidden' name='PREVupdateSellPrice' id='PREVupdateSellPrice'>
					</p> 
					<p>
						<img src='' class='productImage' alt='product image'>
						<b class='blue productImageB'>Product Image</b>
						<br>
						<input type='file' name='updateImage' id='updateImage'>
					</p>
					<p>
						<b class='blue'>Classification</b>
						
						<select name='updateClassification' id='updateClassification' class='grayBorder'>
							<option value="A"> Gastrointestinal & Hepatobiliary System </option>
							<option value="B"> Cardiovascular & Hematopoietic System </option>
							<option value="C"> Respiratory System </option>
							<option value="D"> Central Nervous System </option>
							<option value="E"> Musculo-Skeletal System </option>
							<option value="F"> Hormones </option>
							<option value="G"> Contraceptive Agents </option>
							<option value="H"> Anti-Infectives (Systemic) </option>
							<option value="I"> Oncology </option>
							<option value="J"> Genito-Urinary System </option>
							<option value="K"> Endocrine & Metabolic System </option>
							<option value="L"> Vitamins & Minerals </option>
							<option value="M"> Nutrition </option>
							<option value="N"> Eye </option>
							<option value="O"> Ear & Mouth / Throat </option>
							<option value="P"> Dermatologicals </option>
							<option value="Q"> Anaesthetics - Local & General </option>
							<option value="R"> Allergy & Immune System </option>
							<option value="S"> Antidotes, Detoxifying Agents & Drugs Used in Substance Dependence </option>
							<option value="T"> Intravenous & Other Sterile Solutions </option>
							<option value="U"> Miscellaneous </option>
							<option value="V"> Supplies </option>
						</select>
						<input type='hidden' name='hiddenUpdateClassification' id='hiddenUpdateClassification'>
						<input type='hidden' name='PREVupdateClassification' id='PREVupdateClassification'>
					</p> 
					
					<p>
						<b class='blue'>Sub-Classification</b>
						
						<select name='updateSubClassification' id='updateSubClassification' class='grayBorder'>
							<option>No Entry</option>
						</select>
						<input type='hidden' name='hiddenUpdateSubClassification' id='hiddenUpdateSubClassification'>
						<input type='hidden' name='PREVupdateSubClassification' id='PREVupdateSubClassification'>
					</p> 
					
					<button type='button' class='updateSubmit orange button'>Submit</button>
					<div class='hidden' id='rowID'></div>
				</form>
			</div>
		</div>
	
		<div class='content'>
			
			<?php include_once('./includes/submenu.php'); ?>

			<?php include_once('./includes/epSearchFunction.php'); ?>
			
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>