<?php

    if( !$this->TAPT_Model->hasAssignCookie() || sizeof($cookie) == 0 ) :
        
        $array = array( "assignStep" => 1 );
        $this->TAPT_Model->setAssignCookie($array);
        $cookie = json_decode(json_encode($array));  // cookie is initialized in the controller
    
    endif;

    switch( $cookie->assignStep ) :
        
        case 1: 
            include_once('assign/upload_extracts.php');
            break;
        case 2:
            include_once('assign/assign_tickets.php');
            break;
        case 3:
            include_once('assign/process_tickets.php');
            break;
        default:
            break;

    endswitch;



/*
//Line Items tickets
$fileurl = base_url('assets/excel/Extracted Ordered Line Items.xlsx');

echo "<pre>";
print_r( $this->TAPT_Model->generateLineItemTicketArray( $fileurl ) );
echo "</pre>";

// Review tickets
$fileurl = base_url('assets/excel/Review Extract.xlsx');

echo "<pre>";
print_r( $this->TAPT_Model->generateReviewTicketArray( $fileurl ) );
echo "</pre>";

// call tickets
$fileurl = base_url('assets/excel/Extracted Ordered Myrequest.xlsx');

echo "<pre>";
print_r( $this->TAPT_Model->generateCallTicketArray( $fileurl ) );
echo "</pre>";
*/