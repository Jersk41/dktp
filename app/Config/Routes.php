<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->match(['get','post'],'/', 'Auth::index',['as'=>'login']);
// $routes->match(['get','post'],'/', 'Auth::index',['as'=>'login_user']);
$routes->match(['get','post'],'register', 'Auth::register');
$routes->match(['get','post'],'verifikasi','Auth::verifikasi_akun');
$routes->get('verifikasi/(:any)','Auth::verify_otp/$1');
$routes->group('dktp', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Penduduk::index');
    $routes->get('profile', 'Admin::profile');
    $routes->get('buatktp', 'Penduduk::buatktp');
    $routes->post('buatktp', 'Penduduk::submitdata');
    $routes->get('detail', 'Penduduk::detail');
});
$routes->group('main',['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('profile', 'Admin::profile');
    $routes->get('dashboard', 'Admin::index');
    $routes->group('petugas',static function ($routes){
        $routes->get('/', 'Petugas::index');
        // $routes->match(['get','post'],'/', 'Petugas::index');
        $routes->post('tambah', 'Petugas::tambah');
        $routes->post('tambah/admin', 'Petugas::tambah_admin');
        $routes->match(['get','post'],'edit/(:num)', 'Petugas::edit/$1');
        $routes->post('tambah/admin', 'Petugas::tambah_admin');
        $routes->match(['get','post'],'edit/admin/(:num)', 'Petugas::edit_admin/$1');
        $routes->get('delete/(:num)', 'Petugas::delete/$1');
    });
    $routes->group('approval',static function ($routes){
        $routes->get('/', 'Approval::index');
        $routes->get('detail/(:num)', 'Approval::index/$1');
        $routes->get('edit/(:num)', 'Approval::edit/$1');
        $routes->post('update/(:any)', 'Approval::update/$1');
        $routes->get('delete/(:num)', 'Approval::delete/$1');
    });
    $routes->group('setting',static function ($routes){
        $routes->get('/', 'Setting::index');
        $routes->get('edit/(:any)', 'Setting::form/$1');
        $routes->post('create', 'Setting::save');
        $routes->post('update/(:any)', 'Setting::update/$1');
    });
    $routes->group('report',static function ($routes){
        $routes->get('/', 'Approval::report');
        $routes->get('preview', 'Approval::previewreport');
        $routes->get('download', 'Approval::previewreport/1');
    });
});
$routes->get('/test', 'Auth::test');
$routes->get('/logout', 'Auth::logout');

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
