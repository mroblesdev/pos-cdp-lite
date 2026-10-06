<?php

/**
 * Modelo de ventas
 *
 * Este modelo gestiona la interacción con la tabla "ventas".
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

namespace App\Models;

use CodeIgniter\Model;

class DetalleVentasModel extends Model
{
    protected $table      = 'detalle_ventas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['venta_id', 'producto_id', 'nombre', 'cantidad', 'precio'];

    // Dates
    protected $useTimestamps = false;

    // Productos más vendidos en ventas activas (piezas e importe)
    public function productosMasVendidos($limite = 5)
    {
        return $this->select('detalle_ventas.producto_id, MAX(detalle_ventas.nombre) AS nombre, SUM(detalle_ventas.cantidad) AS cantidad, SUM(detalle_ventas.cantidad * detalle_ventas.precio) AS importe')
            ->join('ventas', 'ventas.id = detalle_ventas.venta_id')
            ->where('ventas.activo', 1)
            ->groupBy('detalle_ventas.producto_id')
            ->orderBy('cantidad', 'DESC')
            ->orderBy('importe', 'DESC')
            ->limit($limite)
            ->get()
            ->getResultArray();
    }
}
