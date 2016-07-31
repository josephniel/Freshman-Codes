( function(){

$('.section-header').stick_in_parent({offset_top: 1});
    
function onScroll(){
    return function(){
        $("#slide-out li.option").removeClass("active");
        var currentElement = $(".is_stuck:last").parent().attr("id");
        switch(currentElement){
            case "profile": $("#profileOption").addClass("active"); break;
            case "experience": $("#experienceOption").addClass("active"); break;
            case "projects": $("#projectsOption").addClass("active"); break;
            case "skills": $("#skillsOption").addClass("active"); break;
        }
    }
} 
    
$(window).on('resize scroll', onScroll()); 

$('.button-collapse').sideNav();
$('.tooltipped').tooltip();
$('.materialboxed').materialbox();
    
$('a[href^="#"]').on('click',function (e) {
    
    e.preventDefault();

    var target = this.hash;
    var $target = $(target);

    $('html, body').stop().animate({
        'scrollTop': $target.offset().top + 1
    }, 900, 'swing', function () {
        window.location.hash = target;
    });

});

$(window).load(function() {
	$(".loader").delay( 800 ).fadeOut("slow", function(){
        $(".loader .preloader-wrapper").removeClass("active");
    });
    
})
    
})();