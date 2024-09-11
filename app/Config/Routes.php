<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');
$routes->get('/nilai', 'Home::nilai');
$routes->get('/faq', 'Home::faq');
$routes->get('/contact', 'Home::contact');
$routes->get('/survey', 'Home::survey');
$routes->get('/chart', 'Home::chart');
$routes->get('/user', 'Home::user');

$routes->add('admin2045/logout', 'admin2045\Login::logout');

$routes->group('admin2045', ['filter' => 'noadmin'], function ($routes) {
    $routes->add('', 'admin2045\Login::login');
    $routes->add('login', 'admin2045\Login::login');
    $routes->add('lupapassword', 'admin2045\Login::lupapassword');
    $routes->add('resetpassword', 'admin2045\Login::resetpassword');
});
