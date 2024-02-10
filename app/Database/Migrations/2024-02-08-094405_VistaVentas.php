<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VistaVentas extends Migration
{
    public function up()
    {
        $this->db->query("CREATE VIEW v_ventas AS
        SELECT v.id, v.folio, v.total, v.fecha, v.activo, u.nombre AS usuario
        FROM ventas AS v
        INNER JOIN usuarios AS u ON v.usuario_id = u.id;");

    }

    public function down()
    {
        $this->db->query("DROP VIEW IF EXISTS v_ventas;");
    }
}
