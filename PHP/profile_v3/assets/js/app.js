$(function() {
    
    var handleLoadScreen = function() {
        
        var duration = "slow";
        var onComplete = function(){
                $( ".loader .preloader-wrapper" ).removeClass( "active" );
            }
        
        $( ".loader" )
            .delay( 800 )
            .fadeOut( duration, onComplete );
    }
    
    var animateInternalLink = function( e ) {

        e.preventDefault();

        var properties = { 
                'scrollTop': $( this.hash ).offset().top
            };
        var duration = 900;
        var easing = "swing";

        $( "body" )
            .stop()
            .animate( properties, duration, easing );
    }

    var onDisplayStateChange = function(){
        
        $( ".option" ).removeClass( "active" );
        
        var currentId = $( ".section" ).filter( function ( index ){
                
            var viewTop = $( window ).scrollTop();
            var elementTop = $( this ).offset().top;
            
            return viewTop > (elementTop - 1);
        }).last().attr( "id" );
        
        $( "#" + currentId + "Option" ).addClass( "active" );
    }

    $( window ).on({
        load: handleLoadScreen,
        scroll: onDisplayStateChange,
        resize: onDisplayStateChange
    });
    
    $('a[href^="#"]').on({ 
        click: animateInternalLink 
    });
    
    $('.button-collapse').sideNav();
    $('.tooltipped').tooltip();
    
});