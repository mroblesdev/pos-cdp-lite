<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetalleVenta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'venta_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'producto_id' => [
                'type'     => 'SMALLINT',
                'unsigned' => true,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
            ],
            'cantidad' => [
                'type' => 'SMALLINT',
            ],
            'precio' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('venta_id', 'ventas', 'id');
        $this->forge->createTable('detalle_ventas');
    }

    public function down()
    {
        $this->forge->dropTable('detalle_ventas');
    }
}
