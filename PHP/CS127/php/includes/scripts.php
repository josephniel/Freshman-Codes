<script src="../js/jquery-1.11.1.min.js"></script>
<script>
$(function() {
	
	function removeModal() {
		$('body').css('overflow','auto');
		$('.modal').hide();
	}
	
	$(window).load(function() {
		$(".loader").fadeOut("slow");
	});
	
	$('.removeModal').on('click',function(){
		removeModal();
	});
	
	$('.dpCart').on('click', '.opRemoveButton', function(){
		$anId = 'div#' + $(this).attr('id');
		$aId = 'div#' + $(this).attr('id').substr(1);
		$('.opSearchFunction').find($aId).attr('chosen','0');
		$('.dpCart').find($anId).remove();
	});
	
	$('.roOrderCart').on('click', '.roRemoveButton', function(){
		$anId = 'div#' + $(this).attr('id');
		$aId = 'div#' + $(this).attr('id').substr(1);
		$('.roSearchFunction').find($aId).attr('chosen','0');
		$('.roOrderCart').find($anId).remove();
	});
	
	$('.roOrderCart').on('click', '.roEditButton', function(){
		$rowId = $(this).parent().parent().attr('id');
		$productId = $(this).parent().parent().attr('productId');
		$genericName = $(this).parent().parent().attr('genericName');		
	});
	
	/* SEARCH AJAX */
		$(".roSearchSubmit").bind('submit',function() {
			var query = $('#query').val();
			var sortCategory = $('#sortCategory').val();
			var searchCategory = $('#searchCategory').val();
			var fullname = $('#fullname').val();
			var productList = $('#finalProductIds').val();
			$.post('./includes/roSearch.php',{query:query,sortCategory:sortCategory,searchCategory:searchCategory,fullname:fullname,productList:productList}, function(data){
				$(".searchResults").html(data);
			});
			return false;
		});
		$(".opSearchSubmit").bind('submit',function() {
			var query = $('#query').val();
			var sortCategory = $('#sortCategory').val();
			var searchCategory = $('#searchCategory').val();
			$.post('./includes/opSearch.php',{query:query,sortCategory:sortCategory,searchCategory:searchCategory}, function(data){
				$(".searchResults").html(data);
			});
			return false;
		});
		$(".epSearchSubmit").bind('submit',function() {
			var query = $('#query').val();
			var sortCategory = $('#sortCategory').val();
			var searchCategory = $('#searchCategory').val();
			$.post('./includes/epSearch.php',{query:query,sortCategory:sortCategory,searchCategory:searchCategory}, function(data){
				$(".searchResults").html(data);
			});
			return false;
		});
		$(".mdSearchSubmit").bind('submit',function() {
			var query = $('#query').val();
			var sortCategory = $('#sortCategory').val();
			var searchCategory = $('#searchCategory').val();
			var fullname = $('#fullname').val();
			$.post('./includes/mdSearch.php',{query:query,sortCategory:sortCategory,searchCategory:searchCategory,fullname:fullname}, function(data){
				$(".searchResults").html(data);
			});
			return false;
		});
		$(".eviSearchSubmit").bind('submit',function() {
			var query = $('#query').val();
			var sortCategory = $('#sortCategory').val();
			var searchCategory = $('#searchCategory').val();
			$.post('./includes/eviSearch.php',{query:query,sortCategory:sortCategory,searchCategory:searchCategory}, function(data){
				$(".searchResults").html(data);
			});
			return false;
		});
		$(".evpSearchSubmit").bind('submit',function() {
			var query = $('#query').val();
			var sortCategory = $('#sortCategory').val();
			var searchCategory = $('#searchCategory').val();
			$.post('./includes/evpSearch.php',{query:query,sortCategory:sortCategory,searchCategory:searchCategory}, function(data){
				$(".searchResults").html(data);
			});
			return false;
		});
		$(".ipSearchSubmit").bind('submit',function() {
			var query = $('#query').val();
			var sortCategory = $('#sortCategory').val();
			var searchCategory = $('#searchCategory').val();
			$.post('./includes/ipSearch.php',{query:query,sortCategory:sortCategory,searchCategory:searchCategory}, function(data){
				$(".searchResults").html(data);
			});
			return false;
		});
		
		$(".soiSearchSubmit").bind('submit',function() {
			var queryMonth = $('#queryMonth').val();
			var queryDay = $('#queryDay').val();
			var queryYear = $('#queryYear').val();
			if(queryMonth != '0' && queryDay != '0' && queryYear != '0'){
				var query = queryMonth + '-' + queryDay + '-' + queryYear;
			} else if(queryMonth != '0' && queryDay == '0' && queryYear != '0'){
				var query = queryMonth + '-' + queryYear;
			} else if(queryMonth != '0' && queryDay == '0' && queryYear == '0'){
				var query = queryMonth;
			} else if(queryMonth == '0' && queryDay == '0' && queryYear != '0'){
				var query = queryYear;
			} else{
				var query = "0-0-0";
			}
			$.post('./includes/PDFsoi.php',{}, function(data){
				var iframe = $('.pdfiframe');
				iframe.attr('src','./includes/PDFsoi.php?query=' + query);
			});
			return false;
		});
		
		$(".drSearchSubmit").bind('submit',function() {
			var queryMonth = $('#queryMonth').val();
			var queryDay = $('#queryDay').val();
			var queryYear = $('#queryYear').val();
			if(queryMonth != '0' && queryDay != '0' && queryYear != '0'){
				var query = queryMonth + '-' + queryDay + '-' + queryYear;
			} else if(queryMonth != '0' && queryDay == '0' && queryYear != '0'){
				var query = queryMonth + '-' + queryYear;
			} else if(queryMonth != '0' && queryDay == '0' && queryYear == '0'){
				var query = queryMonth;
			} else if(queryMonth == '0' && queryDay == '0' && queryYear != '0'){
				var query = queryYear;
			} else{
				var query = "0-0-0";
			}
			$.post('./includes/PDFdeliveries.php',{}, function(data){
				var iframe = $('.pdfiframe');
				iframe.attr('src','./includes/PDFdeliveries.php?query=' + query);
			});
			return false;
		});
		
		
	/* FOR DISPENSED IN-PATIENT */
		$('.addBed').on('click',function(){
			
			$('#inPatientBedNo').val('');
			$('#inPatientFirstName').val('');
			$('#inPatientMiddleName').val('');
			$('#inPatientLastName').val('');
			$('#inPatientRP').val('');
			
			$today = new Date();
			$day = $today.getDate();
			$month = $today.getMonth()+1;
			$year = $today.getFullYear();
			
			$('#checkInDay').val($day);
			$('#checkInMonth').val($month);
			$('#checkInYear').val($year);
			
			$('.submitInPatient').html('Add Bed');
			$('.editInPatient').hide();
				
			$('.bedHead').html('Add New Bed');
				
			$input = $('<input>').attr('type', 'hidden').attr('name', 'addBed').val('1');
				
			$('.inPatientForm').append($input);
			$('.inPatientForm').attr('action', './includes/ipBedSession.php');
			
			$('body').css('overflow','hidden');
			$('.modal').show();
		
		});
	
	/* FOR ORDER PRODUCTS */
		$('#roFinalizeSubmit').on('click',function(){
			if($('#finalOrder').val()==''){
				alert('No Orders. Please Order.');
			}else{
				$('#sendOrders').submit();
			}
		});
	
	/* AJAX FOR RECEIVE DELIVERIES AND ORDER PRODUCTS */
		$("#roNumOfSmallBox").on('input',function(){
			
			$roNumOfSmallBox= $(this).val();
			$roNumOfUnitPerSmallBox = $('.roNumOfUnitPerSmallBox').html();
				$roTotalUnits = parseInt($roNumOfSmallBox) * parseInt($roNumOfUnitPerSmallBox);
			
			$pricePerUnit = $('.roPricePerUnit').html();
				$roTotalExpense = parseInt($roTotalUnits) * parseFloat($pricePerUnit);
				$roTotalExpense = $roTotalExpense.toFixed(2);
						
			if(isNaN($roTotalUnits) && isNaN($roTotalExpense)){
				$roTotalUnits = 0;
				$roTotalExpense = 0;
				$roTotalExpenseShown =  0;
				$roTotalUnitsShown =  0;
			}else{
				$roTotalExpenseShown =  $roTotalExpense.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				$roTotalUnitsShown =  $roTotalUnits.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}

			$(".roTotalUnits").html($roTotalUnits);
			$(".roTotalExpense").html($roTotalExpense);
			$(".roTotalExpenseShown").html($roTotalExpenseShown);
			$(".roTotalUnitsShown").html($roTotalUnitsShown);
			
		});
		
		$("#roNumOfBigBox").on('input',function(){
			
			$roNumOfBigBox = $('#roNumOfBigBox').val();
			$roNumOfUnitPerSmallBox = $('.roNumOfUnitPerSmallBox').html();
			$roNumOfSmallBoxPerBigBox = $('.roNumOfSmallBoxPerBigBox').html();
				$roTotalUnits = parseInt($roNumOfBigBox) * parseInt($roNumOfSmallBoxPerBigBox) * parseInt($roNumOfUnitPerSmallBox);
			
			$pricePerUnit = $('.roPricePerUnit').html();
				$roTotalExpense = parseInt($roTotalUnits) * parseFloat($pricePerUnit);
			$roTotalExpense = $roTotalExpense.toFixed(2); 
			
			if(isNaN($roTotalUnits) && isNaN($roTotalExpense)){
				$roTotalUnits = 0;
				$roTotalExpense = 0;
				$roTotalExpenseShown = 0;
				$roTotalUnitsShown = 0;
			}else{
				$roTotalExpenseShown =  $roTotalExpense.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				$roTotalUnitsShown =  $roTotalUnits.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}
				
			$(".roTotalUnits").html($roTotalUnits);
			$(".roTotalExpense").html($roTotalExpense);
			$(".roTotalExpenseShown").html($roTotalExpenseShown);
			$(".roTotalUnitsShown").html($roTotalUnitsShown);
		
		});
		
		$("#rdNumOfSmallBox").on('input',function(){
			
			$rdNumOfSmallBox= $('#rdNumOfSmallBox').val();
			$rdNumOfUnitPerSmallBox = $('.numOfUnitPerSmallBox').html();
				$rdTotalUnits = parseInt($rdNumOfSmallBox) * parseInt($rdNumOfUnitPerSmallBox);
			
			$pricePerUnit = $('.PricePerUnit').html();
				$rdTotalExpense = parseInt($rdTotalUnits) * parseFloat($pricePerUnit);
				$rdTotalExpense = $rdTotalExpense.toFixed(2);			
			
			if(isNaN($rdTotalUnits) && isNaN($rdTotalExpense)){
				$rdTotalUnits = 0;
				$rdTotalExpense = 0;
				$rdTotalExpenseShown = 0;
				$rdTotalUnitsShown = 0;
			}else{
				$rdTotalExpenseShown =  $rdTotalExpense.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				$rdTotalUnitsShown =  $rdTotalUnits.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}
			
			$(".rdTotalUnits").html($rdTotalUnits);
			$(".rdTotalExpense").html($rdTotalExpense);			
			$(".rdTotalExpenseShown").html($rdTotalExpenseShown);
			$(".rdTotalUnitsShown").html($rdTotalUnitsShown);
		});
		
		$("#rdNumOfBigBox").on('input',function(){
			
			$rdNumOfBigBox = $('#rdNumOfBigBox').val();
			$rdNumOfUnitPerSmallBox = $('.numOfUnitPerSmallBox').html();
			$rdNumOfSmallBoxPerBigBox = $('.numOfSmallBoxPerBigBox').html();
				$rdTotalUnits = parseInt($rdNumOfBigBox) * parseInt($rdNumOfSmallBoxPerBigBox) * parseInt($rdNumOfUnitPerSmallBox);
				
			$pricePerUnit = $('.PricePerUnit').html();
				$rdTotalExpense = parseInt($rdTotalUnits) * parseFloat($pricePerUnit);
				$rdTotalExpense = $rdTotalExpense.toFixed(2);
				
			if(isNaN($rdTotalUnits) && isNaN($rdTotalExpense)){
				$rdTotalUnits = 0;
				$rdTotalExpense = 0;
				$rdTotalExpenseShown = 0;
				$rdTotalUnitsShown = 0;
			}else{
				$rdTotalExpenseShown =  $rdTotalExpense.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				$rdTotalUnitsShown =  $rdTotalUnits.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}
	
			$(".rdTotalUnits").html($rdTotalUnits);
			$(".rdTotalExpense").html($rdTotalExpense);			
			$(".rdTotalExpenseShown").html($rdTotalExpenseShown);
			$(".rdTotalUnitsShown").html($rdTotalUnitsShown);
		});	
	
	/* AJAX FOR EDIT PRODUCTS AND EDIT DELIVERIES*/
		$("#updateNSBoxes").on('input',function(){
			
			$roNumOfSmallBox= $(this).val();
			$roNumOfUnitPerSmallBox = $('#PerSmall').val();
			$pricePerUnit = $('#Price').val();
			
			if(isNaN($roNumOfSmallBox)){
				$("#updateQPUnit").val('');
				$("#updateExpense").val('');
				$("#updateExpenseShown").val('Invalid Input');
				$("#updateQPUnitShown").val('Invalid Input');
			}else{
				$roTotalUnits = parseInt($roNumOfSmallBox) * parseInt($roNumOfUnitPerSmallBox);
					$roTotalUnitsShown =  $roTotalUnits.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				$roTotalExpense = parseInt($roTotalUnits) * parseFloat($pricePerUnit);
				$roTotalExpense = $roTotalExpense.toFixed(2); 
					$roTotalExpenseShown =  $roTotalExpense.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

				$("#updateQPUnit").val($roTotalUnits);
				$("#updateExpense").val($roTotalExpense);
				$("#updateQPUnitShown").html($roTotalUnitsShown);
				$("#updateExpenseShown").html($roTotalExpenseShown);
			}
		});
		
		$("#updateNBBoxes").on('input',function(){
			
			$roNumOfBigBox = $(this).val();
			$roNumOfUnitPerSmallBox = $('#PerSmall').val();
			$roNumOfSmallBoxPerBigBox = $('#PerBig').val();
			$pricePerUnit = $('#Price').val();
			
			if(isNaN($roNumOfBigBox)){
				$("#updateQPUnit").val('');
				$("#updateExpense").val('');
				$("#updateQPUnitShown").html('Invalid Input');
				$("#updateExpenseShown").html('Invalid Input');
			}else{
				$roTotalUnits = parseInt($roNumOfBigBox) * parseInt($roNumOfSmallBoxPerBigBox) * parseInt($roNumOfUnitPerSmallBox);
					$roTotalUnitsShown =  $roTotalUnits.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				$roTotalExpense = parseInt($roTotalUnits) * parseFloat($pricePerUnit);
				$roTotalExpense = $roTotalExpense.toFixed(2); 
					$roTotalExpenseShown =  $roTotalExpense.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

				$("#updateQPUnit").val($roTotalUnits);
				$("#updateExpense").val($roTotalExpense);
				$("#updateQPUnitShown").html($roTotalUnitsShown);
				$("#updateExpenseShown").html($roTotalExpenseShown);
			}
		});
	
	/* FOR ADD PRODUCTS */
		$('#vendors').on('change',function(){
			$selected = $(this).val();
			
			$('#newVendorName').val('');
			$('#newVendorContactValue').val('');
			
			if($selected == 'addNewVendor'){
				$(this).parent().find('input').removeClass('hidden');
				$('#newVendorContact').show();
				$('#newVendorName').show();
			} else{
				$(this).parent().find('input').addClass('hidden');
				$('#newVendorContact').hide();
				$('#newVendorName').hide();
			}
		});		
		
		/*AJAX for generic name*/
		$('#updateGenericName').on('input',function(){
			$updateGenericName = $('#updateGenericName').val();
			$updateGenericName = $updateGenericName.toUpperCase();
			$('#updateGenericName').val($updateGenericName);
		});	
		
		/*AJAX for brand name*/
		$('#updateBrandName').on('input',function(){
			$updatedBrandName = $('#updateBrandName').val();
			$updatedBrandName = $updatedBrandName.toUpperCase();
			$('#updateBrandName').val($updatedBrandName);
			$updatedProductId = $('#updateProductId').val();
			$updatedProductIdNum = $updatedProductId.substr($updatedProductId.length-1,1);
			if($updatedBrandName.length <3){
				$updatedProductId = $updatedProductId.substr(0,$updatedProductId.indexOf('-')+1) + $updatedBrandName;
				$noOfAsterisk = 3 - $updatedBrandName.length;
				$asterisk = '';
				while($noOfAsterisk>0){
					$asterisk += '*';
					$noOfAsterisk--;
				}
				$updatedProductId += $asterisk + + $updatedProductIdNum;
			}else{
				$updatedProductId = $updatedProductId.substr(0,$updatedProductId.indexOf('-')+1) + $updatedBrandName.substr(0,3) 
				+ $updatedProductIdNum	;
			}
			$('#updateProductId').val($updatedProductId);
		});	
			
		/*AJAX for classification*/
				
		$('#classification').on('change',function(){
			$classification = $('#classification').val();
				$hiddenClassification = $.trim($(this).find('option:selected').html());
				$('#hiddenClassification').val($hiddenClassification);
			
			$updatedProductId = $('#updateProductId').val();
			
			$updatedProductId = $classification + "*" 
				+ $updatedProductId.substr($updatedProductId.indexOf('-'));
			$('#updateProductId').val($updatedProductId);
			
			/*  */
			$('.subclassification').hide();
			$subclassId = "#" + $(this).val().toLowerCase() + "Subclass";
			$($subclassId).show();
			
		});	
		
		/*AJAX for subclassification*/
		$('.subclassification').on('change',function(){
			$subclassification = $(this).val();
			$updatedProductId = $('#updateProductId').val();
			$updatedProductId = $updatedProductId.substr(0,1) + $subclassification + $updatedProductId.substr($updatedProductId.indexOf('-'));
			$('#updateProductId').val($updatedProductId);
			
			/*  */
			$subclass = $(this).find('option:selected').html();
			$subclass = $.trim($subclass);
			$('#hiddenSubClassification').val($subclass);
			$('#hiddenSubclass').val($(this).val());
		});	
		
	/* FOR PENDING USERS */
		$('.pendingUsersRow .clickable').on('click',function(){
			$username = $(this).parent().attr('id');	
			$fullName = $(this).parent().attr('fullName');
			$userType = $(this).parent().attr('userType');	
			$sex = $(this).parent().attr('sex');	
			$birthday = $(this).parent().attr('birthday');	
			$emailAddress = $(this).parent().attr('emailAddress');
			$contactNumber = $(this).parent().attr('contactNumber');
			$image = $(this).parent().attr('profilePicture');
			
			$imagepath = "url(../images/profileImages/" + $image + ")";
			
			$('.puProfileImage').css('background-image', $imagepath);
			$('.puUsername').html($username);
			$('.puUsername').html($username);
			$('.puFullname').html($fullName);
			$('.puUserType').html($userType);
			$('.puSex').html($sex);
			$('.puBirthday').html($birthday);
			$('.puEmail').html($emailAddress);
			$('.puContact').html($contactNumber);
			
			$('body').css('overflow','hidden');
			$('.modal').show();
			
		});
		
		$('.approvedUser').on('click', function(){
			$id = $(this).attr('id');	
			$('.ignoredUser'+ $id).prop( "checked", false );
		});
		
		$('.ignoredUser').on('click', function(){
			$id = $(this).attr('id');	
			$('.approvedUser'+ $id).prop( "checked", false );
		});
		
	<?php if($urlString == 'addProduct.php'){ ?> 
		
		$subClassId = "#<?php echo strtolower($class) ?>Subclass";
		$($subClassId).show();
		
		<?php if($vendorName == 'addNewVendor'){ ?>
		
			$("#newVendorName").show();
			$("#newVendorContact").show();
			
		<?php } ?>
	
	<?php } ?>
	
		
});
</script>

<?php if($urlString == 'receiveDeliveries.php'){ include_once('./includes/rdModalScript.php'); } ?>
<?php if($urlString == 'editProduct.php'){ include_once('./includes/epScript.php'); } ?>
<?php if($urlString == 'orderProducts.php'){ include_once('./includes/roModalScript.php'); } ?>
<?php if($urlString == 'notifications.php'){ include_once('./includes/notificationsScript.php'); } ?>