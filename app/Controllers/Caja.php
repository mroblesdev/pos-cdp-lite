<?php

/**
 * Controlador de Caja
 *
 * Esta clase controla las operaciones relacionadas con la caja.
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\TemporalCajaModel;

class Caja extends BaseController
{
    public function index()
    {
        return view('ventas/caja');
    }

    // Valida e inserta nuevo registro
    public function inserta()
    {
        if (!$this->request->isAJAX()) {
            return;
        }

        $error = '';

        $codigo   = $this->request->getPost('codigo');
        $cantidad = $this->request->getPost('cantidad');
        $idVenta = $this->request->getPost('id_venta');

        $productosModel = new ProductosModel();
        $temporalModel = new TemporalCajaModel();

        $producto = $productosModel->where(['codigo' => $codigo, 'activo' => 1])->first();

        if (!$producto) {
            $error = 'No existe el producto';
        } else {
            $idProducto = $producto['id'];
            $productoCodigo = $producto['codigo'];
            $productoNombre = $producto['nombre'];
            $productoInventariable = $producto['inventariable'];
            $productoExistencia = $producto['existencia'];
            $productoPrecioVenta = $producto['precio'];

            $productoVenta = $temporalModel->where(['id_venta' => $idVenta, 'id_producto' => $idProducto])->first();
            $cantidad += $productoVenta ? $productoVenta['cantidad'] : 0;

            if ($productoInventariable == 1 && $productoExistencia < $cantidad) {
                $error = 'No hay suficientes existencias';
            } else {
                $subtotal = $cantidad * $productoPrecioVenta;

                $data = [
                    'id_venta' => $idVenta,
                    'id_producto' => $idProducto,
                    'codigo' => $productoCodigo,
                    'nombre' => $productoNombre,
                    'precio' => $productoPrecioVenta,
                    'cantidad' => $cantidad,
                    'importe' => $subtotal,
                ];

                if ($productoVenta) {
                    $temporalModel->actualizaProductoVenta($idProducto, $idVenta, $cantidad, $subtotal);
                } else {
                    $temporalModel->insert($data);
                }
            }
        }

        $res['datos'] = $this->cargaProductos($idVenta);
        $res['total'] = number_format($temporalModel->totalPorVenta($idVenta), 2, '.', ',');
        $res['error'] = $error;
        echo json_encode($res);
    }

    // Elimina producto de tabla "temporal_caja" por id_producto e id_venta
    public function elimina()
    {
        if (!$this->request->isAJAX()) {
            return;
        }

        $temporalModel = new TemporalCajaModel();

        $idProducto = $this->request->getPost('id_producto');
        $idVenta = $this->request->getPost('id_venta');

        $productoVenta = $temporalModel->where(['id_venta' => $idVenta, 'id_producto' => $idProducto])->first();

        if ($productoVenta) {
            $cantidad = max($productoVenta['cantidad'] - 1, 0);
            $subtotal = $cantidad * $productoVenta['precio'];

            if ($cantidad > 0) {
                $temporalModel->actualizaProductoVenta($idProducto, $idVenta, $cantidad, $subtotal);
            } else {
                $temporalModel->eliminar($idProducto, $idVenta);
            }
        }
        $res['datos'] = $this->cargaProductos($idVenta);
        $res['total'] = number_format($temporalModel->totalPorVenta($idVenta), 2, '.', ',');
        $res['error'] = '';

        echo json_encode($res);
    }

    // Carga los productos de la venta a una tabla HTML
    public function cargaProductos($idVenta)
    {
        helper('form');

        $temporalModel = new TemporalCajaModel();

        $resultado = $temporalModel->where(['id_venta' => $idVenta])->findAll();
        $fila = '';
        $numFila = 0;

        foreach ($resultado as $row) {
            $numFila++;
            $fila .= "<tr id='fila" . $numFila . "'>";
            $fila .= "<td>$numFila</td>";
            $fila .= "<td>" . esc($row['codigo']) . "</td>";
            $fila .= "<td>" . esc($row['nombre']) . "</td>";
            $fila .= "<td>" . $row['precio'] . "</td>";
            $fila .= "<td>" . $row['cantidad'] . "</td>";
            $fila .= "<td>" . $row['importe'] . "</td>";
            $fila .= "<td><a onclick=\"eliminaProducto(" . $row['id_producto'] . ", '" . $row['id_venta'] . "')\" class='borrar'><span class='fas fa-fw fa-trash'></span></a></td>";
            $fila .= "</tr>";
        }
        return $fila;
    }
}
