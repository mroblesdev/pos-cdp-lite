<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CargaSeeder extends Seeder
{
    public function run()
    {
        $this->call('ConfiguracionSeeder');
        $this->call('UsuariosSeeder');
    }
}
