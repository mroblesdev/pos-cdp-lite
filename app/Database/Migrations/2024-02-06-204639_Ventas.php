<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ventas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'folio' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'total' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'fecha' => [
                'type' => 'DATETIME',
            ],
            'usuario_id' => [
                'type'     => 'SMALLINT',
                'unsigned' => true,
            ],
            'activo' => [
                'type' => 'TINYINT',
            ],
            'fecha_alta' => [
                'type' => 'DATETIME',
            ],
            'fecha_modifica' => [
                'type'       => 'DATETIME',
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id');
        $this->forge->createTable('ventas');
    }

    public function down()
    {
        $this->forge->dropTable('ventas');
    }
}
