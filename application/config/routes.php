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

$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = "Welcome";
$route['admin'] = "admin/dashboard";
$route['404_override'] = '';
$route['home'] = "site/home";
$route['home/(:any)'] = "site/home/$1";
$route['trainers/(:num)'] = "site/trainers/trainer/$1";


$route['my/dashboard'] = "my/my_dashboard";

/* General user */
$route['login'] = "my/my/login";
$route['enter'] = "my/my/enter";
$route['logout'] = "my/my/logout";
$route['my'] = "my/my";
$route['register'] = "my/my/register";
$route['signup'] = "my/my/signup";

/* Trainer specific */
$route['my/clients'] = "my/my/clients";
$route['my/clients/(:num)'] = "trainer/client/index/$1";
$route['my/clients/(:num)/plans'] = "trainer/plan_controller/index/$1";
$route['my/clients/plans/create'] = "trainer/plan_controller/create";
$route['my/clients/(:num)/plans/(:num)'] = "trainer/plan_controller/plan/$1/$2";
$route['my/clients/plans/add-exercise'] = "trainer/plan_controller/add_exercise";
$route['my/clients/plans/delete_exercise/(:num)'] = "trainer/plan_controller/delete_exercise/$1";

/* User training */
$route['my/training'] = "my/training/plans";
$route['my/training/plan/(:num)'] = "my/training/plan/$1";

$route['trainer/dashboard'] = "trainer/trainer_dashboard";
$route['trainer/client/(:num)'] = "trainer/client/progress/$1";
$route['trainer/client/(:num)/training-plan'] = "trainer/client_training_plan/index/$1";
$route['trainer/client/(:num)/training-plan/new'] = "trainer/client_training_plan/add/$1";
$route['trainer/client/(:num)/training-plan/insert'] = "trainer/client_training_plan/insert/$1";
$route['trainer/client/(:num)/training-plan/edit/(:num)'] = "trainer/client_training_plan/edit/$1/$2";
$route['trainer/training-plan/delete-exercise/(:num)'] = "trainer/client_training_plan/delete_exercise/$1";
$route['trainer/client/(:num)/training-plan/add-exercise/(:num)'] = "trainer/client_training_plan/add_exercise/$1/$2";

/* Specific to mobile only */
$route['trainer/client/(:num)/menu'] = 'trainer/client/menu/$1';