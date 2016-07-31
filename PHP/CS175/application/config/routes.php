<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'TAPT_Controller'; /* MODIFIED */
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/*
|-------------------------------------------------------------------------
| USER DEFINED ROUTES
| -------------------------------------------------------------------------
*/

$route['assign'] = 'TAPT_Controller/assignTickets';


$route['generate'] = 'TAPT_Controller/generateProductivityReport';


$route['admin'] = 'TAPT_Controller/adminPanel';

    $route['admin/edit_equations'] = 'TAPT_Controller/editEquations';
    $route['admin/manage_users_view'] = 'TAPT_Controller/viewUser'; // EDIT
    $route['admin/manage_users_add'] = 'TAPT_Controller/addUser';
    $route['admin/manage_admins_view'] = 'TAPT_Controller/viewAdmin';
    $route['admin/manage_admins_add'] = 'TAPT_Controller/addAdmin';
    $route['admin/logout'] = 'TAPT_Controller/logoutAdmin';

    $route['admin/process_edit_equation'] = 'TAPT_Controller/processEditEquation';
    $route['admin/process_add_admin'] = 'TAPT_Controller/processAddAdmin';
    $route['admin/process_delete_admin/(:any)'] = 'TAPT_Controller/processDeleteAdmin/$1';
    $route['admin/process_add_analyst'] = 'TAPT_Controller/processAddAnalyst';
    $route['admin/process_edit_analyst'] = 'TAPT_Controller/processEditAnalyst';
    $route['admin/process_delete_analyst/(:any)'] = 'TAPT_Controller/processDeleteAnalyst/$1';

    $route['assign/assign_analysts'] = 'TAPT_Controller/assignStepTwo';
    $route['assign/email_analysts'] = 'TAPT_Controller/assignStepThree';
    $route['assign/back_to_start'] = 'TAPT_Controller/assignReturnToOne';

    $route['generate/generate_prod'] = 'TAPT_Controller/generateStepTwo';
    $route['generate/back_to_start'] = 'TAPT_Controller/generateReturnToOne';

