<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// $route['admin'] = 'admin/dashboard';
// $route['login'] = 'admin/user/login';
// $route['logout'] = 'admin/user/logout';

// Logout
$route['logout'] = 'C_login/logout';
// Kehalaman Admin
$route['admin'] = 'v_login/admin/dashboard';
//Proses Login
$route['v_login'] = 'v_login/proseslogin';

$route['default_controller'] = 'C_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
