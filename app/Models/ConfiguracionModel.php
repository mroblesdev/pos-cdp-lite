<?php

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
}
