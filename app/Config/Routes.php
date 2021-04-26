<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('LoginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


//REGISTER//
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/process', 'RegisterController::process');

//LOGIN//
$routes->get('/login', 'LoginController::index');
$routes->post('/login/process', 'LoginController::process');
$routes->get('/logout', 'LoginController::logout');

$routes->group('', ['filter' => 'cekLogin'], function ($routes) {
    //DASHBOARD//
    $routes->get('/dashboard', 'DashboardController::index');

    //RECYCLE//
    $routes->get('/recycle', 'ProductController::indexRecycle');

    //INVOICE//
    $routes->get('/invoice', 'InvoiceController::index');
    $routes->get('/invoice/add', 'InvoiceController::create');
    $routes->post('/invoice/add', 'InvoiceController::store');

    //PRODUCTS//
    $routes->get('/products', 'ProductController::index');
    $routes->get('/products/add', 'ProductController::create');
    $routes->post('/products/add', 'ProductController::store');
    $routes->get('/products/edit/(:num)', 'ProductController::edit/$1');
    $routes->post('/products/edit/(:num)', 'ProductController::update/$1');
    $routes->get('/products/delete/(:num)', 'ProductController::delete/$1');
    $routes->get('/products/activate/(:num)', 'ProductController::activate/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
