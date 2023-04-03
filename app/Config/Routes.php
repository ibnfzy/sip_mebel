<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('Item', 'Home::item');
$routes->get('Item/(:any)', 'Home::item_detail/$1');
$routes->get('Cart', 'Home::cart');
$routes->post('add_item', 'Home::add_item');
$routes->get('remove_item/(:any)', 'Home::remove_item/$1');
$routes->get('clear_cart', 'Home::clear_cart');
$routes->post('update_cart', 'Home::update_cart');
$routes->post('diskon', 'Home::diskon_get');

$routes->group('AdmPanel', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'AdmController::index');
    $routes->get('Settings', 'InformasiToko::index');
    $routes->get('Pembeli', 'Pembeli::index');
    $routes->post('Settings', 'InformasiToko::update');
    $routes->resource('Corousel');
    $routes->resource('KategoriItem');
    $routes->resource('Item');
    $routes->resource('Voucher');
});

$routes->group('PembeliPanel', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'PembeliController::index');
    $routes->get('Transaksi', 'PembeliController::transaksi');
    $routes->get('Ubah_status_selesai', 'PembeliController::ubah_status');
    $routes->get('Transaksi/(:any)', 'PembeliController::invoice/$1');
    $routes->post('Upload_bukti_bayar', 'PembeliController::upload');
    $routes->get('Voucher', 'PembeliController::voucher');
    $routes->get('Review', 'PembeliController::review');
    $routes->get('Review/(:any)', 'PembeliController::add_review/$1');
    $routes->post('Review', 'PembeliController::save_review');
    $routes->get('Setting', 'PembeliController::setting');
    $routes->post('Setting', 'PembeliController::save_setting');
});

$routes->group('OwnerPanel', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'OwnerController::index');
    $routes->get('Transaksi', 'OwnerController::transaksi');
    $routes->get('Item', 'OwnerController::item');
    $routes->get('Pembeli', 'OwnerController::pembeli');
    $routes->get('Laporan', 'OwnerController::laporan');
    $routes->get('Print', 'OwnerController::print');
});

$routes->group('Auth', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('Admin', 'AdminLogin::index');
    $routes->post('Admin', 'AdminLogin::auth');
    $routes->get('Admin/Destroy', 'AdminLogin::logout');
    $routes->get('Owner', 'OwnerLogin::index');
    $routes->post('Owner', 'OwnerLogin::auth');
    $routes->get('Owner/Destroy', 'OwnerLogin::logout');
    $routes->get('Pembeli', 'PembeliLogin::index');
    $routes->post('Pembeli', 'PembeliLogin::auth');
    $routes->get('Pembeli/Destroy', 'PembeliLogin::logout');
    $routes->get('Pembeli/Registration', 'PembeliLogin::registration');
    $routes->post('Pembeli/Registration', 'PembeliLogin::signup');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
