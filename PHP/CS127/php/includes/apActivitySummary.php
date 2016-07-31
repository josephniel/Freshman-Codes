<?php
$html = "<h4>Activities</h4>";

$deliveryResult = mysqli_query($connect, "SELECT * FROM deliveriestable WHERE 1");
$activityResult = mysqli_query($connect, "SELECT * FROM activitytable WHERE userType='Pharmacist' ORDER BY activityDate DESC");
$aCount = mysqli_num_rows($activityResult);

if($aCount != 0){

	$list = array();
	$detArr = array();
	while($act = mysqli_fetch_array($activityResult)){
		if($act['activityType'] == "issued" || ($act['activityType'] == "ordered")){
			$concat = $act['activityDate'] . "^" . $act['fullName'] . "^" . $act['activityType'];
		}
		else{
			$sub = substr($act['activityType'], 9, 10);
			$concat = $sub . "^" . $act['fullName'] . "^" . $act['activityType'];
		}
		if(!exists($concat, $list)){
			$list[] = $concat;
		}
	}
	
	$queryArr = array();
	$aCount = mysqli_num_rows($activityResult);
	$count = 0;
	for($m=0; $m<count($list); $m++){
		$pieces = explode("^", $list[$m]);
		if($count <  $aCount){
			if($pieces[2] == "issued"){
				$newAT = $pieces[0];
				$queryArr[$m] = mysqli_query($connect, "SELECT * FROM dispensedmedicinetable WHERE dispenseId LIKE '".$newAT."%' AND receivedBy='".$pieces[1]."'");
				$detArr[$m] = "issued";
			}
			else if($pieces[2] == "ordered"){
				$newAT = $pieces[0];
				$newAT[2] = "-";
				$newAT[5] = "-";
				$queryArr[$m] = mysqli_query($connect, "SELECT * FROM reordertable WHERE dateOrdered='".$newAT."' AND requestedBy='".$pieces[1]."'");
				$detArr[$m] = "ordered";
			}
			else{
				$newAT = $pieces[0];
				$newAT[2] = "-";
				$newAT[5] = "-";
				$queryArr[$m] = mysqli_query($connect, "SELECT * FROM deliveriestable WHERE dateReceived='".$newAT."' AND receivedBy='".$pieces[1]."'");
				$detArr[$m] = "delivered";
			}
			$count = $count + mysqli_num_rows($queryArr[$m]);
		}
	}

	for($m=0; $m<count($queryArr); $m++){
		if($m<10){ // displays 1st 10 results
			$minicount=0;
			$supertotal=0;
			if($detArr[$m] == "issued")
				$html .= "<div class='activity issueActivity'>";
			else
				$html .= "<div class='activity receiveActivity'>";
				
			while($postData = mysqli_fetch_array($queryArr[$m])){
				if($minicount == 0){
					$act2 = mysqli_query($connect, "SELECT * FROM activitytable WHERE userType='Pharmacist' ORDER BY activityDate DESC");
					if($detArr[$m] == "issued"){
						while($a = mysqli_fetch_array($act2)){
							if(($a['fullName'] == $postData['receivedBy']) && ($a['activityDate'] == substr($postData['dispenseId'], 0, 10)) && ($a['activityType'] == "issued")){	// issued
								$html .= "<b>&nbsp;</b><span class='floatRight'><b>Timestamp: </b>".$a['activityTime']."</span><hr>";
								break;
							}
						}
						$html .= "<b>" . $postData['receivedBy'] ." issued the following (" .substr($postData['dispenseId'], 0, 10) . ")</b>";
					}
					else if($detArr[$m] == "ordered"){
						while($a = mysqli_fetch_array($act2)){
							$x = $a['activityDate'];
							$x[2] = "-";
							$x[5] = "-";
							if(($a['fullName'] == $postData['requestedBy']) && ($x == $postData['dateOrdered']) && ($a['activityType'] == "ordered")){	// ordered
								$html .= "<b>&nbsp;</b><span class='floatRight'><b>Timestamp: </b>".$a['activityTime']."</span><hr>";
								break;
							}
						}
						$html .= "<b>" . $postData['requestedBy'] ." ordered the following (" .$postData['dateOrdered']. ")</b>";
					}
					else{
						while($a = mysqli_fetch_array($act2)){
							$x = substr($a['activityType'], 9, 10);
							$x[2] = "-";
							$x[5] = "-";
							if(($a['fullName'] == $postData['receivedBy']) && ($x == $postData['dateReceived'])){
								$html .= "<b>&nbsp;</b><span class='floatRight'><b>Timestamp: </b>".$a['activityTime']."</span><hr>";
								break;
							}
						}
						$html .= "<b>" . $postData['receivedBy'] ." received the following deliveries (" .$postData['dateReceived']. ")</b>";
					}
					
					$html .= "<div class='issueActivityTable defaultTable'>";
						$html .= "<div class='row tableHeaderRow'>";
						$html .= "<div class='column1 column'>Brand Name</div>";
						$html .= "<div class='column2 column'>Quantity</div>";
						$html .= "<div class='column3 column'>Price / Unit</div>";
						$html .= "<div class='column4 column'>Total</div>";
						$html .= "</div>";
				}
						
				$html .= "<div class='row'>";
				$productResult = mysqli_query($connect, "SELECT * FROM producttable");
				$dynamicResult = mysqli_query($connect, "SELECT * FROM dynamicproducttable");
				$vendorResult = mysqli_query($connect, "SELECT * FROM vendorordertable");
				
				if($detArr[$m] == "issued"){
					while($prod = mysqli_fetch_array($productResult)){
						if($prod['productId'] == $postData['productId']){
							$html .= "<div class='column1 column'>" . $prod['brandName'] . "</div>";
						}
					}
					$html .= "<div class='column2 column'>". $postData['quantity'] ."</div>";
					
					$price = 0;
					while($dyn = mysqli_fetch_array($dynamicResult)){
						if($dyn['productId'] == $postData['productId']){
							$price = $dyn['sellingPrice'];
							$html .= "<div class='column3 column'>" . $price . "</div>";
							break;
						}
					}
				
					$html .= "<div class='column4 column'>" . ($postData['quantity'] * $price) . "</div>";
					$supertotal+=$postData['quantity']*$price;
				}
				
				else if($detArr[$m] == "ordered"){
					while($prod = mysqli_fetch_array($productResult)){
						if($prod['productId'] == $postData['productId']){
							$html .= "<div class='column1 column'>" . $prod['brandName'] . "</div>";
						}
					}
					$html .= "<div class='column2 column'>". $postData['roTotalUnits'] ."</div>";
					
					$price = 0;
					while($ven = mysqli_fetch_array($vendorResult)){
						if(($ven['vendorId'] == $postData['vendorId']) && ($ven['productId'] == $postData['productId'])){
							$price = $ven['pricePerUnit'];
							$html .= "<div class='column3 column'>" . $price . "</div>";
							break;
						}
					}
					$html .= "<div class='column4 column'>" . ($postData['roTotalUnits'] * $price) . "</div>";
					$supertotal+=$postData['roTotalUnits']*$price;
				}
				
				else{
					while($prod = mysqli_fetch_array($productResult)){
						if($prod['productId'] == $postData['productId']){
							$html .= "<div class='column1 column'>" . $prod['brandName'] . "</div>";
						}
					}
					$html .= "<div class='column2 column'>". $postData['rdTotalUnits'] ."</div>";
					
					$price=0;
					while($ven = mysqli_fetch_array($vendorResult)){
						if(($ven['vendorId'] == $postData['vendorId']) && ($ven['productId'] == $postData['productId'])){
							$price = $ven['pricePerUnit'];
							$html .= "<div class='column3 column'>" . $price . "</div>";
							break;
						}
					}
					$html .= "<div class='column4 column'>" . ($postData['rdTotalUnits'] * $price) . "</div>";
					$supertotal+=$postData['rdTotalUnits']*$price;
				}
				
				$html .= "</div>";

				if($minicount == mysqli_num_rows($queryArr[$m]) - 1){
					$html .= "<div class='row'>";
					$html .= "<div class='column1 column'>-</div>";
					$html .= "<div class='column2 column'>-</div>";
					$html .= "<div class='column3 column'><b>Total Price:</b></div>";
					$html .= "<div class='column4 column'>" . $supertotal . "</div>";
					$html .= "</div>";
					$html .= "</div>";
				}
				$minicount++;
			}
			$html .= "</div>";
		}
	}

	$html .= 
		"<a href='./activityPharmacistActivities.php'>
			<button class='orange button' style='margin-top: 10px;'>View All</button>
		</a>";
		
	mysqli_close($connect);
	echo $html;

}

function exists($element, $array){
	for($i=0; $i<count($array); $i++){
		if($array[$i] == $element)
			return true;
	}
	return false;
}

?>