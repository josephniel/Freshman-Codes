<script>
$(function() {

	function removeModal() {
		$('body').css('overflow','auto');
		$('.modal').hide();
	}

	/*FOR EDIT VENDOR SUBMIT*/
	$('.updateSubmit').on('click',function(){
		$valid = true;

		if($('#updateContactNo').val() == ''){
			$valid=false;
			$('.notice').show();
		}
		if($valid){
			$('.notice').hide();
			$('.updateForm').submit();
		}
	});	
	
	/* FOR EDIT VENDOR */
	$('.editVendorInfo').on('click',function(){
			
		/* VENDOR INFO */
		$vendorId = $(this).attr('vendorId');
			$('#updateVendorId').val($vendorId);
			$('#PREVupdateVendorId').val($vendorId);
		$vendorName = $(this).attr('vendorName');
			$('#updateVendorName').val($vendorName);
			$('#PREVupdateVendorName').val($vendorName);
		$contactNo = $(this).attr('contactNo');
			$('#updateContactNo').val($contactNo);
			$('#PREVupdateContactNo').val($contactNo);
			
		$('body').css('overflow','hidden');
		$('.modal').show();
	});
	
});
</script>