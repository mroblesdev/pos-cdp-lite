<?php

/**
 * Modelo de productos
 *
 * Esta modelo gestiona la interacción con la tabla "productos".
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table      = 'productos';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['codigo', 'nombre', 'precio', 'inventariable', 'existencia', 'activo'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';

    // Obtener productos filtrando código por LIKE
    public function porCodigoLike($codigo = '')
    {
        $codigo = $this->escapeLikeString($codigo);

        $query = $this->select('id, codigo, nombre')
            ->where('activo', 1)
            ->like('codigo', $codigo)
            ->orderBy('codigo', 'ASC')
            ->limit(10)
            ->get();

        return $query->getResultArray();
    }

    // Actualiza existencia del producto
    public function actualizaStock($idProducto, $cantidad, $operador = '+')
    {
        $this->where('id', $idProducto)
            ->set('existencia', "existencia $operador $cantidad", false)
            ->update();
    }
}
