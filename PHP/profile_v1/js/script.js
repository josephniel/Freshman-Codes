function closeModal(){
	$('body').css('overflow','auto');
	$('#modal-container').hide();
		$('#project-3').hide();
		$('#project-4').hide();
		$('#project-5').hide();
}

function closeModalOuterClick(){
	$(document).mouseup(function(e){
		if(!$(".modal").is(e.target) && $(".modal").has(e.target).length === 0 && $("#modal-container").is(e.target)){
			closeModal();
		}
	});
}

$(function(){
	
	$(document).foundation({
		orbit: {
			animation: 'slide',
			bullets: false,
			timer: false,
			next_on_click: true
		}
	});
	
	$("#menu").stick_in_parent();
	$("#stick1").stick_in_parent({offset_top: 50});
	$("#stick2").stick_in_parent();
	$("#stick3").stick_in_parent({offset_top: 50});
	
	$('a[href^="#"]').on('click',function (e) {
		e.preventDefault();

		var target = this.hash;
		var $target = $(target);

		$('html, body').stop().animate({'scrollTop': $target.offset().top}, 900, 'swing', function () {
			window.location.hash = target;
		});
	});
	
	$('#project-3-button,#project-4-button,#project-5-button').on('click', function(){
		
		$('body').css('overflow', 'hidden');
		$('#modal-container').show();
		$id = "#" + $(this).attr('modal-link');
		$($id).slideDown('fast');
		
		closeModalOuterClick();
		
		$(window).trigger('resize');
	});
	
	$('.close-modal').on('click', function(){
		closeModal();
	});
	
});