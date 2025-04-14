<?php

/**
 * Controlador de Inicio
 *
 * Esta clase controla las operaciones relacionadas con el Dashboard.
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\VentasModel;

class Inicio extends BaseController
{
    public function index()
    {
        $productosModel = new ProductosModel();
        $ventasModel    = new VentasModel();

        $totalProductos = $productosModel->where('activo', 1)->countAllResults();
        $hoy = date('Y-m-d');
        $totalVentas = $ventasModel->totalVentasDia($hoy);

        return view('inicio', ['totalProductos' => $totalProductos, 'totalVentas' => $totalVentas]);
    }

    public function premium()
    {
        return view('premium');
    }
}
