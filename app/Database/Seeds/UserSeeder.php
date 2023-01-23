<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'      => 'admin',
                'password'      => password_hash('admin', PASSWORD_DEFAULT),
                'display_name'  => 'Administrador',
                'active'        => 1,
                'permission_id' => 1
            ],
            [
                'username'      => 'cajero',
                'password'      => password_hash('cajero', PASSWORD_DEFAULT),
                'display_name'  => 'Cajero',
                'active'        => 1,
                'permission_id' => 2
            ]
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
