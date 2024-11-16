<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::cekLogin');

$routes->group('/', ['filter' => 'otp'], function ($routes) {
    $routes->get('otp', 'AuthController::otp');
    $routes->post('otp', 'AuthController::authentication');
});


// filter sesi logged_in
$routes->group('/', ['filter' => 'login'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('keluar', 'AuthController::logout');

    //User
    $routes->get('pengguna', 'MasterData\UserController::index');
    $routes->post('pengguna/tambah', 'MasterData\UserController::store');
    $routes->post('pengguna/ubah', 'MasterData\UserController::update');
    $routes->get('pengguna/hapus/(:num)', 'MasterData\UserController::delete/$1');
    //Ajax table
    $routes->post('pengguna/ajax_table', 'MasterData\UserController::ajaxTable');

    //Category
    $routes->get('kategori', 'MasterData\CategoryController::index');
    $routes->post('kategori/tambah', 'MasterData\CategoryController::store');
    $routes->post('kategori/ubah', 'MasterData\CategoryController::update');
    $routes->get('kategori/hapus/(:num)', 'MasterData\CategoryController::delete/$1');

    //Requirement
    $routes->get('syarat', 'MasterData\RequirementController::index');
    $routes->post('syarat/tambah', 'MasterData\RequirementController::store');
    $routes->post('syarat/ubah', 'MasterData\RequirementController::update');
    $routes->get('syarat/hapus/(:num)', 'MasterData\RequirementController::delete/$1');

    
    //Training
    $routes->get('pelatihan', 'MasterData\TrainingController::index');
    $routes->get('pelatihan/tambah', 'MasterData\TrainingController::create');
    $routes->post('pelatihan/tambah', 'MasterData\TrainingController::store');

    $routes->get('pelatihan/jadwal/(:num)', 'MasterData\TrainingController::jadwal/$1');
});

