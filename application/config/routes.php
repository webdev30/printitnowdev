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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'home';	//'welcome';


$route['index.php'] = 'home';
$route['print'] = 'home/printIt';
$route['confirm_order'] = 'home/confirm_order';
$route['review'] = 'home/review';
$route['thank-you'] = 'home/thankyou';

# Vendor Url
$route['login'] = 'home/login';
$route['logout'] = 'home/logout';
$route['vendor'] = 'dashboard/vendordashboard';
$route['forget-password'] = 'ajax/forgetpass';
$route['reset/(:any)'] = 'home/login/$1';
$route['get-order-details'] = 'dashboard/getOrderDetails';
$route['update-order-status'] = 'dashboard/updateOrderStatus';
$route['track-files'] = 'dashboard/trackFiles';
$route['order-history'] = 'dashboard/orderHistory';	
$route['profile'] = 'dashboard/profile';
$route['update-password'] = 'dashboard/updatePassword';

# Admin Url
$route['adminpanel'] = 'adminpanel';
$route['admin-board'] = 'adminpanel/admindashboard';
$route['adminpanel/order-history'] = 'adminpanel/orderHistory';
$route['adminpanel/get-order-details'] = 'dashboard/getOrderDetails';
$route['adminpanel/logout'] = 'adminpanel/logout';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
