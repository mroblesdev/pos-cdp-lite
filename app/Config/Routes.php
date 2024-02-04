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
$routes->resource('productos', ['placeholder' => '(:num)', 'except' => 'show', "filter" => "auth"]);
$routes->get('productos/baja', 'Productos::bajas', ["filter" => "auth"]);
$routes->put('productos/activa/(:num)', 'Productos::reingresar/$1', ["filter" => "auth"]);
$routes->get('productos/autocompleteData?(:any)', 'Productos::autocompleteData/$1', ["filter" => "auth"]);

// Dashboard
$routes->get('caja', 'Caja::index');
$routes->post('caja/inserta', 'Caja::inserta');
$routes->post('caja/elimina', 'Caja::elimina');

// Configuración
$routes->get('datos', 'Configuracion::edit', ["filter" => "auth"]);
$routes->put('datos', 'Configuracion::update', ["filter" => "auth"]);
