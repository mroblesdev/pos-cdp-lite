<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Administrador'
            ],
            [
                'name' => 'Cajero'
            ]
        ];

        // Using Query Builder
        $this->db->table('permissions')->insertBatch($data);
    }
}
