<?php

use App\Controllers\LoginController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pengurus\HomePengurus;


/**
 * @var RouteCollection $routes
 */

$routes->get('/', [LoginController::class, 'index']);
$routes->get('/dashboard', [HomePengurus::class, 'index']);
$routes->get('/dashboard-donatur', [HomePengurus::class, 'indexDonatur']);
$routes->post('/login', [LoginController::class, 'login']);
