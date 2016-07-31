<script>
$(function() {
	function removeModal() {
		$('body').css('overflow','auto');
		$('.modal').hide();
	}

	/* FOR EDIT VENDOR PRODUCT */
	$('.editVendorProduct').on('click',function(){
			
		/* VENDOR PRODUCT INFO */
		$vendorId = $(this).attr('vendorId');
			$('#updateVendorId').html($vendorId);
			$('.vendorId').val($vendorId);
		$vendorName = $(this).attr('vendorName');
			$('#updateVendorName').html($vendorName);
		$productId = $(this).attr('productId');
			$('#updateProductId').html($productId);
			$('.productId').val($productId);
		$genericName = $(this).attr('genericName');
			$('#updateGenericName').html($genericName);
		$brandName = $(this).attr('brandName');
			$('#updateBrandName').html($brandName);
		$type = $(this).attr('type');
		$type = $type.charAt(0).toUpperCase() + $type.substr(1);
			$('#updateType').html($type);
		$dosage = $(this).attr('dosage');
			$('#updateDosage').html($dosage);
		$classification = $(this).attr('classification');
			$('#updateClassification').html($classification);
		$image = $(this).attr('image');
		$imgPath = '../images/productImages/' + $image;
			$('.modalProductImage').attr('src',$imgPath);
		
		$deliveryTime = $(this).attr('deliveryTime');
			$('#updateDeliveryTime').val($deliveryTime);
		$pricePerUnit = $(this).attr('pricePerUnit');
			if($pricePerUnit == ''){
				$pricePerUnit = 0;
			}
			$('#updatePricePerUnit').val($pricePerUnit);
		$pricePerUnitCent = $(this).attr('pricePerUnitCent');
			if($pricePerUnitCent == ''){
				$pricePerUnitCent = 0;
			}
			$('#updatePricePerUnitCent').val($pricePerUnitCent);
		$unitPerSmall = $(this).attr('unitPerSmall');
			if($unitPerSmall == ''){
				$unitPerSmall = 0;
			}
			$('#updateUnitPerSmall').val($unitPerSmall);
		$smallPerBig = $(this).attr('smallPerBig');
			if($smallPerBig == ''){
				$smallPerBig = 0;
			}
			$('#updateSmallPerBig').val($smallPerBig);
			
		$('body').css('overflow','hidden');
		$('.modal').show();
		
	});	
	
	
	/*FOR EDIT VENDOR PRODUCT SUBMIT*/
	$('.updateSubmit').on('click',function(){
		$valid = true;
		$error = '';
		if($('#updatePricePerUnit').val() == ''){
			$valid=false;
			$error += 'Please input Price Per Unit. ';
		}
		if($('#updateDeliveryTime').val() == ''){
			$valid=false;
			$error += 'Please input Delivery Time. ';
		}
		if($('#updateUnitPerSmall').val() == ''){
			$valid=false;
			$error += 'Please input Number of Units Per Small Box. ';
		}
		if($('#updateSmallPerBig').val() == 0){
			$('#updateSmallPerBig').val('');
		}
		if($('#updateDeliveryTime').val() < 0 ||
			$('#updateUnitPerSmall').val() < 0 ||
			$('#updateSmallPerBig').val() < 0 ||
			$('#updatePricePerUnitCent').val() < 0 ||
			$('#updatePricePerUnitCent').val() > 99 || $('#updatePricePerUnitCent').val() < 0){
			$valid=false;
			$error += 'Please input a valid number. ';
		}
		if($valid){
			$('.updateForm').submit();
		}else{
			alert($error);
		}	
	});		
});
</script>