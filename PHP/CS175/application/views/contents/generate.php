<?php

    if( !$this->TAPT_Model->hasGenerateCookie() || sizeof($cookie) == 0 ) :
        
        $array = array( "generateStep" => 1 );
        $this->TAPT_Model->setGenerateCookie( $array );
        $cookie = json_decode( json_encode( $array ) );  // cookie is initialized in the controller
    
    endif;

    switch( $cookie->generateStep ) :
        
        case 1: 
            include_once('generate/upload_extracts.php');
            break;
        case 2:
            include_once('generate/generate_productivity.php');
            break;
        case 3:
            include_once('generate/process_tickets.php');
            break;
        default:
            break;

    endswitch;