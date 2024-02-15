<?php

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
}
