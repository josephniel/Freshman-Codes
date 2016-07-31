<script>
$(function() {

	function removeModal() {
		$('body').css('overflow','auto');
		$('.modal').hide();
	}

	$orderList = [];
	
	/* FOR REORDER */
		$('.notificationReorder').on('click',function(){
				
				$notificationType = $(this).parent().parent().find('.productInformation .notificationType').html();
					
				$productId = $(this).parent().parent().find('.productInformation .productId').html();
					$('.roProductId').html($productId);
					
				$genericName = $(this).parent().parent().find('.productInformation .genericName').html();
					$('.roGenericName').html($genericName);
					
				$brandName = $(this).parent().parent().find('.productInformation .brandName').html();
					$('.roBrandName').html($brandName);
					
				$classification = $(this).parent().parent().find('.productInformation .classification').html();
					$('.roDescription').html($classification);
					
				$requestedBy = $(this).parent().parent().find('.productInformation .requestedBy').html();
					$('.roRequestedBy').html($requestedBy);
					
				$pricePerUnit = $(this).parent().parent().find('.productInformation .unitPrice').html();
					$('.roPricePerUnit').html($pricePerUnit);
					
				$numOfUnitPerSmallBox = $(this).parent().parent().find('.productInformation .noOfUnitsperSB').html();
					$('.roNumOfUnitPerSmallBox').html($numOfUnitPerSmallBox);
					
				$numOfSmallBoxPerBigBox = $(this).parent().parent().find('.productInformation .noOfSBperBB').html();
					$('.roNumOfSmallBoxPerBigBox').html($numOfSmallBoxPerBigBox);
					
				$vendorName = $(this).parent().parent().find('.productInformation .vendorName').html();
					$('.roVendor').html($vendorName);
					
				$vendorId = $(this).parent().parent().find('.productInformation .vendorId').html();
					$('#vendorId').val($vendorId);
					
				$contactNo = $(this).parent().parent().find('.productInformation .vendorContact').html();
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
				
				$orderList = [$notificationType, $productId, $vendorId, $requestedBy,];
				
				$('body').css('overflow','hidden');
				$('.modal').show();
			
		});
		
		$('.nroSubmit').on('click', function(){
			
			$roNumOfSmallBox= $('#roNumOfSmallBox').val();
			$roNumOfBigBox = $('#roNumOfBigBox').val();			
			$totalExpense = $('.notificationsReorder .roTotalExpense').html();
			$totalUnits = $('.notificationsReorder .roTotalUnits').html();
			
			$roDateOrderedMonth = 	$('#roDateOrderedMonth').val();
			$roDateOrderedDay = 	$('#roDateOrderedDay').val();
			$roDateOrderedYear = 	$('#roDateOrderedYear').val();
			
			if($roDateOrderedDay.length == 1){
				$roDateOrderedDay = '0' + $roDateOrderedDay;
			}
			if($roDateOrderedMonth.length == 1){
				$roDateOrderedMonth = '0' + $roDateOrderedMonth;
			}
				
			$roDateOrdered = $roDateOrderedMonth + "-" + $roDateOrderedDay + "-" + $roDateOrderedYear;
				
			$alert = '';
			$valid = true;
			
			if($roNumOfBigBox == '-1' && $roNumOfSmallBox == ''){
				$valid = false;
				$alert += '\nPlease indicate the number of small boxes!';
			}else if($roNumOfBigBox == '' && $roNumOfSmallBox == '-1'){		
				$valid = false;
				$alert += '\nPlease indicate the number of big boxes!';
			}
			if($valid == false){
				alert($alert);
			}
			
			if($valid == true){
				$orderList += [, $roDateOrdered, $roNumOfSmallBox, $roNumOfBigBox, $totalExpense, $totalUnits];
				 
				$('#reorderArray').val($orderList);
				
				$('#notifReorderForm').submit();
				
				removeModal();
			
			}
		
		});
		
	
});
</script>