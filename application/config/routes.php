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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/users'] = 'api/user/users'; // Example 1 (api/users)
$route['api/users/u_seq/(:num)'] = 'api/user/users/u_seq/$1'; // Example 3 (api/users/id/1)
$route['api/users/(:num)'] = 'api/user/users/u_seq/$1'; // Example 4 (api/users/1)
$route['api/users/u_seq/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/user/users/u_seq/$1/format/$3$4'; // Example 5 (api/users/id/1.xml)
$route['api/users/u_seq/(:num)/format/([a-zA-Z0-9_-]+)'] = 'api/user/users/u_seq/$1/format/$3$4'; // Example 6 (api/users/id/1/format/xml) -- not working
$route['api/users/u_seq/(:num)(\?)([a-zA-Z0-9_-]+)'] = 'api/user/users/u_seq/$1/format/$3$4'; // Example 7 (api/users/id/1?format=xml)
$route['api/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/user/users/id/$1/format/$3$4'; // Example 8 (api/users/1.xml)
$route['api/users(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/user/users/format/$3$4'; // Example 10 (api/users.html)
$route['api/users/format/([a-zA-Z0-9_-]+)(.*)'] = 'api/user/users/format/$3$4'; // Example 11 (api/users/format/html) -- not working
$route['api/users(\?format=)([a-zA-Z0-9_-]+)'] = 'api/user/users/format/$3$4'; // Example 12 (api/users/format=html)