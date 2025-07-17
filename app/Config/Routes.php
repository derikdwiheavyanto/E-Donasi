<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pengurus\HomePengurus;
use App\Controllers\Donatur\HomeDonatur;
use App\Controllers\Donatur\InginDonasi;
use App\Controllers\Donatur\Riwayat;
use App\Controllers\Donatur\Laporan;
use App\Controllers\Pengurus\DataDonatur;
use App\Controllers\Pengurus\LaporanDonasi;
use App\Controllers\Pengurus\RiwayatDonasi;
use App\Controllers\RedirectController;
use Config\Auth as AuthConfig;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [RedirectController::class, 'index']);
$routes->get('/dashboard', [RedirectController::class, 'indexDashboard']);

$routes->group('pengurus', ['filter' => 'role:pengurus'], function ($routes) {
    $routes->get('dashboard', [HomePengurus::class, 'index']);
    $routes->get('data-donatur', [DataDonatur::class, 'index']);
    $routes->get('riwayat-donasi', [RiwayatDonasi::class, 'RiwayatDonasi']);
    $routes->get('laporan-donasi', [LaporanDonasi::class, 'LaporanDonasi']);
    $routes->get('laporan-donasi/exportExcel', 'Pengurus\LaporanDonasi::exportExcel');

});

$routes->group('donatur', ['filter' => 'role:donatur'], function ($routes) {
    $routes->get('dashboard', [HomeDonatur::class, 'index']);
    $routes->get('laporan-donatur', [Laporan::class, 'index']);
    $routes->get('riwayat-donatur', [Riwayat::class, 'index']);
    $routes->get('ingin-donasi', [InginDonasi::class, 'index']);
    $routes->post('donasi/simpan', [InginDonasi::class, 'create']);

});


$routes->group('', ['namespace' => 'App\Controllers\Auth'], static function ($routes) {
    // Load the reserved routes from Auth.php
    $config = config(AuthConfig::class);
    $reservedRoutes = $config->reservedRoutes;

    // Login/out
    $routes->get($reservedRoutes['login'], 'AuthController::login', ['as' => $reservedRoutes['login']]);
    $routes->post($reservedRoutes['login'], 'AuthController::attemptLogin');
    $routes->get($reservedRoutes['logout'], 'AuthController::logout');

    // Registration
    $routes->get($reservedRoutes['register'], 'AuthController::register', ['as' => $reservedRoutes['register']]);
    $routes->post($reservedRoutes['register'], 'AuthController::attemptRegister');

    // Activation
    $routes->get($reservedRoutes['activate-account'], 'AuthController::activateAccount', ['as' => $reservedRoutes['activate-account']]);
    $routes->get($reservedRoutes['resend-activate-account'], 'AuthController::resendActivateAccount', ['as' => $reservedRoutes['resend-activate-account']]);
});
