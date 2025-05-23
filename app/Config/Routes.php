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
$routes->get('premium', 'Inicio::premium');

// Productos
$routes->resource('productos', ['placeholder' => '(:num)', 'except' => 'show', "filter" => "auth"]);
$routes->get('productos/baja', 'Productos::bajas', ["filter" => "auth"]);
$routes->put('productos/activa/(:num)', 'Productos::reingresar/$1', ["filter" => "auth"]);
$routes->get('productos/autocompleteData?(:any)', 'Productos::autocompleteData/$1', ["filter" => "auth"]);

// Caja
$routes->get('caja', 'Caja::index', ["filter" => "auth"]);
$routes->post('caja/inserta', 'Caja::inserta', ["filter" => "auth"]);
$routes->post('caja/elimina', 'Caja::elimina', ["filter" => "auth"]);

// Ventas
$routes->get('ventas', 'Ventas::index', ["filter" => "auth"]);
$routes->get('ventas/bajas', 'Ventas::bajas', ["filter" => "auth"]);
$routes->post('ventas', 'Ventas::guarda', ["filter" => "auth"]);
$routes->delete('ventas/(:num)', 'Ventas::cancelar/$1', ["filter" => "auth"]);
$routes->get('ventas/muestraTicket/(:num)', 'Ventas::verTicket/$1', ["filter" => "auth"]);
$routes->get('ventas/generaTicket/(:num)', 'Ventas::generaTicket/$1', ["filter" => "auth"]);

// Reportes
$routes->get('reportes/crea_ventas', 'Reportes::creaVentas', ["filter" => "auth"]);
$routes->post('reportes/ventas', 'Reportes::verReporteVentas', ["filter" => "auth"]);
$routes->get('reportes/genera_ventas/(:segment)/(:segment)/(:num)', 'Reportes::generaVentas/$1/$2/$3', ["filter" => "auth"]);
$routes->get('reportes/productos', 'Reportes::verReporteProductos', ["filter" => "auth"]);
$routes->get('reportes/genera_productos', 'Reportes::generaProductos', ["filter" => "auth"]);

// Configuración
$routes->get('datos', 'Configuracion::edit', ["filter" => "auth"]);
$routes->put('datos', 'Configuracion::update', ["filter" => "auth"]);

// Usuarios
$routes->get('cambia-password', 'Login::cambiaPassword', ["filter" => "auth"]);
$routes->post('cambia-password', 'Login::actualizaPassword', ["filter" => "auth"]);
