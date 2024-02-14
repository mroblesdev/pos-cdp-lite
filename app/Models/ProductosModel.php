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

    /**
     * Buscar registros por código o nombre similar.
     *
     * @param string $codigoNombre El código o nombre a buscar.
     * @return array Resultado de la consulta en formato de array.
     */
    public function buscarPorCodigoNombre($codigoNombre  = '')
    {
        $codigoNombre  = $this->escapeLikeString($codigoNombre);

        $query = $this->select('id, codigo, nombre')
            ->where('activo', 1)
            ->like('codigo', $codigoNombre)
            ->orLike('nombre', $codigoNombre)
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

    /**
     * Seleccionar los prodictos activos agregando etiquetas
     * a inventariable y existencias
     */
    public function productosInventario($activo = 1)
    {
        $query = $this->select(
            'id, codigo, nombre, precio, inventariable,
            (CASE 
                WHEN inventariable = 1 THEN "SI"
                ELSE "NO" 
            END) AS inventariable,
            (CASE
                WHEN inventariable = 1 THEN existencia
                    ELSE "N/A" 
                END) AS existencia'
        )->where('activo', $activo)->get();

        return $query->getResultArray();
    }
}
