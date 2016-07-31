function validate(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
  
	if(key != 13)
		key = String.fromCharCode(key);
	else
		key = 'enter';
 
	var regex = /[0-9]| |,/;
	
	if(key == 'enter'){
		return true;
	}
	else if( !regex.test(key)) {
		
		alert("Enter numeric values, commas, and spaces only!\n\nNote: spaces can also be used as separators");
		
		theEvent.returnValue = false;
		if(theEvent.preventDefault) 
			theEvent.preventDefault();
	} 
}
function check(){
	var input = document.forms["form"]["input"].value;
	
	if(input.indexOf("1") == -1 && input.indexOf("2") == -1 && input.indexOf("3") == -1 && input.indexOf("4") == -1 && input.indexOf("5") == -1 && input.indexOf("6") == -1 && input.indexOf("7") == -1 && input.indexOf("8") == -1 && input.indexOf("9") == -1 && input.indexOf("0") == -1 ){
		alert("Please enter a number!");
		return false;
	}
	
	var array;
	
	if(input.trim().indexOf(" ") >= 0)
		array = input.trim().split(" "); 
	else
		array = input.trim().split(",");
	
	for(var i = 0; i < array.length; ++i){
		if(parseInt(array[i]) > 1023){
			alert("There is an input larger than 1023");
			return false;
		}
	}
}
$(function(){
    var input = $('input[name="input"]'), defaulttext = input.attr('data-default');
    
    input.val(input.attr('data-default'));
    
    input.on('focus', function(){
        if(input.val() != defaulttext)
            input.addClass('typing');
        else
            input.removeClass('typing');
    }).on('keydown', function(){        
        if(defaulttext == input.val()) input.val('');
        input.addClass('typing');
    }).on('blur', function(){
        if(input.val() == '') input.val(defaulttext);
        that.removeClass('typing');
    });
	
	var $container = $('#tableContainer');
	$container.masonry({
		columnWidth: 500,
		gutterWidth: 100,
		itemSelector: '.item'
	});
	
});