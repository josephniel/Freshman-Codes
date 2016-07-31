<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TAPT_Model extends CI_Model {
	
    private $assign_array;
    private $email_config;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->email_config["smtp_host"] = 'ssl://smtp.mail.yahoo.com';
        $this->email_config["smtp_port"] = '465';
        $this->email_config["smtp_user"] = 'sample@yahoo.com';
        $this->email_config["smtp_pass"] = 'password';
        
        set_time_limit(0);
    }
    
/*
| ENCRYPTION FUNCTIONS
|
| encrypt( data, password, iv )
|   - custom encrypt function
|
| decrypt( data, password, iv )
|   - custom decrypt function
*/
    public function encrypt( $data, $password, $iv )
    {
        return openssl_encrypt($data, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv );
    }
    
    public function decrypt( $data, $password, $iv  )
    {
        return openssl_decrypt($data, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv );
    }
    
/*
| COOKIE FUNCTIONS
|
| getAdminCookie()
|   - gets the cookie value of "theAdminCookie" and returns an object
|
| setAdminCookie( array )
|   - sets the cookie value for "theAdminCookie"
|
| hasAdminCookie()
|   - returns a value if the main cookie "theAdminCookie" is initialized
| 
| deleteAdminCookie()
|   - deletes the "theAdminCookie"
| 
| constructAddAdminCookie()
|   - constucts the "addAdminCookie"
|
| constructAddAnalystCookie()
|   - constucts the "addAnalystCookie"
| 
| getAssignCookie()
|   - gets the cookie value of "theAssignCookie" and returns an object
|
| setAssignCookie( array )
|   - sets the cookie value for "theAssignCookie"
|
| hasAssignCookie()
|   - returns a value if the main cookie "theAssignCookie" is initialized
|
| getGenerateCookie()
|   - gets the cookie value of "theGenerateCookie" and returns an object
|
| setGenerateCookie( array )
|   - sets the cookie value for "theGenerateCookie"
|
| hasGenerateCookie()
|   - returns a value if the main cookie "theGenerateCookie" is initialized
| 
*/
    public function getAdminCookie()
    {
        $password = base64_encode(md5(date('l jS \of F Y')));
        $iv = substr(base64_encode(md5(date("Ymd"))),0,16);
        
        $unserialized_cookie = base64_decode(get_cookie("theAdminCookie"));
        $decrypted_cookie = $this->TAPT_Model->decrypt( $unserialized_cookie, $password, $iv );
        $cookie = json_decode($decrypted_cookie); 
        
        return $cookie;
    }
    
    public function setAdminCookie( $array )
    {
        $password = base64_encode(md5(date('l jS \of F Y')));
        $iv = substr(base64_encode(md5(date("Ymd"))),0,16);
        
        $json = json_encode( $array );
        $encrypted_cookie = $this->TAPT_Model->encrypt( $json, $password, $iv );
        $encoded_cookie = base64_encode($encrypted_cookie);
        set_cookie( "theAdminCookie", $encoded_cookie, (60*60*24) ); 
    }

    public function hasAdminCookie()
    {
        return (get_cookie("theAdminCookie")) ? true : false;
    }
    
    public function deleteAdminCookie()
    {
        delete_cookie("theAdminCookie");
    }
    
    public function constructAddAdminCookie()
    {
        $array["first_name"] = "";
        $array["last_name"] = "";
        $array["username"] = "";
        $array["password"] = "";
        $array["password_verify"] = "";
        
        return json_decode(json_encode($array));
    }
    
    public function constructAddAnalystCookie()
    {
        $array["first_name"] = "";
        $array["last_name"] = "";
        $array["dwng_id"] = "";
        $array["my_request_id"] = "";
        $array["email_address"] = "";
        
        return json_decode(json_encode($array));
    }

    public function getAssignCookie()
    {
        $password = base64_encode(md5(date('l jS \of F Y')));
        $iv = substr(base64_encode(md5(date("Ymd"))),0,16);
        
        $unserialized_cookie = base64_decode(get_cookie("theAssignCookie"));
        $decrypted_cookie = $this->TAPT_Model->decrypt( $unserialized_cookie, $password, $iv );
        $cookie = json_decode($decrypted_cookie); 
        
        return $cookie;
    }
    
    public function setAssignCookie( $array )
    {
        $password = base64_encode(md5(date('l jS \of F Y')));
        $iv = substr(base64_encode(md5(date("Ymd"))),0,16);
        
        $json = json_encode( $array );
        $encrypted_cookie = $this->TAPT_Model->encrypt( $json, $password, $iv );
        $encoded_cookie = base64_encode($encrypted_cookie);
        set_cookie( "theAssignCookie", $encoded_cookie, (60*60*24) ); 
    }

    public function hasAssignCookie()
    {
        return (get_cookie("theAssignCookie")) ? true : false;
    }
    
    public function deleteAssignCookie()
    {
        delete_cookie("theAssignCookie");
    }
    
    public function getGenerateCookie()
    {
        $password = base64_encode(md5(date('l jS \of F Y')));
        $iv = substr(base64_encode(md5(date("Ymd"))),0,16);
        
        $unserialized_cookie = base64_decode(get_cookie("theGenerateCookie"));
        $decrypted_cookie = $this->TAPT_Model->decrypt( $unserialized_cookie, $password, $iv );
        $cookie = json_decode($decrypted_cookie); 
        
        return $cookie;
    }
    
    public function setGenerateCookie( $array )
    {
        $password = base64_encode(md5(date('l jS \of F Y')));
        $iv = substr(base64_encode(md5(date("Ymd"))),0,16);
        
        $json = json_encode( $array );
        $encrypted_cookie = $this->TAPT_Model->encrypt( $json, $password, $iv );
        $encoded_cookie = base64_encode($encrypted_cookie);
        set_cookie( "theGenerateCookie", $encoded_cookie, (60*60*24) ); 
    }

    public function hasGenerateCookie()
    {
        return (get_cookie("theGenerateCookie")) ? true : false;
    }
    
    public function deleteGenerateCookie()
    {
        delete_cookie("theGenerateCookie");
    }
    
