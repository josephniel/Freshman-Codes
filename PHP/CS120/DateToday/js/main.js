$(document).foundation({
  orbit: {
		timer_speed: 5000,
		slide_number: false,
		resume_on_mouseout: true
	}
});

function navigator(id){
	
	$('#home-button').parent().removeClass('current');
	$('#about-button').parent().removeClass('current');
	$('#why-button').parent().removeClass('current');
	$('#credits-button').parent().removeClass('current');
	
	$(id).parent().addClass('current');
	
	if ( id === '#home-button'){ 
		$('#home').css('left','0'); 
	}
	else if ( id === '#about-button' ){ 
		$('#home').css('left','-100%');
		$('#others-screen').css('top','0').css('background','#f5f3f0');
	}
	else if ( id === '#why-button' ){ 
		$('#home').css('left','-100%');
		$('#others-screen').css('top','-100%').css('background','#95BC3E');
	}
	else { 
		$('#home').css('left','-100%');
		$('#others-screen').css('top','-200%').css('background','#333');
	}
	
}

$(function() {
	
	/* Navigation */
	$('#home-button').on( 'click', function(){ navigator('#home-button'); });
	$('#about-button').on( 'click', function(){ navigator('#about-button'); });
	$('#why-button').on( 'click', function(){ navigator('#why-button'); });
	$('#credits-button').on( 'click', function(){ navigator('#credits-button'); });
	
	/* Others */
	$('#login-button').on( 'click', function(){ 
		$('#login-modal').show();
	});
	$('#go-back').on( 'click', function(){
		$('#login-modal').hide();
	});
	
	$("#sex").change(function(){
		if($(this).val()==="male"){
			$("#preference").val("female");
		}
		else{
			$("#preference").val("male");
		}
	});
	
	$(".book").on("click",function(){
		if($(this).html() == "Book"){
			$(this).html("Booked");
			$('#dateForm').append("<input type='hidden' id='" + $(this).attr('id') + "' name='" + $(this).attr('id') + "' value='" + $(this).attr('id') + "' />");
		}
		else{ 
			$(this).html("Book");
			var tempID = "#" + $(this).attr('id');
			$('#dateForm').find(tempID).remove();
		}
	});
	
	$(".sched-radio").change(function(){
		var tempValue = $(this).val();
		var totalValue = $("#total-price").html();
		
		var date = $(this).attr("class").split(' ')[0];
		date = date.replace(/\-/g, ' ');
		
		var a = parseFloat(tempValue);
		var b = parseFloat(totalValue);
		
		if($(this).prop("checked")){
			$('#schedForm').append("<input type='hidden' id='" + $(this).attr('id') + "' name='" + $(this).attr('id') + "' value='" + date + "' />");
			$("#total-price").html((b + a).toFixed(2));
			$("#total-price-hidden").val((b + a).toFixed(2));
		}
		else{
			$("#total-price").html((b - a).toFixed(2));
			$("#total-price-hidden").val((b - a).toFixed(2));
			var tempID = "#" + $(this).attr('id');
			$('#schedForm').find(tempID).remove();
		}
	});
	
});