<script>
$(function() {

/* FOR DISPENSED MEDICINE */
	$('.add').on('click',function(){
		if($(this).attr('chosen') == '0'){
			$rowId = $(this).attr('id');
			$productId = $(this).attr('productId');
			$genericName = $(this).attr('genericName');
			$brandName = $(this).attr('brandName');
			$quantity = $(this).attr('quantity');
		
			$rowId = "#" + $rowId;
				
				$(this).parent().parent().parent().parent().find($rowId).attr('chosen','1');
		
				$rowId = $rowId.substr(1);
				$arowId = "a" + $rowId;
				$pId = "p" + $rowId;
						
				$row = 
					"<div id='" + $arowId + "'>" +
						"<div id='" + $rowId + "' class='row'"+
						"productId='" + $productId + "'"+
						"genericName='" + $genericName + "'"+
						"brandName='" + $brandName + "'"+
						"quantity='" + $quantity + "'"+
						">"+
							"<div class='column5 column'><button type='button' id='" +$arowId+ "' class= 'opRemoveButton'></button></div>" +
							"<div class='column1 column'>" + $productId + "</div>" +
							"<div class='column2 column'>" + $genericName + "</div>" +
							"<div class='column3 column'>" + $brandName + "</div>" +
							"<div class='column4 column'><input required type = 'number' value=1 min='1' max='"+$quantity+"' id='q" +$rowId+ "' class='quantity' name='q" +$rowId+ "'> </div>" +
							"<input type='hidden' value='" + $productId + "' name='" + $pId +"' id='" + $pId +"'>" +
						"</div>" +
					"</div>";
				
				$rowId = "#" + $rowId;
				$arowId = "#" + $arowId;
				
				$('.dpCart').find($arowId).remove();
				$('.dpCart').append($row);
		
			}
				
		});

});
</script>