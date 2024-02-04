<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TemporalCaja extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'SMALLINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_venta' => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
            ],
            'id_producto' => [
                'type'     => 'SMALLINT',
                'unsigned' => true,
            ],
            'codigo' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'cantidad' => [
                'type'     => 'SMALLINT',
                'unsigned' => true,
            ],
            'precio' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'importe' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('temporal_caja');
    }

    public function down()
    {
        $this->forge->dropTable('temporal_caja');
    }
}