/*
| ADMIN ADD / VIEW FUNCTIONS
|
| getAdminList()
|   - gets the list of admins in the database
|
| getAdminPassword( admin )
|   - decrypts the encrypted password of the admins to be viewed in the view admins page by the superadmin
|
| setAdminPassword( admin )
|   - accepts an object with first_name, last_name, and password; returns encrypted password for the admin
|
| makeDeleteIdUri( id )
|   - abstracts the id of the admin in the database
|
| unmakeDeleteIdUri( id )
|   - returns the un-abstracted form of the id
| 
| insertNewAdmin( admin )
|   - inserts the admin object in the database
| 
| deleteAdmin( id )
|   - deletes the admin in thedatabase using the id
*/
    
	public function getAdminList()
    {
		$query = $this->db->get('admin');
		return $query->result();
    }   
        
    public function getAdminPassword( $admin )
    {
        $encrypt_password = base64_encode(md5($admin->first_name));
        $encrypt_iv = substr(base64_encode(md5($admin->last_name)),0,16);
        return $this->TAPT_Model->decrypt( base64_decode($admin->password), $encrypt_password, $encrypt_iv );
    }
    
    public function setAdminPassword( $admin )
    {
        $encrypt_password = base64_encode(md5($admin->first_name));
        $encrypt_iv = substr(base64_encode(md5($admin->last_name)),0,16);
        return base64_encode($this->TAPT_Model->encrypt( $admin->password, $encrypt_password, $encrypt_iv ));
    }
    
    public function makeDeleteIdUri( $id )
    {
        return urlencode(base64_encode($id));
    }
    
    public function unmakeDeleteIdUri( $id )
    {
        return base64_decode(urldecode($id));
    }
	
	public function insertNewAdmin( $admin )
    {
		$this->db->insert('admin', (array) $admin); 
	}
    
    public function deleteAdmin( $id )
    {
        $this->db->delete( 'admin', array( "id" => $id ) );
    }

/*
| ADMIN MANAGE PR FORMULA FUNCTIONS
|
| getEquationList()
|   - gets the list of equations in the database
|
| updateEquations( posts )
|   - updates the equation in the database using the submitted entries.
*/
    
    public function getEquationList()
    {
        $query = $this->db->get('equation');
		return $query->result();
    }
    
    public function updateEquations( $posts )
    {
        foreach( $posts as $key => $value ){
            $this->db->where( 'id', $key );
            $this->db->update( 'equation', array( "formula" => $value ) );
        }
        
    }
    
/*
| ADMIN ADD / DELETE / EDIT ANALYSTS FUNCTIONS
|
| getAnalystList()
|   - gets the list of analysts in the database
|
| insertNewAnalyst( admin )
|   - inserts the analyst object in the database
| 
| deleteAnalyst( id )
|   - deletes the analyst in thedatabase using the id
*/
    public function getAnalystList()
    {
        $query = $this->db->get('analyst');
        return $query->result();
    }

    public function insertNewAnalyst( $analyst )
    {
        $this->db->insert( 'analyst', (array) $analyst ); 
        
        $this->db->select( 'id' );
        $this->db->where( 'dwng_id', $analyst->dwng_id );
        $this->db->where( 'my_request_id', $analyst->my_request_id );
        $query = $this->db->get( 'analyst' );
        $id = $query->last_row()->id;
        
        $assign["id"] = $id;
        $assign["line_item"] = 0;
        $assign["review"] = 0;
        $assign["progress"] = 0;
        $assign["total"] = 0;
        
        $this->db->insert( 'assign', $assign );
        
        $productivity["id"] = $id;
        $assign["line_item"] = 0;
        $assign["review"] = 0;
        $assign["progress"] = 0;
        $assign["email"] = 0;
        $assign["bulk"] = 0;
        $assign["telephone"] = 0;
        $assign["install"] = 0;
        
        $this->db->insert( 'productivity', $productivity );
    }
    
    public function deleteAnalyst( $dwng_id )
    {
        $this->db->delete( 'analyst', array( "dwng_id" => $dwng_id ) );
    }
    
    public function updateAnalyst( $id, $row )
    {
        $this->db->set( "dwng_id", $row["dwng_id"] );    
        $this->db->set( "my_request_id", $row["my_request_id"] );    
        $this->db->set( "first_name", $row["first_name"] );    
        $this->db->set( "last_name", $row["last_name"] );    
        $this->db->set( "email_address", $row["email_address"] );   
        
        $this->db->where( 'id', $id );
        $this->db->update( 'analyst' );
    }
    
