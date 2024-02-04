<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::login');
$routes->get('logout', 'Login::logout');

// Dashboard
$routes->get('inicio', 'Inicio::index');

// Productos
$routes->resource('productos', ['placeholder' => '(:num)', 'except' => 'show', "filter" => "Auth"]);
$routes->get('productos/baja', 'Productos::bajas', ["filter" => "Auth"]);
$routes->put('productos/activa/(:num)', 'Productos::reingresar/$1', ["filter" => "Auth"]);

// Configuración
$routes->get('datos', 'Configuracion::edit', ["filter" => "Auth"]);
$routes->put('datos', 'Configuracion::update', ["filter" => "Auth"]);
