
$(function(){
	
	$('#first .button').click(function(){
		$('body').css("background","#F8F4EA");
		$('#first').css("left","-100%");
		$('#second').css("left","0");
	});
	
	$('#second .button').click(function(){
		if( $('#second #r1').is(':checked') || $('#second #r2').is(':checked') ){
			$('#second').css("left","-100%");
			$('#third').css("left","0");
		}
		else{
			alert('Please select a value.');
		}
	});
	
	$("#third #add").click(function(){
		$(".x2").css("display","table-cell");
		$("#secondflipflop").val("1");
		$(this).css("background","#67793C").css("color","#F8F4EA").css("cursor","default");
	});
	
	$("#third #next").click(function(){
		if($('#third select').val() != '-'){
			
			var a = $('#third select').val();
			
			var html = "Input ";
			
			if( a === 'd'){
				html += "D Flip-flop ";
			}
			else if( a === 't' ){
				html += "T Flip-flop ";
			}
			else if( a === 'rs'){
				html += "RS Flip-flop ";
			}
			else{
				html += "JK Flip-flop ";
			}
			
			if(a === 'd'){
				if($("#secondflipflop").val() == "0"){
					html += "function";
					$("#fourth h3").html(html);
					
					html = 
					"<h4 style='text-align:left'>DA function:</h4>" +
					"<input class='firstFunction' id='DAFunction' name='DAFunction' type='text' />";
					
					$("#fourth #functions").html(html);
				}
				else{
					html += "functions";
					$("#fourth h3").html(html);
					
					html = 
					"<h4 style='text-align:left'>DA function:</h4>" +
					"<input class='firstFunction' id='DAFunction' name='DAFunction' type='text' />" +
					"<h4 style='text-align:left'>DB function:</h4>" +
					"<input class='secondFunction' id='DBFunction' name='DBFunction' type='text' />";
					
					$("#fourth #functions").html(html);
				}
			}
			else if(a === 't'){
				if($("#secondflipflop").val() == "0"){
					html += "function";
					$("#fourth h3").html(html);
					
					html = 
					"<h4 style='text-align:left'>TA function:</h4>" +
					"<input class='firstFunction' id='TAFunction' name='TAFunction' type='text' />";
					
					$("#fourth #functions").html(html);
				}
				else{
					html += "functions";
					$("#fourth h3").html(html);
					
					html = 
					"<h4 style='text-align:left'>TA function:</h4>" +
					"<input class='firstFunction' id='TAFunction' name='TAFunction' type='text' />" +
					"<h4 style='text-align:left'>TB function:</h4>" +
					"<input class='secondFunction' id='TBFunction' name='TBFunction' type='text' />";
					
					$("#fourth #functions").html(html);
				}
			}
			else if(a === 'rs'){
				html += "functions";
				if($("#secondflipflop").val() == "0"){
					$("#fourth h3").html(html);
					
					html = 
					"<h4 style='text-align:left'>RA function:</h4>" +
					"<input class='firstFunction' id='RAFunction' name='RAFunction' type='text' />" +
					"<h4 style='text-align:left'>SA function:</h4>" +
					"<input class='secondFunction' id='SAFunction' name='SAFunction' type='text' />";
					
					$("#fourth #functions").html(html);
				}
				else{
					$("#fourth h3").html(html);
					
					html = 
					"<h4 style='text-align:left'>RA function:</h4>" +
					"<input class='firstFunction' id='RAFunction' name='RAFunction' type='text' />" +
					"<h4 style='text-align:left'>SA function:</h4>" +
					"<input class='secondFunction' id='SAFunction' name='SAFunction' type='text' />" +
					"<h4 style='text-align:left'>RB function:</h4>" +
					"<input class='thirdFunction' id='RBFunction' name='RBFunction' type='text' />" +
					"<h4 style='text-align:left'>SB function:</h4>" +
					"<input class='fourthFunction' id='SBFunction' name='SBFunction' type='text' />";
					
					$("#fourth #functions").html(html);
				}
			}
			else{
				html += "functions";
				if($("#secondflipflop").val() == "0"){
					$("#fourth h3").html(html);
					
					html = 
					"<h4 style='text-align:left'>JA function:</h4>" +
					"<input class='firstFunction' id='JAFunction' name='JAFunction' type='text' />" +
					"<h4 style='text-align:left'>KA function:</h4>" +
					"<input class='secondFunction' id='KAFunction' name='KAFunction' type='text' />";
					
					$("#fourth #functions").html(html);
				}
				else{
					$("#fourth h3").html(html);
					
					html = 
					"<h4 style='text-align:left'>JA function:</h4>" +
					"<input class='firstFunction' id='JAFunction' name='JAFunction' type='text' />" +
					"<h4 style='text-align:left'>KA function:</h4>" +
					"<input class='secondFunction' id='KAFunction' name='KAFunction' type='text' />" +
					"<h4 style='text-align:left'>JB function:</h4>" +
					"<input class='thirdFunction' id='JBFunction' name='JBFunction' type='text' />" +
					"<h4 style='text-align:left'>KB function:</h4>" +
					"<input class='fourthFunction' id='KBFunction' name='KBFunction' type='text' />";
					
					$("#fourth #functions").html(html);
				}
			}
			
			$('#third').css("top","-100%");
			$('#fourth').css("top","0");
		}
		else{
			alert('Please select a value.');
		}
	});
	
	$("#fourth .button").click(function(){
		if($('.firstFunction').val() !== "" && $('.secondFunction').val() !== "" && $('.thirdFunction').val() !== "" && $('.fourthFunction').val() !== ""){
			$('#fourth').css("left","100%");
			$('#fifth').css("left","0");
		}
		else{
			alert('Please input required functions.');
		}
	});
	
	$("#r11").click(function(){
		$('#outputFunctionContainer').show().append("<input type='text' name='outputFunction' id='outputFunction' />");
		$('#r21').prop("checked", false);
		$(this).prop("checked", true);
	});
	
	$("#r21").click(function(){
		$("#outputFunction").remove();
		$('#outputFunctionContainer').hide();
		$('#r11').prop("checked", false);
		$(this).prop("checked", true);
	});
	
	$("#fifth .button").click(function(){
		if( $('#r11').is(':checked') ){
			if( $("#outputFunction").val() === "" ){
				alert('Please input an output function.');
				return false;
			}
		}
		else if( $('#r21').is(':checked') ){
			return true;
		}
		else{
			alert('Please select one.');
			return false;
		}
		return true;
	});
	
	$(document).keypress(function (evt) {
		var keycode = evt.charCode || evt.keyCode;
		if (keycode  == 13) { //Enter key's keycode
			return false;
		}
	});
	
});