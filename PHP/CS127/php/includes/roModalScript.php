<script>
$(function() {

	function removeModal() {
		$('body').css('overflow','auto');
		$('.modal').hide();
	}

	/* FOR REORDER */
		$('.roSearchFunction').on('click','.reorder',function(){
						
			$('.errorNotice').addClass('hidden');
						
			if($(this).attr('chosen') == '0'){
			
				$rowId = $(this).attr('id');
					$('#rowID').html($rowId);
				
				$image = $(this).attr('image');
				$imgPath = '../images/productImages/' + $image;
					$('.modalProductImage').attr('src',$imgPath);
					
				$productId = $(this).attr('productId');
					$('.roProductId').html($productId);
					
				$genericName = $(this).attr('genericName');
					$('.roGenericName').html($genericName);
					
				$brandName = $(this).attr('brandName');
					$('.roBrandName').html($brandName);
					
				$type = $(this).attr('type');
				$type = $type.charAt(0).toUpperCase() + $type.substr(1);
					$('.roType').html($type);
					
				$dosage = $(this).attr('dosage');
					$('.roDosage').html($dosage);
					
				$description = $(this).attr('description');
					$('.roDescription').html($description);
					
				$requestedBy = $(this).attr('requestedBy');
					$('.roRequestedBy').html($requestedBy);
					
				$pricePerUnit = $(this).attr('pricePerUnit');
					$('.roPricePerUnit').html($pricePerUnit);
					
				$numOfUnitPerSmallBox = $(this).attr('numOfUnitPerSmallBox');
					$('.roNumOfUnitPerSmallBox').html($numOfUnitPerSmallBox);
					
				$numOfSmallBoxPerBigBox = $(this).attr('numOfSmallBoxPerBigBox');
					$('.roNumOfSmallBoxPerBigBox').html($numOfSmallBoxPerBigBox);
					
				$vendorName = $(this).attr('vendorName');
					$('.roVendor').html($vendorName);
					
				$vendorId = $(this).attr('vendorId');
					$('#vendorId').val($vendorId);
					
				$contactNo = $(this).attr('contactNo');
					$('.contactNo').html($contactNo);
				
				/* INITIAL VALUES */
				$('.roTotalExpense').html('0');
				$('.roTotalUnits').html('0');
				$('.roTotalExpenseShown').html('0');
				$('.roTotalUnitsShown').html('0');
				
				var d = new Date();
					$month = d.getMonth() + 1;
					$day = d.getDate();
					$year = d.getFullYear();
					
					$('#roDateOrderedMonth').val($month);
					$('#roDateOrderedDay').val($day);
					$('#roDateOrderedYear').val($year);
				
				$('.BigBox').show();
				$('.SmallBox').show();
				
				if($numOfSmallBoxPerBigBox == ''){
					$('.BigBox').hide();
					$('#roNumOfBigBox').val('-1');
					$('#roNumOfSmallBox').val('');
				} else {
					$('.SmallBox').hide();
					$('#roNumOfBigBox').val('');
					$('#roNumOfSmallBox').val('-1');
				}
				
				$('body').css('overflow','hidden');
				$('.modal').show();
				
					$('.roSubmit').show();
					$('.roEdit').hide();
					
				array = [,$productId, $vendorId, $requestedBy];
				productArray = [,$productId];
			} 
			else {
				alert('You have already ordered this product. \n If you wish to edit the order, please click that product at the order list, which is located below this list.');
			}
			
		});
	
		$('.roSubmit').on('click',function(){
			
				$('.errorNotice').addClass('hidden');
			
				/* GETTING NEEDED VALUES FOR SUBMISSION */
				
				$valid = true;
				
				$requestedBy = 			$('.roRequestedBy').html();
				
				$pricePerUnit = 		$('.roPricePerUnit').html();
				
				$roVendor = 			$('.roVendor').html();
				
				$vendorId = 			$('#vendorId').val();
				
				$roNumOfUnitPerSmallBox = $('.roNumOfUnitPerSmallBox').html();
				
				$roNumOfSmallBoxPerBigBox = $('.roNumOfSmallBoxPerBigBox').html();
				
				$roNumOfSmallBox= 		$('#roNumOfSmallBox').val();
				
				$roNumOfBigBox = 		$('#roNumOfBigBox').val();
				
				$roTotalExpense = 		$('.roTotalExpense').html();
				
				$roTotalUnits = 		$('.roTotalUnits').html();
				
				$roDateOrderedMonth = 	$('#roDateOrderedMonth').val();
				
				$roDateOrderedDay = 	$('#roDateOrderedDay').val();
				
				$roDateOrderedYear = 	$('#roDateOrderedYear').val();
				
				/* PARSING VALUES */
				
				if($roDateOrderedDay.length == 1){
					$roDateOrderedDay = '0' + $roDateOrderedDay;
				}
				if($roDateOrderedMonth.length == 1){
					$roDateOrderedMonth = '0' + $roDateOrderedMonth;
				}
				
				$roDateOrdered = $roDateOrderedMonth + "-" + $roDateOrderedDay + "-" + $roDateOrderedYear;
				
				/* ERROR CHECKING */
				
				if($roNumOfBigBox == '-1' && $roNumOfSmallBox == ''){
					$valid = false;
					$('.numberOfSmallBoxError').removeClass('hidden');
					$('.numberOfSmallBoxError').children().html('Input number of small box');
				}else if($roNumOfBigBox == '' && $roNumOfSmallBox == '-1'){		
					$valid = false;
					$('.numberOfBigBoxError').removeClass('hidden');
					$('.numberOfBigBoxError').children().html('Input number of big box');
				}else if($roNumOfBigBox == '-1' && $roNumOfSmallBox == '-1'){
					$valid = false;
					$('.numberOfSmallBoxError').removeClass('hidden');
					$('.numberOfSmallBoxError').children().html('Input realistic number of box');
					
				}
				
				if(parseInt($roNumOfSmallBox) < 1 && $roNumOfBigBox == '-1' && $roNumOfSmallBox != '-1'){
					$valid = false;
					$('.numberOfSmallBoxError').removeClass('hidden');
					$('.numberOfSmallBoxError').children().html('Input realistic number of box');
				}
				if(parseInt($roNumOfBigBox) < 1 && $roNumOfSmallBox == '-1' && $roNumOfBigBox != '-1'){		
					$valid = false;
					$('.numberOfBigBoxError').removeClass('hidden');
					$('.numberOfBigBoxError').children().html('Input realistic number of box');
				}
				
				/* IF ALL INPUTS ARE VALID */
				
				if($valid == true){
				
					$rowID = $(this).parent().find('div#rowID').html();
					$rowID = "#" + $rowID;
					
					$(this).parent().parent().parent().parent().find($rowID).attr('chosen','1');
			
					$rowID = $rowID.substr(1);
					$arowID = "a" + $rowID; 
			
					$productId = $(this).parent().find('span.roProductId').html();
					$genericName = $(this).parent().find('span.roGenericName').html();
					$brandName = $(this).parent().find('span.roBrandName').html();
					$description = $(this).parent().find('span.roDescription').html();
					
					/* CREATION OF ORDER LIST ROW */
					
					$row = 
						"<div id='" + $arowID + "'>" +
							"<div id='" + $rowID + "' class='row orderList'"+
							"productId='" + $productId + "'"+
							"genericName='" + $genericName + "'"+
							"brandName='" + $brandName + "'"+
							"description='" + $description + "'"+
							"dateOrdered='" + $roDateOrdered + "'"+
							"pricePerUnit='" + $pricePerUnit + "'"+
							"requestedBy='" + $requestedBy + "'"+
							"numOfUnitPerSmallBox='" + $roNumOfUnitPerSmallBox + "'"+
							"numOfSmallBoxPerBigBox='" + $roNumOfSmallBoxPerBigBox + "'"+
							"numOfSmallBox='" + $roNumOfSmallBox + "'"+
							"numOfBigBox='" + $roNumOfBigBox + "'"+
							"vendorName='" + $roVendor + "'"+
							"vendorId='" + $vendorId + "'"+
							"totalExpense='" + $roTotalExpense + "'"+
							"totalUnits='" + $roTotalUnits + "'"+
							
							">"+
								"<div class='column-1 column'><button type='button' id='" +$arowID+ "' class= 'roRemoveButton'></button></div>" +
								"<div class='column0 column'><button type='button' id='" +$arowID+ "' class= 'roEditButton'></button></div>" +
								"<div class='column1 column'>" + $productId + "</div>" +
								"<div class='column2 column'>" + $genericName + "</div>" +
								"<div class='column3 column'>" + $brandName + "</div>" +
							"</div>" +
						"</div>";
					
					$rowID = "#" + $rowID;
					$arowID = "#" + $arowID;
					
					$('.roCart').find($rowID).remove();
					$('.roCart').append($row);
					
					removeModal();
					
					/* SETTING UP FINAL ORDER ARRAY (INCLUDES ALL INFO THAT NEEDS TO BE ADDED IN THE DATABASE) */
					
					array += [,$roDateOrdered, $roNumOfBigBox, $roTotalExpense, $roTotalUnits, $roNumOfSmallBox];
					
					$previousFinalArray = $('#finalOrder').val();
					
					if($previousFinalArray == ''){
						$currentFinalArray = array.slice(1);
					}
					else{
						$currentFinalArray = $previousFinalArray + array;
					}
					
					$('#finalOrder').val($currentFinalArray);
					
					/* SETTING UP ARRAY OF PRODUCT IDS (USED FOR SEARCHING, SO THAT ORDERED PRODUCTS WILL NO LONGER APPEAR) */
					
					$previousProductIds = $('#finalProductIds').val();
					
					if($previousProductIds == ''){
						$currentProductIds = productArray.slice(1);
					}
					else{
						$currentProductIds = $previousProductIds + productArray;
					}
					
					$('#finalProductIds').val($currentProductIds);

				}
		});
		
		
	/*FOR ORDER LIST*/	
		$('.roOrderCart').on('click', '.roRemoveButton', function(){
			
			$anId = 'div#' + $(this).attr('id');
			$aId = 'div#' + $(this).attr('id').substr(1);
			$('.roSearchFunction').find($aId).attr('chosen','0');
			$('.roOrderCart').find($anId).remove();
		
			/*SEARCHING FOR THE PRODUCT ID OF THE PRODUCT THAT HAS BEEN REMOVED*/
			$productId = $(this).parent().parent().attr('productId');
			
			/*GETTING THE LOCATION OF THE ARRAY OF THAT PRODUCT LIST*/
			$orderList = $('#finalOrder').val();
			$start = $orderList.indexOf($productId);
			$first = $orderList.indexOf(',', $start);
			$second = $orderList.indexOf(',', $first+1);
			$third = $orderList.indexOf(',', $second+1);
			$fourth = $orderList.indexOf(',', $third+1);
			$fifth = $orderList.indexOf(',', $fourth+1);
			$sixth = $orderList.indexOf(',', $fifth+1);
			$seventh = $orderList.indexOf(',', $sixth+1);
			$eight = $orderList.indexOf(',', $seventh+1); // returns -1 if this is the last element of list.
			
			/*REMOVING THE ARRAY OF THAT PRODUCT ID*/
			
			if($start == 0){
				if($eight == -1){
					$orderList = '';
				}else{
					$orderList = $orderList.substr($eight +1);
				}
			}else{
				if($eight == -1){
					$orderList = $orderList.substr(0,$start-1);
				}else{
					$orderList = $orderList.substr(0,$start) + $orderList.substr($eight +1);
				}
			}
			
			$('#finalOrder').val($orderList);
			 
			/*REMOVING THAT PRODUCT ID IN THE LIST OF ORDERED PRODUCT IDS*/
			
			$productList = $('#finalProductIds').val();
			
			$start = $productList.indexOf($productId);
			$comma = $productList.indexOf(',', $start);
			
			if($start == 0){
				if($comma == -1){
					$productList = '';
				}else{
					$productList = $productList.substr($comma +1);
				}
			}else{
				if($comma == -1){
					$productList = $productList.substr(0,$start-1);
				}else{
					$productList = $productList.substr(0,$start) + $productList.substr($comma +1);
				}
			}
			
			$('#finalProductIds').val($productList);

		});
		
		$('.roOrderCart').on('click', '.roEditButton', function(){
						
			$('.errorNotice').addClass('hidden');
						
			/*GETTING NEEDED INFO FOR MODAL*/
		
			$rowId = $(this).parent().parent().attr('id');
				$('#rowID').html($rowId);
			
			$productId = $(this).parent().parent().attr('productId');
				$('.roProductId').html($productId);
				
			$genericName = $(this).parent().parent().attr('genericName');
				$('.roGenericName').html($genericName);
			
			$brandName = $(this).parent().parent().attr('brandName');
				$('.roBrandName').html($brandName);
			
			$description = $(this).parent().parent().attr('description');
				$('.roDescription').html($description);
			
			$requestedBy = $(this).parent().parent().attr('requestedBy');
				$('.roRequestedBy').html($requestedBy);
			
			$pricePerUnit = $(this).parent().parent().attr('pricePerUnit');
				$('.roPricePerUnit').html($pricePerUnit);
			
			$numOfUnitPerSmallBox = $(this).parent().parent().attr('numOfUnitPerSmallBox');
				$('.roNumOfUnitPerSmallBox').html($numOfUnitPerSmallBox);
			
			$numOfSmallBoxPerBigBox = $(this).parent().parent().attr('numOfSmallBoxPerBigBox');
				$('.roNumOfSmallBoxPerBigBox').html($numOfSmallBoxPerBigBox);
			
				$('.BigBox').show();
				$('.SmallBox').show();
				
				if($numOfSmallBoxPerBigBox == ''){
					$('.BigBox').hide();
				}else{
					$('.SmallBox').hide();
				}
			
			$vendorName = $(this).parent().parent().attr('vendorName');
				$('.roVendor').html($vendorName);
			
			$vendorId = $(this).parent().parent().attr('vendorId');		
		
			/*GETTING INPUTTED VALUES BY THE USER THAT IS IN THE HIDDEN ARRAY*/
			
			//product Id, vendorId, requestedBy, roDateOrdered, roNumOfBigBox, roTotalExpense, roTotalUnits, roNumOfSmallBox. 8 Elements.
			$orderList = $('#finalOrder').val();
			
			$start = $orderList.indexOf($productId);
			$first = $orderList.indexOf(',', $start);
			$second = $orderList.indexOf(',', $first+1);
			$third = $orderList.indexOf(',', $second+1);
			$fourth = $orderList.indexOf(',', $third+1);
			$fifth = $orderList.indexOf(',', $fourth+1);
			$sixth = $orderList.indexOf(',', $fifth+1);
			$seventh = $orderList.indexOf(',', $sixth+1);
			$eight = $orderList.indexOf(',', $seventh+1); // returns -1 if this is the last element of list.
			
			/*PARSING VALUES*/
			
			$roDateOrdered = $orderList.substr($third+1, 10);
				
				$month = $roDateOrdered.substr(0,2);
				if($month.charAt(0)=='0'){
					$month = $month.substr(1,1);
				}
				$day = $roDateOrdered.substr(3,2);
				if($day.charAt(0)=='0'){
					$day = $day.substr(1,1);
				}
				$year = $roDateOrdered.substr(6,4);
				
					$('#roDateOrderedMonth').val($month);
					$('#roDateOrderedDay').val($day);
					$('#roDateOrderedYear').val($year);
			
			$roTotalExpense = $orderList.substr($fifth+1, $sixth - $fifth - 1);
				$('.roTotalExpense').html($roTotalExpense);
					$roTotalExpenseShown =  $roTotalExpense.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					$('.roTotalExpenseShown').html($roTotalExpenseShown);
				
			$roTotalUnits = $orderList.substr($sixth+1, $seventh - $sixth - 1);
				$('.roTotalUnits').html($roTotalUnits);
					$roTotalUnitsShown =  $roTotalUnits.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					$('.roTotalUnitsShown').html($roTotalUnitsShown);
				
			$numOfBigBox = $orderList.substr($fourth+1, $fifth - $fourth - 1);
			
			if($eight != -1){
				$numOfSmallBox = $orderList.substr($seventh+1, $eight - $seventh - 1);
			}else{
				$numOfSmallBox = $orderList.substr($seventh+1);
			}
			
			$('#roNumOfSmallBox').val(parseInt($numOfSmallBox));
			$('#roNumOfBigBox').val(parseInt($numOfBigBox));
			
			$('body').css('overflow','hidden');
						
			$('.roSubmit').hide();
			$('.roEdit').show();
			$('.modal').show();
			
			//product Id, vendorId, requestedBy, roDateOrdered, roNumOfBigBox, roTotalExpense, roTotalUnits, roNumOfSmallBox. 8 Elements.
			array = [,$productId, $vendorId, $requestedBy];			
		});
		
		$('.roEdit').on('click', function(){
			
			$productId = $('.roProductId').html();
			
			$roTotalExpense = $('.roTotalExpense').html();
			
			$roTotalUnits = $('.roTotalUnits').html();
			
			$roNumOfSmallBox= $('#roNumOfSmallBox').val();
			
			$roNumOfBigBox = $('#roNumOfBigBox').val();
			
			$roDateOrderedMonth = $('#roDateOrderedMonth').val();
			
			$roDateOrderedDay = $('#roDateOrderedDay').val();
			
			$roDateOrderedYear = $('#roDateOrderedYear').val();
			
				if($roDateOrderedDay.length == 1){
					$roDateOrderedDay = '0' + $roDateOrderedDay;
				}
				if($roDateOrderedMonth.length == 1){
					$roDateOrderedMonth = '0' + $roDateOrderedMonth;
				}	
				
				$roDateOrdered = $roDateOrderedMonth + "-" + $roDateOrderedDay + "-" + $roDateOrderedYear;

			
			/*GETTING DETAILS OF THAT PRODUCT ID */
			
			//product Id, vendorId, requestedBy, roDateOrdered, roNumOfBigBox, roTotalExpense, roTotalUnits, roNumOfSmallBox. 8 Elements.
			$orderList = $('#finalOrder').val();
			
			$start = $orderList.indexOf($productId);
			$first = $orderList.indexOf(',', $start);
			$second = $orderList.indexOf(',', $first+1);
			$third = $orderList.indexOf(',', $second+1);
			$fourth = $orderList.indexOf(',', $third+1);
			$fifth = $orderList.indexOf(',', $fourth+1);
			$sixth = $orderList.indexOf(',', $fifth+1);
			$seventh = $orderList.indexOf(',', $sixth+1);
			$eight = $orderList.indexOf(',', $seventh+1); // returns -1 if this is the last element of list.
			
			$editedorderList = $orderList.substr(0,$third+1) + $roDateOrdered + ',' + $roNumOfBigBox + ','
						+ $roTotalExpense + ',' + $roTotalUnits + ',' + $roNumOfSmallBox;
			
			if($eight != -1){
				$editedorderList += $orderList.substr($eight);
			}
			
			$('#finalOrder').val($editedorderList);
			
			removeModal();
		});
		//end
	
});
</script>