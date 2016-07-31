<script>
$(function() {

	$('.redirectInPatient').on('click',function(){

		$bedNo = $(this).attr('bedNo');	
			$('#inPatientBedNo').val($bedNo);
		$patientFirstName = $(this).attr('patientFirstName');
			$('#inPatientFirstName').val($patientFirstName);
		$patientMiddleName = $(this).attr('patientMiddleName');
			$('#inPatientMiddleName').val($patientMiddleName);
		$patientLastName = $(this).attr('patientLastName');
			$('#inPatientLastName').val($patientLastName);
		$requestingPhysician = $(this).attr('requestingPhysician');		
			$('#inPatientRP').val($requestingPhysician);
		$checkInDate = $(this).attr('checkInDate');
			$('#checkInMonth').val(parseInt($checkInDate.substr(0,2)));
			$('#checkInDay').val(parseInt($checkInDate.substr(3,2)));
			$('#checkInYear').val(parseInt($checkInDate.substr(6,4)));
			
		$('#PREVinPatientBedNo').val($bedNo);
			
		$('.editInPatient').show();
		$('.submitInPatient').html('View Patient Record');
			
		$('body').css('overflow','hidden');
		$('.modal').show();
	
	});
	
	$('.editInPatient').on('click',function(){
		$('.inPatientForm').attr('action', 'dispenseInPatient.php')
		$('.inPatientForm').submit();
	});
	
	$('.submitInPatient').on('click',function(){
		
		$bedId = $('#inPatientBedNo').val();
		$firstName = $('#inPatientFirstName').val();
		$middleName = $('#inPatientMiddleName').val();
		$lastName = $('#inPatientLastName').val();
		
		if($bedId != "" && $firstName != "" && $middleName != "" && $lastName != ""){
			$('.inPatientForm').attr('action', './includes/ipBedSession.php');
			$('.inPatientForm').submit();
		}
	});
	
		
	$('.checkOut').on('click',function(){
		var input = $("<input>").attr("type", "hidden").attr("name", "checkOut").val("1");
		$('#checkOutForm').append($(input));
		$('#checkOutForm').attr('action', 'dispenseInPatient.php');
		$('#checkOutForm').submit();
	});
});
</script>