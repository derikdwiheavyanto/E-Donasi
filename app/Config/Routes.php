<?php

use App\Controllers\LoginController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pengurus\HomePengurus;
use App\Controllers\Pengurus\DataDonatur;
use App\Controllers\Pengurus\LaporanDonasi;
use App\Controllers\Pengurus\RiwayatDonasi;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', [LoginController::class, 'index']);
$routes->get('/dashboard', [HomePengurus::class, 'index']);
$routes->get('/dashboard-donatur', [HomePengurus::class, 'indexDonatur']);
$routes->post('/login', [LoginController::class, 'login']);
$routes->get('/data-donatur', [DataDonatur::class, 'index']);
$routes->get('/riwayat-donasi', [RiwayatDonasi::class, 'RiwayatDonasi']);
$routes->get('/laporan-donasi', [LaporanDonasi::class, 'LaporanDonasi']);
