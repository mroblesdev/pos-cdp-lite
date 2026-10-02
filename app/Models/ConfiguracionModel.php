<?php

/**
 * Modelo de ventas
 *
 * Este modelo gestiona la interacción con la tabla "configuracion".
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracionModel extends Model
{
    protected $table      = 'configuracion';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'valor'];

    // Dates
    protected $useTimestamps = false;

    public function actualizarRegistro($nombre, $valor)
    {
        $this->where('nombre', $nombre)
            ->set(['valor' => $valor])
            ->update();
    }

    // Consulta ultimo folio
    public function ultimoFolio()
    {
        // FOR UPDATE: bloquea la fila hasta cerrar la transacción (llamar dentro de una)
        $resultado = $this->db->query("SELECT valor FROM configuracion WHERE nombre = 'ventas_folio' FOR UPDATE");

        if ($resultado->getNumRows() > 0) {
            return $resultado->getRowArray()['valor'];
        } else {
            return 1;
        }
    }

    // Actualiza siguiente folio
    public function siguienteFolio()
    {
        $this->where('nombre', 'ventas_folio')
            ->set('valor', "LPAD(valor+1,10,'0')", false)
            ->update();
    }
}
