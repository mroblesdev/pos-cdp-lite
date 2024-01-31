<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'usuario'  => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'nombre'   => 'Administrador',
            'activo'   => 1
        ];

        // Using Query Builder
        $this->db->query('INSERT INTO usuarios (usuario, password, nombre, activo) VALUES(:usuario:, :password:, :nombre:, :activo:)', $data);
    }
}
