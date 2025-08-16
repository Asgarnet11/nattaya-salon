<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//====================================================================
// 1. Frontend / Rute Publik (Untuk Halaman Pelanggan)
//====================================================================
$routes->get('/', 'Home::index');
$routes->get('/lokasi', 'Home::lokasi');
$routes->get('/layanan', 'Home::layanan');
$routes->get('/layanan/(:num)', 'Home::detail_layanan/$1');
$routes->get('/galeri', 'Home::galeri');
$routes->get('/kontak', 'Home::kontak');
$routes->get('/artikel', 'Home::artikel');
$routes->get('/artikel/(:segment)', 'Home::detail_artikel/$1');
$routes->get('/api/paket/(:num)', 'Home::getPaketByLayanan/$1');

// Rute yang memerlukan login pelanggan
$routes->get('/booking', 'Home::booking', ['filter' => 'auth_pelanggan']);
$routes->post('/booking', 'Home::proses_booking', ['filter' => 'auth_pelanggan']);
$routes->get('/riwayat-booking', 'Home::riwayat_booking', ['filter' => 'auth_pelanggan']);


//====================================================================
// 2. Rute Otentikasi Pelanggan (Publik)
//====================================================================
$routes->get('/register', 'AuthController::register_form');
$routes->post('/register', 'AuthController::proses_register');
$routes->get('/login', 'AuthController::login_form');
$routes->post('/login-pelanggan', 'AuthController::proses_login');
$routes->get('/logout', 'AuthController::logout');


//====================================================================
// 3. Rute Otentikasi ADMIN (Terpisah)
//====================================================================
$routes->get('/admin/login', 'Admin\AuthController::index');
$routes->post('/admin/login', 'Admin\AuthController::authenticate');
$routes->get('/admin/logout', 'Admin\AuthController::logout');


//====================================================================
// 4. Backend / Rute Panel Admin (Dilindungi oleh Filter Admin)
//====================================================================
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    // Rute default & dashboard
    $routes->get('/', 'Admin\DashboardController::index');
    $routes->get('dashboard', 'Admin\DashboardController::index');

    // Rute Kalender & API
    $routes->get('booking/kalender', 'Admin\BookingController::kalender');
    $routes->get('api/bookings', 'Admin\BookingController::getBookingsApi');

    // Rute Custom untuk Layanan (Paket & Gambar)
    $routes->post('layanan/tambah-paket', 'Admin\LayananController::tambahPaket');
    $routes->delete('layanan/hapus-paket/(:num)', 'Admin\LayananController::hapusPaket/$1');
    $routes->delete('layanan/delete-image/(:num)', 'Admin\LayananController::deleteImage/$1');

    // Rute Resource untuk semua modul manajemen
    $routes->resource('booking', ['controller' => 'Admin\BookingController', 'except' => ['new', 'create', 'show']]);
    $routes->resource('layanan', ['controller' => 'Admin\LayananController', 'except' => ['show']]);
    $routes->resource('karyawan', ['controller' => 'Admin\KaryawanController', 'except' => ['show']]);
    $routes->resource('galeri', ['controller' => 'Admin\GaleriController', 'except' => ['show', 'edit', 'update']]);
    $routes->resource('artikel', ['controller' => 'Admin\ArtikelController', 'except' => ['show']]);
    $routes->resource('cabang', ['controller' => 'Admin\CabangController', 'except' => ['show']]);
    $routes->resource('users', ['controller' => 'Admin\UserController', 'except' => ['show']]);
});