/*
| TICKET ASSIGNER FUNCTIONS
|
*/
    public function generateTicketArray( $fileUri, $type )
    {
        /* Open Excel App */
            $excel = new COM("Excel.Application");
        
        /* Open Excel File */
            $file = $excel->Workbooks->Open( $fileUri ) or Die("Did not open $filename $excel_file");
            $sheet = $file->Worksheets(1);
            $sheet->activate;
        
        /* Initialize array to store contents of the tickets */
            $tickets = array();
        
        /* Determine columns to get using the type of ticket */
            $array = array();
            if( $type == 1 ) : // LINE ITEM

                $rowCount = 2;
                $startColumn = "A";

                $array["A"] = "status";
                $array["B"] = "number";
                $array["C"] = "part_desc";
                $array["D"] = "assigned_dept";
                $array["G"] = "ordered_date";

            elseif( $type == 2 ) :  // REVIEW TICKET

                $rowCount = 1;
                $startColumn = "B";

                $array["B"] = "request_item_id";
                $array["C"] = "request_id";
                $array["F"] = "ordered_date";
                $array["N"] = "assigned_dept";

            else :

                $rowCount = 4;
                $startColumn = "B";

                $array["B"] = "request_item_id";
                $array["C"] = "request_id";
                $array["G"] = "end_progress_date";
                $array["P"] = "catalogue";
        
            endif;
        
        
        /* Loop through the file */
            $eof = false;
            while( !$eof ) :
                
                $ticket = array();
                foreach( $array as $key => $value ) :
        
                    $cell = $sheet->Range( $key . $rowCount );
                    $cell->activate;
                    $cell_value = $cell->value;

                    if( $cell_value == "" && $key == $startColumn ) :
                        $eof = true;
                        break;
                    endif;
        
                    $ticket[$value] = (string) $cell_value;
        
                endforeach;
                
                if( !$eof ) :
                    array_push($tickets, $ticket);
                    $rowCount++;
                endif;
            
            endwhile;
            
        /* closes the application */
            $excel->Quit();
            unset($excel);
        
        /* retuns an array */
            return $tickets;
    }
    
    public function moveExcelUpload( $input_name, $file_name, $type )
    {
        $ext = pathinfo( $_FILES[$input_name]['name'], PATHINFO_EXTENSION );
        $filename = "{$file_name}.{$ext}";
                
        $destination_path = getcwd() . "/assets/excel/{$type}/";
        $target_path = $destination_path . $filename;
        move_uploaded_file( $_FILES[$input_name]['tmp_name'], $target_path );
                
        return $target_path;
    }
    
    public function getLineItemTicketCount( $line_item )
    {
        return sizeof( $this->generateTicketArray( $line_item, 1 ) );
    }
    
    public function getReviewTicketCount( $review_ticket )
    {
        return sizeof( $this->generateTicketArray( $review_ticket, 2 ) );
    }
    
    public function getCallTicketCount( $call_ticket )
    {
        return sizeof( $this->generateTicketArray( $call_ticket, 3 ) );
    }
    
    public function getLineItemAssignArray()
    {
        $this->db->select( 'id, line_item' );
        $this->db->from( 'assign' );
        $this->db->order_by( 'line_item', 'asc' ); 
        $query = $this->db->get();
        $analysts = $query->result_array();
        
        $new_analysts = array();
        foreach( $analysts as $analyst ) :
        
            $this->db->select( 'dwng_id, first_name, last_name' );
            $this->db->where( 'id', $analyst["id"] );
            $query = $this->db->get( 'analyst' );
            $result = $query->last_row( 'array' );
        
            $analyst["dwng_id"] = $result["dwng_id"];
            $analyst["name"] = "{$result["first_name"]} {$result["last_name"]}";
            
            array_push( $new_analysts, $analyst );
        
        endforeach;
        
        return $new_analysts;
    }
    
    public function getReviewTicketAssignArray()
    {
        $this->db->select( 'id, review' );
        $this->db->from( 'assign' );
        $this->db->order_by( 'review', 'asc' ); 
        $query = $this->db->get();
        $analysts = $query->result_array();
        
        $new_analysts = array();
        foreach( $analysts as $analyst ) :
        
            $this->db->select( 'my_request_id, first_name, last_name' );
            $this->db->where( 'id', $analyst["id"] );
            $query = $this->db->get( 'analyst' );
            $result = $query->last_row( 'array' );
        
            $analyst["my_request_id"] = $result["my_request_id"];
            $analyst["name"] = "{$result["first_name"]} {$result["last_name"]}";
            
            array_push( $new_analysts, $analyst );
        
        endforeach;
        
        return $new_analysts;
    }
    
    public function getCallTicketAssignArray()
    {
        $this->db->select( 'id, progress' );
        $this->db->from( 'assign' );
        $this->db->order_by( 'progress', 'asc' ); 
        $query = $this->db->get();
        $analysts = $query->result_array();
        
        $new_analysts = array();
        foreach( $analysts as $analyst ) :
        
            $this->db->select( 'my_request_id, first_name, last_name' );
            $this->db->where( 'id', $analyst["id"] );
            $query = $this->db->get( 'analyst' );
            $result = $query->last_row( 'array' );
        
            $analyst["my_request_id"] = $result["my_request_id"];
            $analyst["name"] = "{$result["first_name"]} {$result["last_name"]}";
            
            array_push( $new_analysts, $analyst );
        
        endforeach;
        
        return $new_analysts;
    }
    
    public function assignTickets( $ticketValues, $cookie )
    {
        $ticketValues = $this->assignLineItem( $ticketValues, $cookie->lineItem );
        $ticketValues = $this->assignReviewTicket( $ticketValues, $cookie->reviewTicket );
        $ticketValues = $this->assignCallTicket( $ticketValues, $cookie->callTicket );
        
        $this->setAssignValuesToDatabase( $ticketValues );
        
        $final_array = $this->getAssignArray();
        
        $email_addresses = array();
        foreach( $final_array as $value ) :
            foreach( $value as $row ) :
                if( !array_key_exists( $row["analyst_id"], $email_addresses ) ) :
        
                    $this->db->select( 'email_address' );
                    $this->db->where( 'id', $row["analyst_id"] );
                    $query = $this->db->get( 'analyst' );
        
                    $email_addresses[$row["analyst_id"]] =  $query->last_row()->email_address;
        
                endif;
            endforeach;
        endforeach;
        
        $this->emailAssignedTickets( $final_array, $email_addresses );
    }
    
        private function setAssignValuesToDatabase( $array )
        {
            $query = $this->db->get('assign');
            $current = array();
            foreach( $query->result() as $row ) :
                $current[$row->id]["line_item"] = $row->line_item;
                $current[$row->id]["review"] = $row->review;
                $current[$row->id]["progress"] = $row->progress;
                $current[$row->id]["total"] = $row->total;
            endforeach;
            
            foreach( $array as $key => $row ) :
                
                $row["line_item"] += $current[$key]["line_item"];
                $row["review"] += $current[$key]["review"];
                $row["progress"] += $current[$key]["progress"];
                $total = $current[$key]["total"] + $row["line_item"] + $row["review"] + $row["progress"];
            
                $this->db->set( 'line_item', $row["line_item"] );
                $this->db->set( 'review', $row["review"] );
                $this->db->set( 'progress', $row["progress"] );
                $this->db->set( 'total', $total );
                $this->db->where( 'id', $key );
                $this->db->update( 'assign' );
            
                $this->db->set( 'review', $row["review"] );
                $this->db->where( 'id', $key );
                $this->db->update( 'productivity' );
            
            endforeach;
        }
    
        private function assignLineItem( $ticketValues, $lineItem )
        {
            $current_line_items = $this->getLineItemAssignArray();
            $line_items = $this->generateTicketArray( $lineItem, 1 );

            $temp_min_value = $current_line_items[0]["line_item"];
            $temp_max_value = $current_line_items[sizeof($current_line_items)-1]["line_item"];

            $x = 0;
            while( $x < sizeof($line_items) ) :    
                foreach( $current_line_items as $key => $analyst ) :

                    if( $x >= sizeof($line_items) ) :
                        break;
                    endif;

                    if( $ticketValues[$analyst["id"]]["current"] < $ticketValues[$analyst["id"]]["assigned"] ) :

                        $line_items[$x]["assigned_to"] = $analyst["dwng_id"];
                        $line_items[$x]["analyst"] = $analyst["name"];
                        $line_items[$x]["analyst_id"] = $analyst["id"];

                        $current_line_items[$key]["line_item"]++;
                        $ticketValues[$analyst["id"]]["current"]++;
                        $ticketValues[$analyst["id"]]["line_item"]++;

                        $x++;

                    endif;

                endforeach;
            endwhile;

            $this->assign_array["line_items"] = $line_items;

            return $ticketValues;
        }

        private function assignReviewTicket( $ticketValues, $reviewTicket )
        {
            $current_review_tickets = $this->TAPT_Model->getReviewTicketAssignArray();
            $review_tickets = $this->TAPT_Model->generateTicketArray( $reviewTicket, 2 );

            $temp_min_value = $current_review_tickets[0]["review"];
            $temp_max_value = $current_review_tickets[sizeof($current_review_tickets)-1]["review"];

            $x = 0;
            while( $x < sizeof($review_tickets) ) :    
                foreach( $current_review_tickets as $key => $analyst ) :

                    if( $x >= sizeof($review_tickets) ) :
                        break;
                    endif;

                    if( $ticketValues[$analyst["id"]]["current"] < $ticketValues[$analyst["id"]]["assigned"] ) :

                        $review_tickets[$x]["assigned_to"] = $analyst["my_request_id"];
                        $review_tickets[$x]["analyst"] = $analyst["name"];
                        $review_tickets[$x]["analyst_id"] = $analyst["id"];

                        $current_review_tickets[$key]["review"]++;
                        $ticketValues[$analyst["id"]]["current"]++;
                        $ticketValues[$analyst["id"]]["review"]++;

                        $x++;

                    endif;

                endforeach;
            endwhile;

            $this->assign_array["review"] = $review_tickets;

            return $ticketValues;
        }

        private function assignCallTicket( $ticketValues, $callTicket )
        {
            $current_call_tickets = $this->TAPT_Model->getCallTicketAssignArray();
            $call_tickets = $this->TAPT_Model->generateTicketArray( $callTicket, 3 );

            $temp_min_value = $current_call_tickets[0]["progress"];
            $temp_max_value = $current_call_tickets[sizeof($current_call_tickets)-1]["progress"];

            $x = 0;
            while( $x < sizeof($call_tickets) ) :    
                foreach( $current_call_tickets as $key => $analyst ) :

                    if( $x >= sizeof($call_tickets) ) :
                        break;
                    endif;

                    if( $ticketValues[$analyst["id"]]["current"] < $ticketValues[$analyst["id"]]["assigned"] ) :

                        $call_tickets[$x]["assigned_to"] = $analyst["my_request_id"];
                        $call_tickets[$x]["analyst"] = $analyst["name"];
                        $call_tickets[$x]["analyst_id"] = $analyst["id"];

                        $current_call_tickets[$key]["progress"]++;
                        $ticketValues[$analyst["id"]]["current"]++;
                        $ticketValues[$analyst["id"]]["progress"]++;

                        $x++;

                    endif;

                endforeach;
            endwhile;

            $this->assign_array["progress"] = $call_tickets;

            return $ticketValues;
        }
    
        private function emailAssignedTickets( $tickets, $email_addresses )
        {
            $html = $this->generateEmailHTML( $tickets );
            
            $this->load->library( 'email' );
    
            $config['protocol']     = 'smtp';
            $config['smtp_host']    = $this->email_config["smtp_host"];
            $config['smtp_port']    = $this->email_config["smtp_port"];
            $config['smtp_user']    = $this->email_config["smtp_user"];
            $config['smtp_pass']    = $this->email_config["smtp_pass"];
            $config['smtp_timeout'] = '100';
            $config['charset']      = 'utf-8';
            $config['newline']      = "\r\n";
            $config['mailtype']     = 'html';
            $config['validation']   = TRUE;  
            
            $this->email->initialize( $config );
            
            $this->email->from( $config['smtp_user'], 'Ticket Assigner' );
            $this->email->to( $email_addresses );
            
            $this->email->subject( 'Ticket Assignment' );
            $this->email->message( $html );

            $this->email->send();
            
            echo $this->email->print_debugger();
        }
            
            private function generateEmailHTML( $tickets )
            {
                $html = "<html>";
                $html .= "<head>";
                
                    $html .= "<style>";
                    
                    $html .= "th, td { padding:5px; border:1px solid #aaa; }";
                
                    $html .= "</style>";
                
                $html .= "</head>";
                $html .= "<body>";
                
                $html .= "<h1>Line Items</h1>";
                
                $html .= "<table style='width:1500px'>";
                    $html .= "<thead>";
                        $html .= "<tr>";
                            $html .= "<th>status</th>";
                            $html .= "<th>number</th>";
                            $html .= "<th style='width:300px;'>part_desc</th>";
                            $html .= "<th>assigned_dept</th>";
                            $html .= "<th>ordered_date</th>";
                            $html .= "<th>assigned_to</th>";
                            $html .= "<th style='width:200px;'>analyst</th>";
                        $html .= "</tr>";
                    $html .= "</thead>";
                    $html .= "<tbody>";
                
                    foreach( $tickets["line_items"] as $row ) :
                        $html .= "<tr>";
                            $html .= "<td>{$row["status"]}</td>";
                            $html .= "<td>{$row["number"]}</td>";
                            $html .= "<td>{$row["part_desc"]}</td>";
                            $html .= "<td>{$row["assigned_dept"]}</td>";
                            $html .= "<td>{$row["ordered_date"]}</td>";
                            $html .= "<td>{$row["assigned_to"]}</td>";
                            $html .= "<td>{$row["analyst"]}</td>";
                        $html .= "</tr>";
                    endforeach;
                
                    $html .= "</tbody>";
                $html .= "</table>";
                
                $html .= "<h1>Review Tickets</h1>";
                
                $html .= "<table style='width:1000px'>";
                    $html .= "<thead>";
                        $html .= "<tr>";
                            $html .= "<th>request_item_id</th>";
                            $html .= "<th>request_id</th>";
                            $html .= "<th>ordered_date</th>";
                            $html .= "<th>assigned_dept</th>";
                            $html .= "<th>assigned_to</th>";
                            $html .= "<th style='width:200px;'>analyst</th>";
                        $html .= "</tr>";
                    $html .= "</thead>";
                    $html .= "<tbody>";
                
                    foreach( $tickets["review"] as $row ) :
                        $html .= "<tr>";
                            $html .= "<td>{$row["request_item_id"]}</td>";
                            $html .= "<td>{$row["request_id"]}</td>";
                            $html .= "<td>{$row["ordered_date"]}</td>";
                            $html .= "<td>{$row["assigned_dept"]}</td>";
                            $html .= "<td>{$row["assigned_to"]}</td>";
                            $html .= "<td>{$row["analyst"]}</td>";
                        $html .= "</tr>";
                    endforeach;
                
                    $html .= "</tbody>";
                $html .= "</table>";
                
                $html .= "<h1>Progress Tickets</h1>";
                
                $html .= "<table style='width:1000px'>";
                    $html .= "<thead>";
                        $html .= "<tr>";
                            $html .= "<th>request_item_id</th>";
                            $html .= "<th>request_id</th>";
                            $html .= "<th>ordered_date</th>";
                            $html .= "<th>assigned_dept</th>";
                            $html .= "<th>assigned_to</th>";
                            $html .= "<th style='width:200px;'>analyst</th>";
                        $html .= "</tr>";
                    $html .= "</thead>";
                    $html .= "<tbody>";
                
                    foreach( $tickets["progress"] as $row ) :
                        $html .= "<tr>";
                            $html .= "<td>{$row["request_item_id"]}</td>";
                            $html .= "<td>{$row["request_id"]}</td>";
                            $html .= "<td>{$row["end_progress_date"]}</td>";
                            $html .= "<td>{$row["catalogue"]}</td>";
                            $html .= "<td>{$row["assigned_to"]}</td>";
                            $html .= "<td>{$row["analyst"]}</td>";
                        $html .= "</tr>";
                    endforeach;
                
                    $html .= "</tbody>";
                $html .= "</table>";
                
                $html .= "</body>";
                
                $html .= "</html>";
    
                return $html;   
            }
    
    public function getAssignArray()
    {
        $array = $this->assign_array;
        
        foreach( $array as $key => $value ) :
            for( $x = 0; $x < sizeof($value); $x++ ) :
                for( $y = $x + 1; $y < sizeof($value); $y++ ) :
                    if( strcmp( $array[$key][$x]["analyst"], $array[$key][$y]["analyst"]) > 0 ) :
                        $temp = $array[$key][$x];
                        $array[$key][$x] = $array[$key][$y];
                        $array[$key][$y] = $temp;
                    endif;
                endfor;
            endfor;
        endforeach;
        
        return $array;
    }
    
    public function getAnalystIds()
    {
        $this->db->select( 'id' );
        $query = $this->db->get( 'analyst' );
        
        return $query->result();
    }
    
    public function getAnalystNames()
    {
        $query = $this->db->get('analyst');
        
        $array = array();
        $keys = array();
        foreach( $query->result_array() as $key => $row ) :
        
            $array[$key]["id"] = $row["id"];
            $array[$key]["name"] = "{$row["first_name"]} {$row["last_name"]}";
            
            $this->db->select( 'total' );
            $this->db->where( 'id', $row["id"] );
            $query = $this->db->get( 'assign' );
        
            $array[$key]["total"] = (int) $query->last_row()->total;
        
            $keys[] = $key;
        
        endforeach;
        
        for( $x = 0; $x < sizeof($keys); $x++ ) :
            for( $y = $x + 1; $y < sizeof($keys); $y++ ) :
                if( $array[$keys[$x]]["total"] > $array[$keys[$y]]["total"] ) :
                    $temp = $array[$keys[$x]];
                    $array[$keys[$x]] = $array[$keys[$y]];
                    $array[$keys[$y]] = $temp;
                endif;
            endfor;
        endfor;
        
		return $array;
    }
    
    public function countCallTickets( $fileUri )
    {
        $analyst_list = $this->getAnalystList();

        /* Open Excel App */
            $excel = new COM("Excel.Application");
        
        /* Open Excel File */
            $file = $excel->Workbooks->Open( $fileUri ) or Die("Cannot open {$fileUri}");
            $sheet = $file->Worksheets(1);
            $sheet->activate;
        
        /* Initialize array to store contents of the tickets */
            $tickets = array();
        
        /* Determine columns to get using the type of ticket */
            $array = array();

                $rowCount = 2;
                $startColumn = "F";

                $array["F"] = "analyst";
                $array["O"] = "description";      
        
        /* Loop through the file */
            $eof = false;
            while( !$eof ) :
                
                $ticket = array();
                $recorded = false;
                $found = 0;
                $analyst = "";
                $analyst_id = 0;

                foreach( $array as $key => $value ) :

                    $cell = $sheet->Range( "A" . $rowCount );
                    $cell->activate;
                    $cell_value = $cell->value;

                    if( $cell_value == "" ) :
                        $eof = true;
                        break;
                    endif;

                    $cell = $sheet->Range( $key . $rowCount );
                    $cell->activate;
                    $cell_value = $cell->value;

                    if( $key == "F" ) :

                        //checks if the analyst is in the database
                        foreach( $analyst_list as $a ) :
                            if( strtolower($a->first_name . " " . $a->last_name) == strtolower($cell_value) ) :
                                $found = 1;
                                $analyst_id = $a->id;
                                break;
                            endif;
                        endforeach;
        
                        if($found == 0) :
                            break;
                        endif;
                        
                        //checks if analyst is already in the array
                        foreach( $tickets as $tick ) :
                            if ( $tick["analyst"] == $cell_value ) :
                                $recorded = true;
                                $analyst = $tick["analyst"];
                            endif;
                        endforeach;
        
                        if( $recorded == false ) :
                            $ticket["analyst"] = (string) $cell_value;
                        endif;

                    elseif($key == "O") :
        
                        $desc = explode("-", (string) $cell_value);
                        $type = strtolower($desc[0]);
                        $email = $bulk = $telephone = $install = $progress = 0;

                        if( strpos($type, "queries and feedback") != false ) :
                            $email++;
                        elseif( (strpos($type, "bulk request") != false) || (strpos($type, "multiple task") != false) ) :
                            $bulk++;
                        elseif( strpos($type, "batphone call") != false ) :
                            $telephone++;
                        elseif( strpos($type, "install unscripted software”") != false ) :
                            $install++;
                        else :
                            $progress++;
                        endif;

                        if( $recorded == true ) :
        
                            foreach( $tickets as $tick ) :
                                if ( $tick["analyst"] == $analyst ) :
        
                                    $tick["emails"] += $email;
                                    $tick["bulk"] += $bulk;
                                    $tick["telephone"] += $telephone;
                                    $tick["install"] += $install;
                                    $tick["progress"] += $progress;
        
                                endif;
                            endforeach;
        
                        else :
        
                            $ticket["id"] = $analyst_id;
                            $ticket["emails"] = $email;
                            $ticket["bulk"] = $bulk;
                            $ticket["telephone"] = $telephone;
                            $ticket["install"] = $install;
                            $ticket["progress"] = $progress;
        
                        endif;
                    endif;
    
                endforeach;
        
                if( !$eof ) :
                    if( $recorded == false && $found == 1) :
                        array_push($tickets, $ticket);
                    endif;
                    $rowCount++;
                endif;
            
            endwhile;
                
        /* closes the application */
            $excel->Quit();
            unset($excel);

        /* returns an array */
            $this->insertCallTicketCount( $tickets );
    }

    public function countLineItemTickets( $fileUri )
    {
        $analysts = $this->getAnalystList();
        
        foreach( $analysts as $analyst ) :
            $analyst->ticket_count = 0;
        endforeach;
        
        /* Open Excel App */
            $excel = new COM("Excel.Application");
        
        /* Open Excel File */
            $file = $excel->Workbooks->Open( $fileUri ) or Die("Cannot open {$fileUri}");
            $sheet = $file->Worksheets(1);
            $sheet->activate;
        
        /* Determine columns to get using the type of ticket */
            $rowCount = 2;
        
        /* Loop through the file */
            $eof = false;
            while( !$eof ) :
        
                $cell2 = $sheet->Range( "A" . $rowCount );
                $cell2->activate;
                $cell_value2 = $cell2->value;

                if( $cell_value2 == "" ):
        
                    $eof = true;
        
                else:
        
                    $cell = $sheet->Range( "E" . $rowCount );
                    $cell->activate;
                    $cell_value = $cell->value;
        
                    foreach( $analysts as $analyst ) :
                        if( $cell_value == $analyst->dwng_id ) :
                            $analyst->ticket_count++;
                            break;
                        endif;
                    endforeach;
    
                endif;
        
                $rowCount++;
        
            endwhile;
            
        /* closes the application */
            $excel->Quit();
            unset($excel);
        
        /* returns an array */
           $this->insertLineItemsCount( $analysts );
    }

    public function insertCallTicketCount( $tickets ){

        foreach( $tickets as $ticket ) :
            
            $this->db->where( 'id', $ticket['id'] );
            $query = $this->db->get('productivity');
            $row = $query->row();

            $array["progress"] = $row->progress + $ticket['progress'];
            $array["emails"] = $row->progress + $ticket['emails'];
            $array["bulk"] = $row->progress + $ticket['bulk'];
            $array["telephone"] = $row->progress + $ticket['telephone'];
            $array["install"] = $row->progress + $ticket['install'];

            $this->db->where( 'id', $row->id );
            $this->db->update( 'productivity', $array );

        endforeach;
    }

    public function insertLineItemsCount( $tickets )
    {
        foreach( $tickets as $ticket ) :
            if( $ticket->ticket_count > 0 ) :

                $this->db->where( 'id', $ticket->id );
                $query = $this->db->get( 'productivity' );
                $row = $query->row();

                $array["line_item"] = $row->line_item + $ticket->ticket_count;

                $this->db->where( 'id', $row->id );
                $this->db->update( 'productivity', $array );
                
            endif;
        endforeach;   
    }
    
    public function generateReport($fileName){
        
        $analyst_list = $this->getAnalystList();
        $equations = $this->getEquationList();
        $excel=new COM("Excel.Application");
        $excel->Workbooks->Add();
        $sheet = $excel->Workbooks[1]->Worksheets[1];
        $sheet->Name="Productivity Report";
        $i = 4;
        $h = 1;
		
        $sheet->Range("D1:J1")->Font->Bold = True;
		$sheet->Range("D1:J1")->Interior->Color= 10213316;
        $sheet->Range("D1:J1")->MergeCells = True;
		$sheet->Range("D1:J1")->HorizontalAlignment = -4108;
        $sheet->Range("D1:J1")->value = "RAW";
        
        $sheet->Range("K1:Q1")->Font->Bold = True;
		$sheet->Range("K1:Q1")->Interior->Color = 9737946;
        $sheet->Range("K1:Q1")->MergeCells = True;
		$sheet->Range("K1:Q1")->HorizontalAlignment = -4108;
        $sheet->Range("K1:Q1")->value = "# of TASK in MINUTES";
        
        $sheet->Range("F2:J2")->Font->Bold = True;
        $sheet->Range("F2:J2")->Interior->Color = 4072463;
		$sheet->Range("F2:J2")->Font->Color = 16777215;
        $sheet->Range("F2:J2")->MergeCells = True;
		$sheet->Range("F2:J2")->HorizontalAlignment = -4108;
        $sheet->Range("F2:J2")->value = "Call Tickets";
            
        $sheet->Range("M2:Q2")->Font->Bold = True;
        $sheet->Range("M2:Q2")->Interior->Color = 4072463;
		$sheet->Range("M2:Q2")->Font->Color = 16777215;
        $sheet->Range("M2:Q2")->MergeCells = True;
		$sheet->Range("M2:Q2")->HorizontalAlignment = -4108;
        $sheet->Range("M2:Q2")->value = "Call Tickets";
        
        $headers = array(
            "Global ID", 
            "DWNG Display Name", 
            "Analyst Name", 
            "Review", 
            "Line Item", 
            "MyRequest (Progress)", 
            "Emails", 
            "Bulk Request", 
            "Telephone", 
            "Install", 
            "Review", 
            "Line Item", 
            "MyRequest (Progress)", 
            "Emails", 
            "Bulk Request", 
            "Telephone", 
            "Install", 
            "Total Task", 
            "Working Days", 
            "Total Work in Minutes", 
            "MTD Prod", 
            "Raw Ticket Count", 
            "BIC"
        );
        
        foreach($headers as $head) :
            $cell=$sheet->Cells(3, $h);
            $cell->Interior->Color = 4072463;
			$cell->HorizontalAlignment = -4108;
			$cell->Font->Color = 16777215;
            $cell->Font->Bold = True;
            $cell->value = $head;
            $h++;
        endforeach;
        
		$sheet->Range("A3:A2")->MergeCells = True;
		$sheet->Range("A2:A3")->VerticalAlignment = -4108;
		$sheet->Range("B2:B3")->MergeCells = True;
		$sheet->Range("B2:B3")->VerticalAlignment = -4108;
		$sheet->Range("C2:C3")->MergeCells = True;
		$sheet->Range("C2:C3")->VerticalAlignment = -4108;
		$sheet->Range("D2:D3")->MergeCells = True;
		$sheet->Range("D2:D3")->VerticalAlignment = -4108;
		$sheet->Range("E2:E3")->MergeCells = True;
		$sheet->Range("E2:E3")->VerticalAlignment = -4108;
		$sheet->Range("K2:K3")->MergeCells = True;
		$sheet->Range("K2:K3")->VerticalAlignment = -4108;
		$sheet->Range("L2:L3")->MergeCells = True;
		$sheet->Range("L2:L3")->VerticalAlignment = -4108;
		$sheet->Range("R2:R3")->MergeCells = True;
		$sheet->Range("R2:R3")->VerticalAlignment = -4108;
		$sheet->Range("S2:S3")->MergeCells = True;
		$sheet->Range("S2:S3")->VerticalAlignment = -4108;
		$sheet->Range("T2:T3")->MergeCells = True;
		$sheet->Range("T2:T3")->VerticalAlignment = -4108;
		$sheet->Range("U2:U3")->MergeCells = True;
		$sheet->Range("U2:U3")->VerticalAlignment = -4108;
		$sheet->Range("V2:V3")->MergeCells = True;
		$sheet->Range("V2:V3")->VerticalAlignment = -4108;
		$sheet->Range("W2:W3")->MergeCells = True;
		$sheet->Range("W2:W3")->VerticalAlignment = -4108;
		
        $eqns = array();
        foreach($equations as $equation){
            $formula = str_replace(" ", "", $equation->formula);
            $eqns[$equation->id] = $formula;
        }
        
      foreach( $analyst_list as $analyst ) :
            $sheet->activate;
            $cell=$sheet->Cells($i, 1);
            $cell->activate;
            $cell->value = $analyst->dwng_id;
			$cell->HorizontalAlignment = -4108;
            
            $cell=$sheet->Cells($i, 2);
            $cell->activate;
            $dn = strtoupper($analyst->first_name . " " . $analyst->last_name);
            $cell->value = $dn;
			$cell->HorizontalAlignment = -4108;
            
            $cell=$sheet->Cells($i, 3);
            $cell->activate;
            $an = $analyst->last_name . " " . $analyst->first_name;
            $cell->value = $an;
            
            $this->db->where( 'id', $analyst->id );
            $query = $this->db->get('productivity');
            $row = $query->row();
            
            $cell=$sheet->Cells($i, 4);
            $cell->activate;
            $cell->value = $row->review;
			$cell->Interior->Color= 10213316;
        
            $cell=$sheet->Cells($i, 5);
            $cell->activate;
            $cell->value = $row->line_item;
			$cell->Interior->Color= 10213316;
            
            $cell=$sheet->Cells($i, 6);
            $cell->activate;
            $cell->value = $row->progress;
			$cell->Interior->Color= 10213316;
            
            $cell=$sheet->Cells($i, 7);
            $cell->activate;
            $cell->value = $row->emails;
			$cell->Interior->Color= 10213316;
            
            $cell=$sheet->Cells($i, 8);
            $cell->activate;
            $cell->value = $row->bulk;
			$cell->Interior->Color= 10213316;
            
            $cell=$sheet->Cells($i, 9);
            $cell->activate;
            $cell->value = $row->telephone;
			$cell->Interior->Color= 10213316;
            
            $cell=$sheet->Cells($i, 10);
            $cell->activate;
            $cell->value = $row->install;
			$cell->Interior->Color= 10213316;

            //K
            $multiplier = explode("*", $eqns["K"]);

            $cell=$sheet->Cells($i, 11);
            $cell->activate;
            $cell->value = "=".$multiplier[0].$i."*".$multiplier[1];
			$cell->Interior->Color = 9737946;

            //L
            $multiplier = explode("*", $eqns["L"]);

            $cell=$sheet->Cells($i, 12);
            $cell->activate;
            $cell->value = "=".$multiplier[0].$i."*".$multiplier[1];
            $cell->Interior->Color = 9737946;

            //M
            $multiplier = explode("*", $eqns["M"]);

            $cell=$sheet->Cells($i, 13);
            $cell->activate;
            $cell->value = "=".$multiplier[0].$i."*".$multiplier[1];
			$cell->Interior->Color = 9737946;

            //N
            $multiplier = explode("*", $eqns["N"]);

            $cell=$sheet->Cells($i, 14);
            $cell->activate;
            $cell->value = "=".$multiplier[0].$i."*".$multiplier[1];
			$cell->Interior->Color = 9737946;

            //O
            $multiplier = explode("*", $eqns["O"]);

            $cell=$sheet->Cells($i, 15);
            $cell->activate;
            $cell->value = "=".$multiplier[0].$i."*".$multiplier[1];
			$cell->Interior->Color = 9737946;

            //P
            $multiplier = explode("*", $eqns["P"]);

            $cell=$sheet->Cells($i, 16);
            $cell->activate;
            $cell->value = "=".$multiplier[0].$i."*".$multiplier[1];
			$cell->Interior->Color = 9737946;

            //Q
            $multiplier = explode("*", $eqns["Q"]);

            $cell=$sheet->Cells($i, 17);
            $cell->activate;
            $cell->value = "=".$multiplier[0].$i."*".$multiplier[1];
			$cell->Interior->Color = 9737946;

            //R
            $cell=$sheet->Cells($i, 18);
            $cell->activate;
            $cell->value = "=SUM(K".$i.":Q".$i.")";
			$cell->Interior->Color = 15853276;

            //S 
            $cell=$sheet->Cells($i, 19);
            $cell->activate;
            $cell->value = 1;
			$cell->Interior->ColorIndex = 36;

            //T
            $first = substr($eqns["T"], 0, 4) . $i . "*";
            $second = $first . substr($eqns["T"],5);

            $cell=$sheet->Cells($i, 20);
            $cell->activate;
            $cell->value = "=".$second;
			$cell->Interior->Color = 15853276;

            //U
            $cell=$sheet->Cells($i, 21);
            $cell->activate;
            $cell->value = "=R".$i."/T".$i;
			$cell->Interior->Color = 15853276;

            //V
            $divisor = explode("/", $eqns["V"]);
            $f = explode(")", $divisor[1]);
            $first = $f[0];
            $s = explode(")", $divisor[2]);
            $second = $s[0];

            $cell=$sheet->Cells($i, 22);
            $cell->activate;
            $cell->value = "=SUM(E".$i.":G".$i.",I".$i.":J".$i.")+(H".$i."/".$second.")+(D".$i."/".$first.")"; 
			$cell->Interior->Color = 15853276;

            //W 
            $cell=$sheet->Cells($i, 23);
            $cell->activate;
            $cell->value = "=V".$i."/S".$i;
			$cell->Interior->Color = 15853276;

            $i++;

        endforeach;
        
		$sheet->Range("A4:W" . ($i-1))->BORDERS->Weight = 2;
        $sheet->Range("A2:W3")->BORDERS(7)->Weight = 2;
		$sheet->Range("A2:W3")->BORDERS(8)->Weight = 2;
		$sheet->Range("A2:W3")->BORDERS(9)->Weight = 2;
		$sheet->Range("A2:W3")->BORDERS(10)->Weight = 2;
		
		$sheet->Range("A1:W100")->EntireColumn->AutoFit;
        
        $sheet->Range("D4")->activate;
        $excel->ActiveWindow->FreezePanes = True;
        
        $excel->Workbooks[1]->SaveAs('Productivity Report_' . $fileName . '.xlsx');
        $excel->Workbooks[1]->Close(false);
        $excel->Workbooks->Close();
        $excel->Quit();
        unset($excel);        
    }
    
	public function getProductivity()
    {
        $query = $this->db->get('productivity');
		return $query->result();
    }
    
}
