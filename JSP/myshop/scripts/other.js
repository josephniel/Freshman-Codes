var products = new Array();
products[0] = {title:"Too Weird To Live, Too Rare to Die",artist:"Panic! at the Disco",price:"499.50",number:"1"};
products[1] = {title:"Overnight",artist:"Parachute",price:"499.50",number:"2"};
products[2] = {title:"Lights",artist:"Ellie Goulding",price:"499.50",number:"3"};
products[3] = {title:"Wonders of the Younger",artist:"Plain White T's",price:"499.50",number:"4"};
products[4] = {title:"On Letting Go",artist:"Circa Survive",price:"499.50",number:"5"};
products[5] = {title:"Stars - Some Nights",artist:"fun.",price:"49.50",number:"6"};
products[6] = {title:"Nicotine - Too Weird To Live, Too Rare to Die",artist:"Panic! at the Disco",price:"49.50",number:"7"};
products[7] = {title:"The Greatest Lie - On Letting Go",artist:"Circa Survive",price:"49.50",number:"8"};
products[8] = {title:"Hurricane - Overnight",artist:"Parachute",price:"49.50",number:"9"};
products[9] = {title:"Broken Record - Wonders of the Younger",artist:"Plain White T's",price:"49.50",number:"10"};
products[10] = {title:"Pure Heroine",artist:"Lorde",price:"499.50",number:"11"};
products[11] = {title:"Native",artist:"OneRepublic",price:"499.50",number:"12"};
products[12] = {title:"A.M.",artist:"Arctic Monkeys",price:"499.50",number:"13"};
products[13] = {title:"Bangerz",artist:"Miley Cyrus",price:"409.50",number:"14"};
products[14] = {title:"Midnight Memories",artist:"One Direction",price:"409.50",number:"15"};

function checkout(){
	if(!$("#form").find("input.hiddenInput").length){
		alert("There is no product on your cart!");
		return false;
	}
	return true;
}

function checkPaymentMethod(){
	if(!$("#m").is(':checked') && !$("#v").is(':checked')){
		alert("Please select a payment method!");
		return false;
	}
	return true;
}

function selected(event){
	if(event.data.number == 1){
		$("#mastercard").css("display","none");
		$("#mastercardh").css("display","block");
		$("#visa").css("display","block");
		$("#visah").css("display","none");
	}
	else{
		$("#mastercard").css("display","block");
		$("#mastercardh").css("display","none");
		$("#visa").css("display","none");
		$("#visah").css("display","block");
	}
}

function click(event){
	var a = "<li id='prod" + event.data.number + "' class='productDetails product" + event.data.number + "'><div class='productArt'></div><div class='productDescription'><ul><li id='title'>" + event.data.title + "</li><li id='artist'>" + event.data.artist + "</li><li id='price'>" + event.data.price + " Php</li></ul></div><div class='removeProduct' id='removeProduct"+ event.data.number +"'>Remove</div></li>";
		
	$("#productContainer ul#products").append(a);
	
	$("#product"+event.data.number).css("cursor","default").css("text-decoration","none");
	$("#product"+event.data.number+" img").css("visibility","visible");
	$("#product"+event.data.number).unbind('click', click);
	
	$("#form").append("<input class='hiddenInput' id='hidden" + event.data.number + "' type='hidden' name='product' value='" + event.data.number + "' />");
}

function remove(event){
	
	var newprodid = "#removeProduct" + event.data.number;
		
	$("#product" + event.data.number + " img").css("visibility","hidden");
	$("#product" + event.data.number).css("cursor","pointer").css("text-decoration","none");
	$(newprodid).parent().remove();
	$("#hidden" + event.data.number).remove();
		
	switch(event.data.number){
		case "1": $("#product"+event.data.number).on("click",products[0],click); break;
		case "2": $("#product"+event.data.number).on("click",products[1],click); break;
		case "3": $("#product"+event.data.number).on("click",products[2],click); break;
		case "4": $("#product"+event.data.number).on("click",products[3],click); break;
		case "5": $("#product"+event.data.number).on("click",products[4],click); break;
		case "6": $("#product"+event.data.number).on("click",products[5],click); break;
		case "7": $("#product"+event.data.number).on("click",products[6],click); break;
		case "8": $("#product"+event.data.number).on("click",products[7],click); break;
		case "9": $("#product"+event.data.number).on("click",products[8],click); break;
		case "10": $("#product"+event.data.number).on("click",products[9],click); break;
		case "11": $("#product"+event.data.number).on("click",products[10],click); break;
		case "12": $("#product"+event.data.number).on("click",products[11],click); break;
		case "13": $("#product"+event.data.number).on("click",products[12],click); break;
		case "14": $("#product"+event.data.number).on("click",products[13],click); break;
		case "15": $("#product"+event.data.number).on("click",products[14],click); break;
	}
}

