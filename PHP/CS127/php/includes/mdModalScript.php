<script>
$(function() {

	function removeModal() {
		$('body').css('overflow','auto');
		$('.modal').hide();
	}

	/* FOR EDIT DELIVERIES */
		$('.updateDeliveries').on('click',function(){
			if($(this).attr('chosen') == '0'){
			
				$rowId = $(this).attr('id');
					$('#rowID').html($rowId);
			
				/* PRODUCT INFO */
				$productId = $(this).attr('productId');
					$('#updateProductId').val($productId);
				$genericName = $(this).attr('genericName');
					$('#updateGenericName').val($genericName);
				$brandName = $(this).attr('brandName');
					$('#updateBrandName').val($brandName);
				$type = $(this).attr('type');
					if($type != ''){
						$('#updateType').val($type);
					}
				$dosage = $(this).attr('dosage');
					$('#updateDosage').val($dosage);
				$classification = $(this).attr('classification');
					$('#updateClassification').val($classification);
				$image = $(this).attr('image');
				$imgPath = '../images/productImages/' + $image;
					$('.modalProductImage').attr('src',$imgPath);
				
				/* DELIVERY INFO */
				$receivedBy = $(this).attr('receivedBy');
					$('#updateReceivedBy').val($receivedBy);
				$dateOrdered = $(this).attr('dateOrdered');
					$('#PREVupdateDateOrdered').val($dateOrdered);
				
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
				
				$('#updateDateOrdered').html($parsedDateOrdered);
						
					$dateReceived = $(this).attr('dateReceived');		
						$('#PREVupdateDateReceived').val($dateReceived);
					$dateReceivedM = $dateReceived.substr(0,2);
						$('#updateDateReceivedM').val(parseInt($dateReceivedM));
					$dateReceivedD = $dateReceived.substr(3,2);
						$('#updateDateReceivedD').val(parseInt($dateReceivedD));
					$dateReceivedY = $dateReceived.substr(6,4);	
						$('#updateDateReceivedY').val($dateReceivedY);
				
				$EMonth = $(this).attr('expiryM');
					$('#updateEMonth').val($EMonth);
				$EYear = $(this).attr('expiryY');
					$('#updateEYear').val($EYear);
				
				$lot = $(this).attr('lot');
					$('#updateLot').val($lot);
				$price = $(this).attr('price');
					$('#Price').val($price);
				$perBig = $(this).attr('perBig');
					$('#PerBig').val($perBig);
				$perSmall = $(this).attr('perSmall');
					$('#PerSmall').val($perSmall);
				
				/* CONDITION TO HIDE BIG/SMALL BOXES IF NULL */
				$('.bigBox').show();
				$('.smallBox').show();
					
				if($perBig == null || $perBig == '' || $perBig == '-1'){
					$('.bigBox').hide();
				}else{
					$('.smallBox').hide();
				}
				
				$NSBoxes = $(this).attr('NSBoxes');
					$('#updateNSBoxes').val($NSBoxes);
				$NBBoxes = $(this).attr('NBBoxes');
					$('#updateNBBoxes').val($NBBoxes);
				$roTotalUnits = $(this).attr('roTotalUnits');
					$('#roTotalUnits').val($roTotalUnits);
				$QPUnit = $(this).attr('QPUnit');
					$('#updateQPUnit').val($QPUnit);
					$QPUnitShown =  $QPUnit.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					$('#updateQPUnitShown').html($QPUnitShown);
				$vendor = $(this).attr('vendorName');
					$('#updateVendor').val($vendor);
				$expense = $(this).attr('expense');
					$expense = parseFloat($expense).toFixed(2);
					$('#updateExpense').val($expense);	
					$expenseShown =  $expense.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					$('#updateExpenseShown').html($expenseShown);
				$received = $(this).attr('received');
					$('#updateReceivedBy').val($received);
				$requested = $(this).attr('requested');
					$('#updateRequestedBy').val($requested);
				
				$invoice = $(this).attr('invoice');
					$('#updateInvoice').val($invoice);
						
				$('body').css('overflow','hidden');
				$('.modal').show();

				/* INITIALIZING HIDDEN VALUE TO BE SUBMITTED */
				$('#editedEntry').val('');
				
			}
		});
		
		$('.updateDeliveriesSubmit').on('click',function(){
					
			$productId = $('#updateProductId').val();
			
			$PREVupdateDateOrdered = $('#PREVupdateDateOrdered').val();
			
			$PREVupdateDateReceived = $('#PREVupdateDateReceived').val();
			

			$month = $('#updateDateReceivedM').val();
			$day = $('#updateDateReceivedD').val();
			$year = $('#updateDateReceivedY').val();

			if($month.length == 1){
				$month = '0' + $month;
			}
			if($day.length == 1){
				$day = '0' + $day;
			}

			$updateDateReceived = $month + '-' + $day + '-' + $year;
					
			$roTotalUnits = $('#roTotalUnits').val();
			
			$updateQPUnit = $('#updateQPUnit').val();
				
			$updateLot = $('#updateLot').val();
				
			$updateEMonth = $('#updateEMonth').val();
			
			$updateEYear = $('#updateEYear').val();
			
			$updateNSBoxes = $('#updateNSBoxes').val();
			
			$updateNBBoxes = $('#updateNBBoxes').val();
			
			$updateExpense = $('#updateExpense').val();
			
			$updateInvoice = $('#updateInvoice').val();
						
			/* FORM ERROR CHECKING */
			
			$valid = true;
			$alert = '';
			
			if($updateInvoice==''){
				$alert += 'Please input Sales Invoice. \n';
				$valid = false;
			}
			
			if($updateLot == ''){
				$alert += 'Please input lot Number. \n';
				$valid = false;
			}else if($updateLot.length < 4){
				$alert += 'Lot Number is too short. \n';
				$valid = false;
			}
			
			if(isNaN($updateExpense) || isNaN($updateQPUnit)){
				$alert += 'Please input a number. \n';
				$valid = false;
			}
			
			var d = new Date();
			$month = d.getMonth() + 1;
			$year = d.getFullYear();
				
			if($year == $updateEYear){
				if($updateEMonth <= $month){
					$alert += 'The Product is already expired. \n';
					$valid = false;
				}
			}
			
			if($valid == false){
				alert($alert);
			}
			
			if($valid == true){
				if($roTotalUnits != $updateQPUnit){
					$confirm = confirm('WARNING: \n\n Expected Total Units is not equal to Received Total Units. \n Click OK to continue, and CANCEL to cancel.');
					if($confirm == false){
						$valid = false;
					}		
				}
			}
						
			if($valid == true){
				
				$('body').css('overflow','auto');
				$('.modal').hide();
				
				/* INITIALIZING ARRAY THAT IS TO BE PUT IN THE HIDDEN VALUE */
				var editArray = [$productId, $PREVupdateDateOrdered, $PREVupdateDateReceived, $updateDateReceived, $updateQPUnit, $updateLot,
				$updateEMonth, $updateEYear, $updateNSBoxes, $updateNBBoxes, $updateExpense, $updateInvoice];
				
				$('#editedEntry').val(editArray);
				
				$('.submitEditForm').submit();
			}
		});

});
</script>