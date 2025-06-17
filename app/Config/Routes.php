<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/index', 'Home::index');
$routes->get('/login', 'LoginController::loginForm');
$routes->get('/logout', 'LoginController::loginForm');
$routes->get('/signup', 'Home::register');
$routes->get('/forgot', 'Home::lupapassword');
$routes->post('/login/cek', 'LoginController::login');
$routes->post('/signup/submit', 'RegisterController::submit');
$routes->get('/hash', 'LoginController::hash');


$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('dataobat', 'AdminController::dataobat');
    $routes->get('edit_obat/(:num)', 'AdminController::edit/$1');
    $routes->post('update/(:num)', 'AdminController::update/$1');
    $routes->get('ke_obat', 'AdminController::membuatobat');
    $routes->post('buat_obat', 'AdminController::buat');
    $routes->get('ke_staff', 'AdminController::membuatstaff');
    $routes->post('buat_staff', 'AdminController::buatstaff');
    $routes->get('delete_obat/(:num)', 'AdminController::hapus/$1');
    $routes->get('delete_admin/(:num)', 'AdminController::hapusadmin/$1');
    $routes->get('delete_apoteker/(:num)', 'AdminController::hapusapoteker/$1');
    $routes->get('detail_obat/(:num)', 'AdminController::detail/$1');
    $routes->get('laporanpenjualan', 'AdminController::laporanp');
    $routes->get('tambahstaff', 'AdminController::tstaff');
});

$routes->group('apoteker', ['filter' => 'auth:apoteker'], function ($routes) {
    $routes->get('validasi', 'ApotekerController::dashboard');
    $routes->get('dashboard', 'ApotekerController::dashboard');
    $routes->get('bantuan', 'ApotekerController::bantuan');
    $routes->get('logout',  'ApotekerController::logout');


});

$routes->group('user', ['filter' => 'auth:user'], function ($routes) {
    $routes->get('katalog', 'UserController::katalog');
    $routes->get('detail_produk/(:num)', 'UserController::detailp/$1');
    $routes->get('keranjang', 'KeranjangController::index');
    $routes->post('keranjang/tambah', 'KeranjangController::tambah');
    $routes->get('keranjang/hapus/(:num)', 'KeranjangController::hapus/$1');
    $routes->post('keranjang/bayar/(:num)', 'KeranjangController::bayar/$1');
    $routes->get('keranjang/edit/(:num)', 'KeranjangController::edit/$1');
    $routes->get('keranjang/update/(:num)', 'KeranjangController::update/$1');
    $routes->get('profil', 'UserController::profil');
    $routes->post('profil/update', 'UserController::updateProfil');
    $routes->get('riwayat', 'UserController::riwayat');
    $routes->get('profil/ganti-password', 'UserController::gantiPassword');
    $routes->post('profil/update-password', 'UserController::updatePassword');
    $routes->get('bantuan', 'UserController::bantuan');
    $routes->post('keranjang/updateQuantity', 'KeranjangController::updateQuantity');
    $routes->post('keranjang/dpengiriman', 'KeranjangController::detailPengiriman');
    $routes->get('pembayaran/back', 'KeranjangController::detailPengiriman');
    $routes->post('pengiriman/proses', 'KeranjangController::detailPengiriman');
    $routes->post('proses-pengiriman', 'KeranjangController::prosesPengiriman');
    $routes->get('pembayaran', 'KeranjangController::pembayaran');
    $routes->post('pembayaran/proses', 'KeranjangController::pembayaranProses');
});

$routes->get('/coba', 'KeranjangController::coba');



