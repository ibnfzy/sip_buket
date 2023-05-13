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
$routes->get('/Produk', 'Home::katalog');
$routes->get('/Keranjang', 'Home::keranjang');
$routes->get('/Produk/(:any)', 'Home::detail/$1');
$routes->post('add_item', 'Home::add_item');
$routes->get('remove_item/(:any)', 'Home::remove_item/$1');
$routes->get('clear_cart', 'Home::clear_cart');
$routes->post('update_cart', 'Home::update_cart');

$routes->group('Auth', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('Admin', 'AdminLogin::index');
    $routes->post('Admin', 'AdminLogin::auth');
    $routes->get('Admin/Destroy', 'AdminLogin::logout');
    $routes->get('Pemilik', 'PemilikLogin::index');
    $routes->post('Pemilik', 'PemilikLogin::auth');
    $routes->get('Pemilik/Destroy', 'PemilikLogin::logout');
    $routes->get('Customer', 'CustLogin::index');
    $routes->post('Customer', 'CustLogin::auth');
    $routes->get('Customer/Destroy', 'CustLogin::logout');
    $routes->get('Customer/Registration', 'CustLogin::registration');
    $routes->post('Customer/Registration', 'CustLogin::signup');
});

$routes->group('AdminPanel', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->resource('Produk');
    $routes->resource('KategoriProduk');
    $routes->resource('Customer');
    $routes->resource('Corousel');
    $routes->get('TransaksiCustomer', 'Transaksi::index');
    $routes->get('TransaksiCustomer/(:any)', 'Transaksi::show/$1');
    $routes->get('WebSetting', 'AdminController::setting/$1');
    $routes->get('validasi_bukti_bayar/(:any)', 'Transaksi::validasi_bb/$1');
    $routes->get('update_kirim/(:any)', 'Transaksi::update_kirim/$1');
    $routes->get('BiayaOngkir', 'AdminController::biaya_ongkir');
    $routes->get('BiayaOngkir/new', 'AdminController::add_biaya_ongkir');
    $routes->get('BiayaOngkir/(:num)', 'AdminController::delete_biaya_ongkir/$1');
    $routes->get('ProdukDelete/(:any)', 'Produk::delete/$1');
    $routes->get('KategoriProdukDelete/(:any)', 'KategoriProduk::delete/$1');
    $routes->get('CustomerDelete/(:any)', 'Customer::delete/$1');
    $routes->get('CorouselDelete/(:any)', 'Corousel::delete/$1');
});

$routes->group('PemilikPanel', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'PemilikController::index');
    $routes->get('LaporanProduk', 'PemilikController::laporanproduk');
    $routes->post('PrintLaporanProduk', 'PemilikController::laporanprodukprint');
    $routes->get('LaporanPenjualan', 'PemilikController::laporanpenjualan');
    $routes->post('PrintLaporanPenjualan', 'PemilikController::laporanpenjualanprint');
    $routes->get('LaporanPelanggan', 'PemilikController::laporanpelanggan');
    $routes->post('PrintLaporanPelanggan', 'PemilikController::laporanpelangganprint');
    $routes->get('WebSetting', 'PemilikController::setting');
    $routes->post('WebSetting', 'PemilikController::setting_save');
    $routes->resource('Admin');
    $routes->get('AdminDelete/(:any)', 'Admin::delete/$1');
});

$routes->group('CustomerPanel', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'CustController::index');
    $routes->get('checkout', 'CustController::checkout');
    $routes->get('informasi', 'CustController::informasi');
    $routes->get('transaksi', 'CustController::transaksi');
    $routes->get('invoice/(:any)', 'CustController::invoice/$1');
    $routes->post('upload/(:any)', 'CustController::upload/$1');
    $routes->post('update-selesai', 'CustController::updateStatusSelesai');
    $routes->post('informasi/(:any)', 'CustController::update_informasi/$1');
    $routes->resource('Review');
    $routes->get('ReviewDelete/(:any)', 'Review::delete/$1');
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
