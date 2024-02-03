<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nombre' => 'tienda_nombre', 'valor' => 'Tienda CDP'],
            ['nombre' => 'tienda_telefono', 'valor' => '5512345678'],
            ['nombre' => 'tienda_direccion', 'valor' => 'Calle Benito Juarez #5 Colonia Miguel Hidalgo, CDMX'],
            ['nombre' => 'ticket_leyenda', 'valor' => 'Gracias por su compra'],
            ['nombre' => 'ventas_folio', 'valor' => '0000000001']
        ];

        $this->db->table('configuracion')->insertBatch($data);
    }
}
