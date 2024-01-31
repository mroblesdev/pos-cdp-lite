<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['usuario', 'password', 'nombre', 'activo'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';

    public function validaUsuario($usuario, $password)
    {
        $condicion = ['usuario' => $usuario, 'activo' => 1];

        $sql = $this->where($condicion);
        $usuarioData  = $sql->get()->getRowArray();

        if ($usuarioData && password_verify($password, $usuarioData['password'])) {
            return $usuarioData;
        }

        return null;
    }
}
