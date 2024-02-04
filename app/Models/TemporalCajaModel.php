<?php

/**
 * Modelo de temporal_caja
 *
 * Esta modelo gestiona la interacción con la tabla "temporal_caja".
 * Incluye funciones para actualizar, seleccionar y eliminar registros.
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

namespace App\Models;

use CodeIgniter\Model;

class TemporalCajaModel extends Model
{
    protected $table      = 'temporal_caja';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_venta', 'id_producto', 'codigo', 'nombre', 'cantidad', 'precio', 'importe'];

    // Dates
    protected $useTimestamps = false;

    // Actualiza la cantidad e importe de un producto por id_venta de la tabla "temporal_caja".
    public function actualizaProductoVenta($idProducto, $idVenta, $cantidad, $importe)
    {
        return $this->set('cantidad', $cantidad)
            ->set('importe', $importe)
            ->where('id_producto', $idProducto)
            ->where('id_venta', $idVenta)
            ->update();
    }

    // Calcula el importe total por id_venta de la tabla "temporal_caja".
    public function totalPorVenta($idVenta)
    {
        $resultado = $this->db->table('temporal_caja')
            ->selectSum('importe')
            ->where('id_venta', $idVenta)
            ->get();

        if ($resultado->getNumRows() > 0) {
            $importe = $resultado->getRowArray()['importe'];
            return ($importe !== null) ? $importe : 0;
        } else {
            return 0;
        }
    }

    // Elimina producto de tabla "temporal_caja" por id_producto e id_venta
    public function eliminar($idProducto, $idVenta)
    {
        return $this->where('id_producto', $idProducto)
            ->where('id_venta', $idVenta)
            ->delete();
    }

    // Elimina los productos de tabla "temporal_caja" por id_venta
    public function eliminaVenta($idVenta)
    {
        return $this->where('id_venta', $idVenta)
            ->delete();
    }
}
