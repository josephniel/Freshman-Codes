<?php
    
    if( !$this->TAPT_Model->hasAdminCookie() || sizeof($cookie) == 0  ) :

        $array = array( "isLoggedIn" => 0 );
        $this->TAPT_Model->setAdminCookie($array);
        $cookie = json_decode(json_encode($array)); // cookie is initialized in the controller
    
    endif;
    
	if( $_SERVER['REQUEST_METHOD'] == 'POST' && $cookie->isLoggedIn == 0 ) :         
        
		$username = $_POST['admin_username'];
		$password = $_POST['admin_password'];
        
		foreach( $admin_list as $admin ) :
            if( $admin->username === $username && $admin->password === $password ) :
                
                $array = 
                    array(
                        "isLoggedIn" => 1,
                        "adminPageType" => 0,
                        "adminType" => $admin->type,
                        "adminName" => "{$admin->first_name} {$admin->last_name}",
                        "addAdminAlert" => 0,
                        "addAnalystAlert" => 0,
                        "editEquationAlert" => 0
                    );
                
                $this->TAPT_Model->setAdminCookie($array);
                redirect( base_url('admin') );
			endif;
		endforeach;

	endif;
    
    if ( !!$cookie->isLoggedIn ) : 
        include_once('admin/admin_homepage.php');
    else :  
        include_once('admin/login_page.php');
    endif;