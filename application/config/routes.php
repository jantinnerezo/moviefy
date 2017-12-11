<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//User routes
$route['login'] = 'users/login';
$route['register'] = 'users/register';
$route['logout'] = 'users/logout';
$route['movies'] = 'users/all_movies';
$route['about'] = 'users/about';
$route['profile'] = 'users/profile';
$route['reservation_view'] = 'users/reservations_view';
$route['user/reservations/client_reservation/(:any)'] = 'users/client_reservation/$1';
$route['registration/confirmation/(:any)'] = 'users/confirm_email/$1';

// Admin routes
$route['admin'] = 'admin/accounts';

// Accounts
$route['admin/accounts'] = 'admin/accounts';
$route['accounts/confirm'] = 'user/confirm_email';
$route['admin/accounts/edit_account'] = 'admin/edit_account';
$route['admin/accounts/remove_account'] = 'admin/remove_account';
$route['admin/accounts/verify_account'] = 'admin/verify_account';

// Movies
$route['admin/movies'] = 'admin/movies';
$route['admin/movies/edit_movie'] = 'admin/edit_movie';
$route['admin/movies/remove_movie'] = 'admin/remove_movie';

// Rooms
$route['admin/rooms'] = 'admin/rooms';
$route['admin/rooms/edit_room'] = 'admin/edit_room';
$route['admin/rooms/remove_room'] = 'admin/remove_room';

// Slideshows
$route['admin/slideshows'] = 'admin/slideshows';
$route['admin/slideshows/remove'] = 'admin/remove_slideshow';

// Reservations
$route['admin/reservations'] = 'admin/reservations';
$route['admin/reservations/reserve'] = 'admin/reserve';
$route['admin/reservations/reserved'] = 'admin/reserved';
$route['admin/reservations/remove'] = 'admin/remove_reservations';
$route['admin/reservations/check_out'] = 'admin/check_out';



$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
