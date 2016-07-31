<script>
$(function() {
/* SCRIPTS FOR RECEIVE DELIVERIES */
	$('.deliveries').on('click',function(){
		if($(this).attr('chosen') == '0'){
			$rowId = $(this).attr('id');
			$productId = $(this).attr('productId');
			$genericName = $(this).attr('genericName');
			$brandName = $(this).attr('brandName');
			$description = $(this).attr('description');
			$receivedBy = $(this).attr('receivedBy');
			$type = $(this).attr('rdType');
			$dosage = $(this).attr('dosage');
			
			$image = $(this).attr('productImage');
			$imgPath = '../images/productImages/' + $image;
				$('.modalProductImage').attr('src',$imgPath);
				
			$roTotalExpense = $(this).attr('roTotalExpense');
			$roTotalUnits = $(this).attr('roTotalUnits');
			$roTotalExpense = parseFloat($roTotalExpense).toFixed(2);
			$roTotalExpenseShown =  $roTotalExpense.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			$roTotalUnitsShown =  $roTotalUnits.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				
			$dateOrdered = $(this).attr('dateOrdered');
			$timeOrdered = $(this).attr('timeOrdered');
			
			$parsedtimeOrdered = $timeOrdered.substr(0,8) + " " + $timeOrdered.substr(15,2);
			
			$doMonth = $dateOrdered.substr(0,2);
			if($doMonth == '01'){ $doMonth='January ';} else if($doMonth == '02'){$doMonth='February ';}
			else if($doMonth == '03'){$doMonth='March ';}else if($doMonth == '04'){$doMonth='April ';}
			else if($doMonth == '05'){$doMonth='May ';}else if($doMonth == '06'){$doMonth='June ';}
			else if($doMonth == '07'){$doMonth='July ';}else if($doMonth == '08'){$doMonth='August ';}
			else if($doMonth == '09'){$doMonth='September ';}else if($doMonth == '10'){$doMonth='October ';}
			else if($doMonth == '11'){$doMonth='November ';}else if($doMonth == '12'){$doMonth='December ';}
			else if($doMonth == '00'){$doMonth='No Date Specified. ';}
			$doDay = $dateOrdered.substr(3,2);
			if($doDay=='00'){$doDay='';}else if($doDay.substr(0,1) == '0'){$doDay = $doDay.substr(1,1);}
			if($doDay!=''){$doDay = $doDay + ', ';}
			$doYear = $dateOrdered.substr(6,4);
			if($doYear=='0000'){$doYear='';}
			$parsedDateOrdered = $doMonth + $doDay + $doYear;
			
			$pricePerUnit = $(this).attr('pricePerUnit');
			$requestedBy = $(this).attr('requestedBy');
			$validatedBy = $(this).attr('validatedBy');
			$numOfSmallBox = $(this).attr('numOfSmallBox');
			$numOfBigBox = $(this).attr('numOfBigBox');
			$numOfUnitPerSmallBox = $(this).attr('numOfUnitPerSmallBox');
			$numOfSmallBoxPerBigBox = $(this).attr('numOfSmallBoxPerBigBox');
			$vendorName = $(this).attr('vendorName');
			$vendorId = $(this).attr('vendorId');
				
			$('.BigBox').show();
			$('.SmallBox').show();
				
			if($numOfSmallBoxPerBigBox == ''){
				$('.BigBox').hide();
				$('#rdNumOfBigBox').val('-1');
				$('#rdNumOfSmallBox').val('');
			}else{
				$('.SmallBox').hide();
				$('#rdNumOfBigBox').val('');
				$('#rdNumOfSmallBox').val('-1');
			}
				
			/* SETTING INFORMATION INSIDE MODAL */
			$('.rdProductId').html($productId);
			$('.rdGenericName').html($genericName);
			$('.rdBrandName').html($brandName);
			$('.rdType').html($type);
			$('.rdDosage').html($dosage);
			$('.rdDescription').html($description);
			$('.rdReceivedBy').html($receivedBy);
				
			$('.roTotalExpense').html($roTotalExpense);
			$('.roTotalUnits').html($roTotalUnits);
			$('.roTotalExpenseShown').html($roTotalExpenseShown);
			$('.roTotalUnitsShown').html($roTotalUnitsShown);
			$('.rdTotalExpense').html(0);
			$('.rdTotalUnits').html(0);
				
			$('.rdDateOrdered').html($parsedDateOrdered);
			$('.rdTimeOrdered').html($parsedtimeOrdered);
			$('.PricePerUnit').html($pricePerUnit);
			$('.roNumOfSmallBox').html($numOfSmallBox);
			$('.roNumOfBigBox').html($numOfBigBox);
			$('.numOfUnitPerSmallBox').html($numOfUnitPerSmallBox);
			$('.numOfSmallBoxPerBigBox').html($numOfSmallBoxPerBigBox);
			$('.rdVendor').html($vendorName);
			
			$('#rdRequestedBy').val($requestedBy);
			$('#rdLot').val("");
			$('#rowID').html($rowId);
				
			$('body').css('overflow','hidden');
			$('.modal').show();
				
			array = [$dateOrdered, $timeOrdered, $productId, $vendorId, $receivedBy, $requestedBy ];
		}
	});
		
	$('.rdSubmit').on('click',function(){
			
		$valid = true;

		$rdEMonth = $('#rdEMonth').val();
		$rdEYear = $('#rdEYear').val();
		$rdLot = $('#rdLot').val();
		$rdNumOfSmallBox = $('#rdNumOfSmallBox').val();
		$rdNumOfBigBox = $('#rdNumOfBigBox').val();
		$rdSalesInvoice = $('#rdSalesInvoice').val();
		
		$rdTotalExpense =  $('.rdTotalExpense').html();
		$rdTotalUnits =  $('.rdTotalUnits').html();
		$roTotalUnits =  $('.roTotalUnits').html();
			
		$alert = '';
		
		$rdDateReceivedMonth = $('#rdDateReceivedMonth').val();
		$rdDateReceivedDay = $('#rdDateReceivedDay').val();
		$rdDateReceivedYear = $('#rdDateReceivedYear').val();
		
		if($rdDateReceivedDay.length == 1){
			$rdDateReceivedDay = '0' + $rdDateReceivedDay;
		}
		if($rdDateReceivedMonth.length == 1){
			$rdDateReceivedMonth = '0' + $rdDateReceivedMonth;
		}
			
		$rdDateReceived = $rdDateReceivedMonth + "-" + $rdDateReceivedDay + "-" + $rdDateReceivedYear;
		
		var d = new Date(), n = d.getMonth(), y = d.getFullYear();
			
		if($rdEYear != '' && $rdEYear < y){			
			$valid = false;
			$alert += '\nProduct has already Expired! ';
		}
			
		if($rdEYear != '' && $rdEYear == y && $rdEMonth <= n){			
			$valid = false;
			$alert += '\nProduct has already Expired! ';
		}
			
		if($rdLot != '' && $rdLot.length<4){
			$valid = false;
			$alert += '\nLot Number too short! ';
		}
			
		if($rdSalesInvoice != '' && $rdSalesInvoice.length<6){
			$valid = false;
			$alert += '\nSales Invoice too short! ';
		}
			
		if(($rdNumOfBigBox == '-1') && ($rdEMonth == '' || $rdEYear == '' || $rdNumOfSmallBox == '' || $rdSalesInvoice=='' || $rdLot=='')){			
			$valid = false;
			$alert += '\nPlease fill up all the boxes!';
		}else if($rdEMonth == '' || $rdEYear == '' || $rdNumOfSmallBox == '' || $rdNumOfBigBox == '' || $rdSalesInvoice=='' || $rdLot==''){
			$valid = false;
			$alert += '\nPlease fill up all the boxes!';
		}
		
		if($valid == false){
			alert($alert);
		}
		
		if($valid == true){
			if($roTotalUnits != $rdTotalUnits){
				$confirm = confirm('WARNING: \n\n Expected Total Units is not equal to Received Total Units. \n Click OK to continue, and CANCEL to cancel.');
				if($confirm == false){
					$valid = false;
				}else{
					
				}
			}
		}
			
		if($valid == true){
			array += [,$rdDateReceived, $rdNumOfSmallBox, $rdNumOfBigBox, $rdLot, $rdEMonth, $rdEYear, $rdTotalExpense, $rdSalesInvoice, 
			$rdTotalUnits, $roTotalUnits];
				
			$('#finalDelivery').val(array);
			$('#deliveriesForm').submit();
			removeModal();
		}
	});
});
</script>