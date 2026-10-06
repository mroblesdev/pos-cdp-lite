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

class VentasModel extends Model
{
    protected $table      = 'ventas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['folio', 'total', 'fecha', 'usuario_id', 'activo'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';

    // Consulta vista "v_ventas"
    public function mostrarVentas($activo = 1)
    {
        $query = $this->db->table('v_ventas')->where('activo', $activo);
        return $query->get()->getResultArray();
    }

    // Consulta ventas por fechas
    public function ventasRango($fechaInicio, $fechaFin, $activo = 1)
    {
        $query = $this->select('fecha, folio, total')
            ->table('v_ventas')
            ->where('activo', $activo)
            ->where('DATE(fecha) >=', $fechaInicio)
            ->where('DATE(fecha) <=', $fechaFin)
            ->orderBy('fecha DESC')
            ->get();
        return $query->getResultArray();
    }

    public function totalVentasDia($fecha)
    {
        $this->select("IFNULL(sum(total), 0) AS total");
        return $this->where('activo', 1)->where('DATE(fecha)', $fecha)->get()->getRowArray();
    }

    // Total y número de ventas activas en un rango de fechas
    public function totalVentasRango($fechaInicio, $fechaFin)
    {
        $this->select('IFNULL(SUM(total), 0) AS total, COUNT(*) AS tickets');
        return $this->where('activo', 1)
            ->where('DATE(fecha) >=', $fechaInicio)
            ->where('DATE(fecha) <=', $fechaFin)
            ->get()
            ->getRowArray();
    }

    // Total vendido por día en un rango de fechas (solo días con ventas), indexado por fecha
    public function totalesPorDia($fechaInicio, $fechaFin)
    {
        $filas = $this->select('DATE(fecha) AS dia, SUM(total) AS total')
            ->where('activo', 1)
            ->where('DATE(fecha) >=', $fechaInicio)
            ->where('DATE(fecha) <=', $fechaFin)
            ->groupBy('DATE(fecha)')
            ->get()
            ->getResultArray();

        return array_column($filas, 'total', 'dia');
    }
}
