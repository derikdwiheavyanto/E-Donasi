<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pengurus\HomePengurus;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', [HomePengurus::class, 'index']);
