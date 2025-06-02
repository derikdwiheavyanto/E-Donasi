<?php

use App\Controllers\LoginController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pengurus\HomePengurus;


/**
 * @var RouteCollection $routes
 */

$routes->get('/', [LoginController::class, 'halamanpertama']);
$routes->get('/dashboard', [HomePengurus::class, 'index']);
