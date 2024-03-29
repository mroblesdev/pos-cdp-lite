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
        $query = $this->select('fecha_alta, folio, total')
            ->table('v_ventas')
            ->where("activo = $activo")
            ->where("DATE(fecha_alta) BETWEEN '$fechaInicio' AND '$fechaFin'")
            ->orderBy('fecha_alta DESC')
            ->get();
        return $query->getResultArray();
    }

    public function totalVentasDia($fecha)
    {
        $where = "activo = 1 AND DATE(fecha) = '$fecha'";
        $this->select("IFNULL(sum(total), 0) AS total");
        return $this->where($where)->first();
    }
}
