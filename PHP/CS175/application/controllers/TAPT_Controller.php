<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TAPT_Controller extends CI_Controller {
    
    private $adminCookie;
    private $addAdminCookie;
    private $addAnalystCookie;
    
    private $assignCookie;
    private $generateCookie;
    
    public function __construct()
    {
        parent::__construct();
        
        if( $this->TAPT_Model->hasAdminCookie() ) :
            $this->adminCookie = $this->TAPT_Model->getAdminCookie();
            $this->addAdminCookie = $this->TAPT_Model->constructAddAdminCookie();
            $this->addAnalystCookie = $this->TAPT_Model->constructAddAnalystCookie();
        endif;
        
        if( $this->TAPT_Model->hasAssignCookie() ) :
            $this->assignCookie = $this->TAPT_Model->getAssignCookie();
        endif;
        
        if( $this->TAPT_Model->hasGenerateCookie() ) :
            $this->generateCookie = $this->TAPT_Model->getGenerateCookie();
        endif;
    }
    
	public function index()
	{
        $this->assignTickets();
	}
    
/*
| ASSIGN TICKET CONTROLLERS
|
*/
    public function assignTickets()
    {
        $data["activeTab"] = 1;
        $data["content"] = "contents/assign.php";
        $data["cookie"] = $this->assignCookie;
        
        $data["analysts"] = $this->TAPT_Model->getAnalystNames();
        
        $this->load->view( 'mainpage.php', $data );
    }
    
        public function assignStepTwo()
        {   
            $date_time = date( "YmdHis" );
            
            $cookie = $this->TAPT_Model->getAssignCookie();
            
            $cookie->assignStep = 2;
            
            $cookie->lineItem = 
                $this->TAPT_Model->moveExcelUpload( 
                    'line-item-input', 
                    $date_time, 
                    'line-item' 
                );
            $cookie->reviewTicket = 
                $this->TAPT_Model->moveExcelUpload( 
                    'review-ticket-input', 
                    $date_time, 
                    'review-ticket' 
                );
            $cookie->callTicket = 
                $this->TAPT_Model->moveExcelUpload( 
                    'call-ticket-input', 
                    $date_time, 
                    'call-ticket' 
                );
            
            $cookie->lineItemCount = 
                $this->TAPT_Model->getLineItemTicketCount( $cookie->lineItem );
            $cookie->reviewTicketCount = 
                $this->TAPT_Model->getReviewTicketCount( $cookie->reviewTicket );
            $cookie->callTicketCount = 
                $this->TAPT_Model->getCallTicketCount( $cookie->callTicket );
            
            $cookie->totalTicketCount = 
                $cookie->lineItemCount + $cookie->reviewTicketCount + $cookie->callTicketCount;
            $cookie->initialTicketCount = 
                (int) ($cookie->totalTicketCount / sizeof($this->TAPT_Model->getAnalystNames()));
            $cookie->totalAssignedTicket = 
                $cookie->initialTicketCount * sizeof($this->TAPT_Model->getAnalystNames());
            
            $this->TAPT_Model->setAssignCookie( $cookie );
            
            redirect( base_url( 'assign' ) );
        }
    
        public function assignStepThree()
        {
            $analysts = $this->TAPT_Model->getAnalystIds();
            
            $ticketValues = array();
            foreach( $analysts as $analyst ) :
                $ticketValues[$analyst->id]["assigned"] = $this->input->post("{$analyst->id}ticketCount");
                $ticketValues[$analyst->id]["current"] = 0;
                $ticketValues[$analyst->id]["line_item"] = 0;
                $ticketValues[$analyst->id]["review"] = 0;
                $ticketValues[$analyst->id]["progress"] = 0;
            endforeach;
            
            $cookie = $this->TAPT_Model->getAssignCookie();
            
            $cookie->assignStep = 3;
            
            $this->TAPT_Model->setAssignCookie( $cookie );
            
            $this->TAPT_Model->assignTickets( $ticketValues, $cookie );
            
            redirect( base_url( 'assign' ) );
        }
    
        public function assignReturnToOne()
        {
            $cookie = $this->TAPT_Model->getAssignCookie();
            
            $cookie->assignStep = 1;
            
            $this->TAPT_Model->setAssignCookie( $cookie );
            
            redirect( base_url( 'assign' ) );
        }
    
/*
| GENERATE PR REPORT CONTROLLERS
|
*/
    public function generateProductivityReport()
    {
        $data["activeTab"] = 2;
        $data["content"] = "contents/generate.php";
        $data["cookie"] = $this->generateCookie;
        
        $this->load->view( 'mainpage.php', $data );
    }
    
        public function generateStepTwo()
        {   
            $date_time = date( "YmdHis" );

            $array = (array) $this->TAPT_Model->getGenerateCookie();
            
            $array['generateStep'] = 2;
            
            $array['lineItem'] = 
                $this->TAPT_Model->moveExcelUpload( 
                    'line-item-input', 
                    $date_time, 
                    'line-item' 
                );
           
            $array['callTicket'] = 
                $this->TAPT_Model->moveExcelUpload( 
                    'call-ticket-input', 
                    $date_time, 
                    'call-ticket' 
                );

            $this->TAPT_Model->countLineItemTickets( $array["lineItem"] );
            $this->TAPT_Model->countCallTickets( $array["callTicket"] );
            
            $this->TAPT_Model->generateReport($date_time);

            $this->TAPT_Model->setGenerateCookie( $array );
            redirect( base_url( 'generate' ) );
        }
    
        public function generateReturnToOne()
        {
            $cookie = $this->TAPT_Model->getGenerateCookie();
            
            $cookie->generateStep = 1;
            
            $this->TAPT_Model->setGenerateCookie( $cookie );
            
            redirect( base_url( 'generate' ) );   
        }
    
/*
| ADMIN PANEL CONTROLLERS
|
| adminPanel()
|   - the main controller of the page where internal routing is executed 
|     using cookie manipulation. All necessary admin data is loaded here. 
|     An improvement in the future version would be the selective loading
|     of the data, where only the necessary data are loaded in the page.
|
| adminPageRouter()
|   - the controller where the cookie values are changed based on the 
|     current page selected by the user.
|
| editEquations()
| manageUsers()
| viewAdmin()
| addAdmin()
|   - the direct link of the controller from the router; this approach is 
|     prefered over the direct parameter passing in the controller by the 
|     developer because of readability factors.
|
| logoutAdmin()
|   - logs out the admin in the admin panel
|
| processAddAdmin()
|   - processes the adding of new admin; includes the proper validation for
|     adding admins.
| 
| processDeleteAdmin()
|   - processes the deletion of the admin in the database.
|  
| processAddAnalyst()
|   - processes the adding of new analyst; includes the proper validation for
|     adding analysts.
| 
| processDeleteAnalyst()
|   - processes the deletion of the analyst in the database.
|   - 
| processEditEquation()
|   - processes the editing of the equations.
*/
    public function adminPanel()
    {
        $data["activeTab"] = 3;
        $data["content"] = "contents/admin.php";
        $data["cookie"] = $this->adminCookie;
        
        /*
        * Creates an equation list from the database to be shown and
        * edited in the Edit Formula page pf the admin panel
        */
            $equation_list = array();
            foreach( $this->TAPT_Model->getEquationList() as $equation ) :
                $equation_list = array_merge( $equation_list, array( $equation->id => $equation->formula ) );
            endforeach;
            $data["equation_list"] = $equation_list;
        
        /* 
        * Creates the admin list with the decrypted password and an
        * "encrypted" id for the delete function in the View Admin Page
        */
            $admins = $this->TAPT_Model->getAdminList();
            foreach( $admins as $admin ) :
                $admin->deleteUri = $this->TAPT_Model->makeDeleteIdUri( $admin->id );
                $admin->password = $this->TAPT_Model->getAdminPassword( $admin );
            endforeach;
            $data["admin_list"] = $admins;

        /* 
        * Creates the admin list with the decrypted password and an
        * "encrypted" id for the delete function in the View Admin Page
        */
            $data["analyst_list"] = $this->TAPT_Model->getAnalystList();
        
        /* load the view of the admin using the data */
		  $this->load->view( 'mainpage.php', $data );
    }
	
        public function editEquations() { $this->adminPageRouter(0); }
        public function viewUser() { $this->adminPageRouter(1); }
        public function addUser() { $this->adminPageRouter(4); }
        public function viewAdmin() { $this->adminPageRouter(2); }
        public function addAdmin() { $this->adminPageRouter(3); }
    
        private function adminPageRouter( $pageType )
        {
            /*
            * Checks if the current page is the Edit Formula page.
            * If it is not the page, then do not show the alert 
            * for the Edit Formula page
            */
                if ( $pageType != 0 ) :
                    $this->adminCookie->editEquationAlert = 0;
                endif;
            
            /*
            * Checks if the current page is in the Add Admin page.
            * If it is not the page, then do not show the alert
            * for the Add Admin page. Else, create a cookie for the
            * add admin page to be used when adding a new admin.
            */
                if ( $pageType != 3 ) :
                    $this->adminCookie->addAdminAlert = 0;
                else :
                    set_cookie( 
                        "addAdminCookie", 
                        base64_encode(json_encode($this->addAdminCookie)), (60*60*24) 
                    );
                endif;
            
            /*
            * Checks if the current page is in the Add Analyst page.
            * If it is not the page, then do not show the alert
            * for the Add Analyst page. Else, create a cookie for the
            * add analyst page to be used when adding a new analyst.
            */
                if ( $pageType != 4 ) :
                    $this->adminCookie->addAnalystAlert = 0;
                else :
                    set_cookie(
                        "addAnalystCookie",
                        base64_encode(json_encode($this->addAnalystCookie)), (60*60*24)
                    );
                endif;
            
            $this->adminCookie->adminPageType = $pageType;
            $this->TAPT_Model->setAdminCookie( (array) $this->adminCookie );
            
            /* Redirect the page after setting the cookie configuration for the page */
                redirect( base_url('admin') );
        }

        public function logoutAdmin()
        {
            $this->TAPT_Model->deleteAdminCookie();
            redirect(base_url('admin'));
        }
    
    public function processEditEquation()
    {
        /* RETRIEVES THE POST VALUES WITH NAMES IN THE ARRAY AND STORES IT IN AN ARRAY */
        $posts = array();
        foreach( array( "K", "L", "M", "N", "O", "P", "Q", "R", "T", "U", "V", "W" ) as $value ) :
            $posts = array_merge( $posts, array( $value => $this->input->post($value) ) );
        endforeach;
        
        $this->TAPT_Model->updateEquations( $posts );
        
        $this->adminCookie->editEquationAlert = 1; // SETTING OF COOKIE IS DONE BEFORE ROUTING IN ADMIN ROUTER 
        $this->editEquations(); // ROUTES BACK TO THE EDIT FORMULA PAGE WITH THE ALERT TYPE 1
    }
    
    public function processAddAdmin()
    {
        $first_name = $this->input->post('new_admin_first_name');
        $last_name = $this->input->post('new_admin_last_name');
        $username = $this->input->post('new_admin_username');
        $password = $this->input->post('new_admin_password');
        $password_verify = $this->input->post('new_admin_checker_password');

        $this->addAdminCookie->first_name = $first_name;
        $this->addAdminCookie->last_name = $last_name;
        
        if( strlen($username) < 6) :
            $this->adminCookie->addAdminAlert = 4; // SETTING OF COOKIE IS DONE BEFORE ROUTING IN ADMIN ROUTER
            $this->addAdmin(); // ROUTES BACK TO THE ADD ADMIN PAGE WITH THE ALERT TYPE 4
        endif;
        
        $this->addAdminCookie->username = $username;
        
        if( strlen($password) < 6 ||  strlen($password_verify) < 6 ) :
            $this->adminCookie->addAdminAlert = 5; // SETTING OF COOKIE IS DONE BEFORE ROUTING IN ADMIN ROUTER
            $this->addAdmin(); // ROUTES BACK TO THE ADD ADMIN PAGE WITH THE ALERT TYPE 5
        endif;
        
        $this->addAdminCookie->password = $password;
        $this->addAdminCookie->password_verify = $password_verify;
        
        if( $password === $password_verify ) :

            $in_database = false;
            foreach( $this->TAPT_Model->getAdminList() as $admin ) :
                if( $admin->username == $username ) :
                    $in_database = true;
                    break;
                endif;
            endforeach;

            if( !$in_database ) :

                $array["first_name"] = $first_name;
                $array["last_name"] = $last_name;
                $array["password"] = $password;
                $array["username"] = $username;
        
                $admin = json_decode( json_encode( $array ) );
        
                $admin->password = $this->TAPT_Model->setAdminPassword( $admin );
        
                $this->TAPT_Model->insertNewAdmin( $admin );
                
                $this->adminCookie->addAdminAlert = 0; // SETTING OF COOKIE IS DONE BEFORE ROUTING IN ADMIN ROUTER
                $this->viewAdmin(); // ROUTES BACK TO THE VIEW ADMIN PAGE WITH THE ALERT TYPE 0
        
            else :
                $this->adminCookie->addAdminAlert = 2; // SETTING OF COOKIE IS DONE BEFORE ROUTING IN ADMIN ROUTER
                $this->addAdmin(); // ROUTES BACK TO THE ADD ADMIN PAGE WITH THE ALERT TYPE 2
            endif;
        
        else :
            $this->adminCookie->addAdminAlert = 1; // SETTING OF COOKIE IS DONE BEFORE ROUTING IN ADMIN ROUTER
            $this->addAdmin(); // ROUTES BACK TO THE ADD ADMIN PAGE WITH THE ALERT TYPE 1
        endif;
    }
    
    public function processDeleteAdmin( $encrypted_id )
    {
        $this->TAPT_Model->deleteAdmin( $this->TAPT_Model->unmakeDeleteIdUri( $encrypted_id ) );
        $this->viewAdmin();
    }
    
    public function processAddAnalyst()
    {
        $first_name = $this->input->post('new_analyst_first_name');
        $last_name = $this->input->post('new_analyst_last_name');
        $dwng_id = $this->input->post('new_analyst_dwng_id');
        $my_request_id = $this->input->post('new_analyst_my_request_id');
        $email_address = $this->input->post('new_analyst_email');

        $this->addAnalystCookie->first_name = $first_name;
        $this->addAnalystCookie->last_name = $last_name;

        if( strlen($dwng_id) != 6) :
            $this->adminCookie->addAnalystAlert = 1; // SETTING OF COOKIE IS DONE BEFORE ROUTING IN ADMIN ROUTER
            $this->addUser();
        endif;
        
        $this->addAnalystCookie->dwng_id = $dwng_id;
        $this->addAnalystCookie->my_request_id = $my_request_id;
    
        $in_database = false;
        foreach( $this->TAPT_Model->getAnalystList() as $analyst ) :
            if( $analyst->dwng_id == $dwng_id || $analyst->my_request_id == $my_request_id) :
                $in_database = true;
                break;
            endif;
        endforeach;

        if( !$in_database ) :
                
            $array["first_name"] = $first_name;
            $array["last_name"] = $last_name;
            $array["dwng_id"] = $dwng_id;
            $array["my_request_id"] = $my_request_id;
            $array["email_address"] = $email_address;
        
            $analyst = json_decode( json_encode( $array ) );
        
            $this->TAPT_Model->insertNewAnalyst( $analyst );
                
            $this->adminCookie->addAnalystAlert = 0; // SETTING OF COOKIE IS DONE BEFORE ROUTING IN ADMIN ROUTER
            $this->viewUser();
        
        else :  
            $this->adminCookie->addAnalystAlert = 2; // SETTING OF COOKIE IS DONE BEFORE ROUTING IN ADMIN ROUTER
            $this->addUser();
        endif;
    }
    
    public function processEditAnalyst()
    {
        $analysts = $this->TAPT_Model->getAnalystList();
        
        $form_names = array();
        $counter = 1;
        foreach( $analysts as $analyst ) :
            
            $id = $analyst->id;
        
            $user_row = array();
        
            $user_row["first_name"] = $this->input->post( "{$id}-first_name" );
            $user_row["last_name"] = $this->input->post( "{$id}-last_name" );
            $user_row["dwng_id"] = $this->input->post( "{$id}-dwng_id" );
            $user_row["my_request_id"] = $this->input->post( "{$id}-my_request_id" );
            $user_row["email_address"] = $this->input->post( "{$id}-email_address" );
        
            $this->TAPT_Model->updateAnalyst( $id, $user_row );
        
        endforeach;
        $this->viewUser();
    }

    public function processDeleteAnalyst( $id )
    {
        $this->TAPT_Model->deleteAnalyst( $id );
        $this->viewUser();
    }
    
}
