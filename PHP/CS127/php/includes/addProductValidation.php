<?php 
	include_once('sessionStarter.php');
	include_once('_connect.php');	
	
	$isValidatedProduct = true;
	$isValidatedVendor = true;
	$sameProduct = false;
	$sameVendor = false;

	$productId = $genericName = $brandName = $dosage = $type = $class = $classification = $subclass = $subclassification = $vendorName = $new_vendorName = $contactNo = $deliveryTime = $smallPerBig = $unitPerSmall = $vendorPrice = $origCents = $cents = $sellingPrice = $origCent = $cent = "";
	
	$inputProductId = "**-***1";

	$isPosted = false;
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$isPosted = true;
	}
	
	if($isPosted){
	
		/* INITIALIZING VALUES */
		$classification =  mysqli_real_escape_string($connect, $_POST['hiddenClassification']);
			$class = mysqli_real_escape_string($connect, $_POST['class']); 
		$subclassification =  mysqli_real_escape_string($connect, $_POST['hiddenSubClassification']);
			$subclass = mysqli_real_escape_string($connect, $_POST['subclass']); 
		$productClassification = 
			htmlspecialchars_decode($classification) . ": " . htmlspecialchars_decode($subclassification);
		
		// producttable
		$inputProductId = mysqli_real_escape_string($connect, $_POST['inputProductId']);
			$substr_temp_id = substr($inputProductId,0,6);
		$genericName = mysqli_real_escape_string($connect, $_POST['genericname']);
		$brandName = mysqli_real_escape_string($connect, $_POST['brandname']);
		$dosage = mysqli_real_escape_string($connect, $_POST['dose']);
		$type = mysqli_real_escape_string($connect, $_POST['form']);
		
		$genericName = trim($genericName);
		$brandName = trim($brandName);
		$dosage = trim($dosage);
		
		// dynamicproducttable
		$unitPerSmall = mysqli_real_escape_string($connect, $_POST['unitpersmall']);
			if($unitPerSmall == ""){ $unitPerSmall = 1; }
		$smallPerBig = mysqli_real_escape_string($connect, $_POST['smallperbig']);
			if($smallPerBig == ""){ $smallPerBig = 1; }
		$totalquantity = $unitPerSmall * $smallPerBig;
		$sellingPrice = mysqli_real_escape_string($connect, $_POST['sellingprice']);
		$origCent = mysqli_real_escape_string($connect, $_POST['cent']);
			if($origCent == ""){ $cent = 0; }
			else { $cent = $origCent; }
			$cent = $cent / 100;
		$sellingPriceTotal = $sellingPrice + $cent;
				
		// vendorinfotable
		$vendorName = mysqli_real_escape_string($connect, $_POST['vendorname']);
		$new_lc_vendorName = mysqli_real_escape_string($connect, $_POST['newVendorName']);
		$new_vendorName = strtoupper(mysqli_real_escape_string($connect, $_POST['newVendorName']));
		$contactNo = mysqli_real_escape_string($connect, $_POST['newVendorContact']);
		
		// vendorordertable
		$vendorPrice = mysqli_real_escape_string($connect, $_POST['vendorprice']);
		$origCents = mysqli_real_escape_string($connect, $_POST['cents']);
			if($origCents == ""){ $cents = 0; }
			else{ $cents = $origCents; }
			$cents = $cents/100;
		$pricePerUnit = $vendorPrice + $cents;
		
		$deliveryTime = mysqli_real_escape_string($connect, $_POST['deliverytime']);
			if($deliveryTime == ""){ $deliveryTime = 7; } 
			
			
		/* CHANGE THIS SIMILAR TO THAT OF SIGN-UP { */
		if ($genericName == "" || $brandName == "" || $dosage == "" || $type == "" || $class == "" || $classification == "" || $subclass == "" || $subclassification == ""
			|| $pricePerUnit == 0 || $sellingPrice == 0 || (($vendorName == "" || $vendorName == "addNewVendor") && ($new_vendorName == "" || $contactNo == ""))) {
			$isValidatedProduct = false;
			$isValidatedVendor = false;
		}
		/* } */
		
		// checks if product already exists
		$selectProducts = 
			"SELECT genericName, brandName, classification, dosage, type 
			FROM producttable 
			WHERE brandName='$brandName'";
		$resultProducts = mysqli_query($connect, $selectProducts);
		
		while($row = mysqli_fetch_array($resultProducts)) {
						
			if(
			$row['genericName'] == $genericName && 
			$row['brandName'] == $brandName && 
			$row['classification'] == $productClassification && 
			$row['dosage'] == $dosage && 
			$row['type'] == $type){
				$isValidatedProduct = false;
				$isValidatedVendor = false;
				$sameProduct = true;
				break;
			}
			
		}
		
		// checks if vendor already exists
		if($new_vendorName != ""){
		
			$selectVendors = "SELECT COUNT(*) FROM vendorinfotable WHERE vendorName LIKE '$new_lc_vendorName'";
			$resultVendors = mysqli_query($connect, $selectVendors);
			$row = mysqli_fetch_array($resultVendors);
			
			//echo $row['COUNT(*)'];

			if($row['COUNT(*)'] == 1){
				$isValidatedProduct = false;
				$isValidatedVendor = false;
				$sameVendor = true;
			}
		}
		
		if ($isValidatedProduct) {
			
			/* GENERATES PRODUCT ID */
			
			$maykaparehas = true;
			$updateProductId = $inputProductId;
			
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

			$productId = $updateProductId ;
			
			/* GENERATES VENDOR ID */
			if($vendorName == "addNewVendor"){ // if new vendor
				$substr_newvendor = substr($new_vendorName,0,4);
				$sameVendorName = 
					"SELECT vendorId FROM vendorinfotable WHERE vendorId LIKE '$substr_newvendor%' ";
				if($result = mysqli_query($connect,$sameVendorName)){ $rowcount = mysqli_num_rows($result); }
				else{ $rowcount = 1; }
				$rowcount += 1;
				if($rowcount < 10){
					$rowcount2_str = strval($rowcount + 1);
					$rowcount2_str = "0".$rowcount2_str;
				}
				$substr_newvendor =  $substr_newvendor . $rowcount2_str;
				$vendorId = strtoupper($substr_newvendor);
			} else { // if vendor exists
				$search_existing_vendor = mysqli_query($connect,"SELECT vendorId FROM vendorinfotable WHERE vendorName = '$vendorName' ");
				$row4 = mysqli_fetch_array($search_existing_vendor);
				$vendorId = $row4['vendorId'];
				$isValidatedVendor = false;
			}
		
		/* INSERTS DATA INTO RESPECTIVE TABLES */
			// producttable
			$toProducttable = 
				"INSERT INTO producttable (`productId`, `genericName`, `brandName`, `classification`,`dosage`, `type`) 
				VALUES ('$productId', '$genericName', '$brandName', '$productClassification', '$dosage', '$type')";
				
				if(!mysqli_query($connect,$toProducttable)){
					die('Error: ' . mysqli_error($connect));
				}
			
			// dynamicproducttable
			$toDynamicproducttable = 
				"INSERT INTO dynamicproducttable (`productId`, `sellingPrice`, `totalQuantity`, `reorderLevel`) 
				VALUES ('$productId','$sellingPriceTotal','$totalquantity','NULL')";	
				
				if (!mysqli_query($connect,$toDynamicproducttable)) {
					die('Error: '. mysqli_errno($connect) .' '. mysqli_error($connect));
				}
			
			// vendorordertable
			$toVendorordertable = 
				"INSERT INTO vendorordertable (`vendorId`, `productId`, `pricePerUnit`, `deliveryTime`,`noOfSmallBoxPerBigBox`,`noOfUnitPerSmallBox`)
				VALUES ('$vendorId', '$productId', '$pricePerUnit', '$deliveryTime', '$smallPerBig', '$unitPerSmall')";
				
				if (!mysqli_query($connect,$toVendorordertable)) {
					die('Error: '. mysqli_errno($connect) .' '. mysqli_error($connect));
				}
			
			echo '<div class="green notice centerNotice smallMarginTop smallMarginBottom">Product '.$genericName.' '.$brandName.'('.$productId.') has been successfully added to the database.</div>';
			
			// vendorinfotable
			if ($isValidatedVendor) {
				$toVendorinfotable = "INSERT INTO vendorinfotable (`vendorId`, `vendorName`, `contactNo`)
					VALUES ('$vendorId', '$new_vendorName', '$contactNo')";
				if (!mysqli_query($connect,$toVendorinfotable)) {
					die('Error: '. mysqli_errno($connect) .' '. mysqli_error($connect));
				}
				echo '<div class="green notice centerNotice smallMarginTop smallMarginBottom">Vendor has been successfully added to the database</div>';
			}
			
			/* UPLOADES IMAGE */
			if(isset($_FILES["productImage"]["name"])){
				$target_dir = "../images/productImages/";
				$temp = explode(".",$_FILES["productImage"]["name"]);
						
				if (end($temp) == "") {
					$filename = "medicine-placeholder.jpg";
					$filepath = $target_dir . $filename;
					echo "<div class='orange notice centerNotice smallMarginTop smallMarginBottom'>No file selected. Default image uploaded</div>";
					
					$setImage = "UPDATE producttable SET producttable.imageFilename='$filename' WHERE producttable.productId='$productId'";
					mysqli_query($connect,$setImage);
				}	
				else {
					$filename = $productId . '.' . end($temp);
					$filepath = $target_dir . $filename;
					$info = getimagesize($_FILES['productImage']['tmp_name']);
					if ($_FILES['productImage']['error'] !== UPLOAD_ERR_OK) 
					   echo "<div class='red notice centerNotice smallMarginTop smallMarginBottom'>Upload failed with error code " . $_FILES['file']['error'] . "</div>";
					if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG))
					   echo "<div class='red notice centerNotice smallMarginTop smallMarginBottom'>Image is not a gif/png/jpg</div>";
					else {
						move_uploaded_file($_FILES["productImage"]["tmp_name"], $filepath);
						echo "<div class='green notice centerNotice smallMarginTop smallMarginBottom'>The file $filename has been uploaded</div>";
						
						$setImage = "UPDATE producttable SET producttable.imageFilename='$filename' WHERE producttable.productId='$productId'";
						mysqli_query($connect,$setImage);
					}
				}
			}
		}
		
		
	}
?>
