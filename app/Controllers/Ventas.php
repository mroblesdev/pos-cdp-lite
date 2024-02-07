<?php

/**
 * Controlador de Ventas
 *
 * Esta clase controla las operaciones relacionadas con la caja y ventas.
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\DetalleVentasModel;
use App\Models\ProductosModel;
use App\Models\TemporalCajaModel;
use App\Models\VentasModel;

class Ventas extends BaseController
{
    public function index()
    {
        return view('inicio');
    }

    public function guarda()
    {

        $temporalModel = new TemporalCajaModel();
        $configModel   = new ConfiguracionModel();
        $ventasModel   = new VentasModel();

        $idVentaTmp = $this->request->getPost('id_venta');

        $datos = [
            'folio' => str_pad($configModel->ultimoFolio(), 10, 0, STR_PAD_LEFT),
            'total' => preg_replace('/[\$,]/', '', $this->request->getPost('total')),
            'fecha' => date('Y-m-d H:i:s'),
            'usuario_id' => $this->session->get('usuarioId'),
            'activo' => 1
        ];

        $idVenta = $ventasModel->insert($datos);

        if ($idVenta) {
            $configModel->siguienteFolio();

            $ventaTmp = $temporalModel->where('id_venta', $idVentaTmp)->findAll();

            $detalleVentasModel = new DetalleVentasModel();
            $productosModel     = new ProductosModel();

            foreach ($ventaTmp as $productoTmp) {
                $producto = [
                    'venta_id'    => $idVenta,
                    'producto_id' => $productoTmp['id_producto'],
                    'nombre'      => $productoTmp['nombre'],
                    'cantidad'    => $productoTmp['cantidad'],
                    'precio'      => $productoTmp['precio'],
                ];

                $detalleVentasModel->insert($producto);

                $datosProducto = $productosModel->find($productoTmp['id_producto']);

                if ($datosProducto['inventariable'] == 1) {
                    $productosModel->actualizaStock($productoTmp['id_producto'], $productoTmp['cantidad'], '-');
                }
            }
        }

        $temporalModel->eliminaVenta($idVentaTmp);
        
        //return redirect()->to(base_url() . "/ventas/muestraTicket/" . $idVenta);
    }
}
