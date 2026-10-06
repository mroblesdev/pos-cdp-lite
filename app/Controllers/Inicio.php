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

use App\Models\DetalleVentasModel;
use App\Models\ProductosModel;
use App\Models\VentasModel;

class Inicio extends BaseController
{
    // Existencia igual o menor a este valor se considera "poco stock"
    private const UMBRAL_EXISTENCIA_BAJA = 10;

    // Días que muestra la gráfica de ventas (incluye hoy)
    private const DIAS_GRAFICA = 7;

    public function index()
    {
        $productosModel     = new ProductosModel();
        $ventasModel        = new VentasModel();
        $detalleVentasModel = new DetalleVentasModel();

        $hoy = date('Y-m-d');

        $datos = [
            'totalProductos'        => $productosModel->where('activo', 1)->countAllResults(),
            'ventasDia'             => $ventasModel->totalVentasRango($hoy, $hoy),
            'ventasMes'             => $ventasModel->totalVentasRango(date('Y-m-01'), date('Y-m-t')),
            'totalExistenciasBajas' => $productosModel->totalExistenciasBajas(self::UMBRAL_EXISTENCIA_BAJA),
            'ventasPorDia'          => $this->ventasUltimosDias($ventasModel, $hoy),
            'masVendidos'           => $detalleVentasModel->productosMasVendidos(5),
        ];

        return view('inicio', $datos);
    }

    public function premium()
    {
        return view('premium');
    }

    // Arma la serie de la gráfica incluyendo los días sin ventas (con total 0)
    private function ventasUltimosDias(VentasModel $ventasModel, $hoy)
    {
        $nombresDias = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
        $inicio      = date('Y-m-d', strtotime($hoy . ' -' . (self::DIAS_GRAFICA - 1) . ' days'));
        $totales     = $ventasModel->totalesPorDia($inicio, $hoy);

        $serie = [];

        for ($i = self::DIAS_GRAFICA - 1; $i >= 0; $i--) {
            $fecha   = date('Y-m-d', strtotime($hoy . " -$i days"));
            $serie[] = [
                'etiqueta' => $nombresDias[date('w', strtotime($fecha))] . ' ' . date('d', strtotime($fecha)),
                'total'    => (float) ($totales[$fecha] ?? 0),
            ];
        }

        return $serie;
    }
}