function leftButton(event){
	var temp1 = "pr"+event.data.number;
	var temp2 = "price"+event.data.number;
	var temp3 = "hidden"+event.data.number;
	var temp4 = "hiddenprice"+event.data.number;
	
	var get = document.getElementById(temp1).innerHTML;
	var get2 = document.getElementById(temp2).innerHTML;
	
	var a = parseInt(get);
	var b = parseFloat(get2);
	var c = parseFloat(event.data.price);
	
	if(a > 1){b
		document.getElementById(temp1).innerHTML = a - 1;
		document.getElementById(temp2).innerHTML = (b - c).toFixed(2);
		
		var get3 = document.getElementById("totalPrice").innerHTML;
		var d = parseFloat(get3);
		
		document.forms["mainCart"][temp3].value = a - 1;
		document.forms["mainCart"][temp4].value = (b - c).toFixed(2);

		var s = (d - c).toFixed(2);
		document.getElementById("totalPrice").innerHTML = s;
	}
}

function rightButton(event){	
	var temp1 = "pr"+event.data.number;
	var temp2 = "price"+event.data.number;
	var temp3 = "hidden"+event.data.number;
	var temp4 = "hiddenprice"+event.data.number;
	
	var get = document.getElementById(temp1).innerHTML;
	var get2 = document.getElementById(temp2).innerHTML;
	
	var a = parseInt(get);
	var b = parseFloat(get2);
	var c = parseFloat(event.data.price);
	
	if(a < 100){
		document.getElementById(temp1).innerHTML = a + 1;
		document.getElementById(temp2).innerHTML = (b + c).toFixed(2);
		
		var get3 = document.getElementById("totalPrice").innerHTML;
		var d = parseFloat(get3);
		
		document.forms["mainCart"][temp3].value = a + 1;
		document.forms["mainCart"][temp4].value = (b + c).toFixed(2);

		var s = (d + c).toFixed(2);
		document.getElementById("totalPrice").innerHTML = s;
		
	}
}

function validate(){

	var firstname_indicator = new Boolean();
	var firstname=document.forms["cardForm"]["firstname"].value;
	
	if(firstname == null || firstname == ""){
		document.getElementById('firstnameerror').style.visibility='visible';
		firstname_indicator = false;
	}
	else{
		document.getElementById('firstnameerror').style.visibility='hidden';
		firstname_indicator = true;
	}
	
	var lastname_indicator = new Boolean();
	var lastname=document.forms["cardForm"]["lastname"].value;
	
	if(lastname == null || lastname == ""){
		document.getElementById('lastnameerror').style.visibility='visible';
		lastname_indicator = false;
	}
	else{
		document.getElementById('lastnameerror').style.visibility='hidden';
		lastname_indicator = true;
	}
	
	var cardnum_indicator = new Boolean();
	var cardnum=document.forms["cardForm"]["cardnum"].value;
	
	if(cardnum == null || cardnum == "" || cardnum.length != 16){
		document.getElementById('cardnumbererror').style.visibility='visible';
		cardnum_indicator = false;
	}
	else{
		document.getElementById('cardnumbererror').style.visibility='hidden';
		cardnum_indicator = true;
	}
	
	var date_indicator = new Boolean();
	var month=document.forms["cardForm"]["month"].value;
	var year=document.forms["cardForm"]["year"].value;
	
	if(month == "-" || year == "-"){
		document.getElementById('dateerror').style.visibility='visible';
		date_indicator = false;
	}
	else{
		document.getElementById('dateerror').style.visibility='hidden';
		date_indicator = true;
	}
	
	var csc_indicator = new Boolean();
	var csc=document.forms["cardForm"]["csc"].value;
	
	if(csc == null || csc == "" || csc.length != 3){
		document.getElementById('cscerror').style.visibility='visible';
		csc_indicator = false;
	}
	else{
		document.getElementById('cscerror').style.visibility='hidden';
		csc_indicator = true;
	}
	
	if(firstname_indicator == false || lastname_indicator == false || cardnum_indicator == false || date_indicator == false || csc_indicator == false){
		alert("Please check your details.");
		return false; 
	}
}	


$(document).ready(function(){
	
	$("#showCart").click(function(){
		$("#cartContainer").css("visibility","visible");
		$("body").css("overflow","hidden");
	});
	$("#showCart2").click(function(){
		$("#cartContainer").css("visibility","visible");
		$("body").css("overflow","hidden");
	});
	$("#closeButton").click(function(){
		$("#cartContainer").css("visibility","hidden");
		$("body").css("overflow","auto");
	});
	
	$("#product1").click(products[0],click);
	$("#product2").click(products[1],click);
	$("#product3").click(products[2],click);
	$("#product4").click(products[3],click);
	$("#product5").click(products[4],click);
	$("#product6").click(products[5],click);
	$("#product7").click(products[6],click);
	$("#product8").click(products[7],click);
	$("#product9").click(products[8],click);
	$("#product10").click(products[9],click);
	$("#product11").click(products[10],click);
	$("#product12").click(products[11],click);
	$("#product13").click(products[12],click);
	$("#product14").click(products[13],click);
	$("#product15").click(products[14],click);
	
	$("#m").click({number:1},selected);
	$("#v").click({number:2},selected);
	
	for(var i = 1; i < 16; i++){
		$("#products").on("click","#removeProduct" + i.toString(),{number: i.toString()},remove);
		$("#lb"+i.toString()).click(products[i-1],leftButton);
		$("#rb"+i.toString()).click(products[i-1],rightButton);
	}
	
	var get = document.getElementById("totalPrice").innerHTML;
	var newtotal = parseFloat(get);
	document.getElementById("totalPrice").innerHTML = newtotal.toFixed(2);
	
});


