<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Configuracion extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'SMALLINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '50'
            ],
            'valor' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('configuracion');
    }

    public function down()
    {
        $this->forge->dropTable('configuracion');
    }
}
