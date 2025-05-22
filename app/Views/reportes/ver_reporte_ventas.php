<?php

/**
 * Vista para mostrar el reporte de ventas
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */


$this->extend('plantilla/layout');
$this->section('contenido');

?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="ratio" style="--bs-aspect-ratio: 54%;">
            <iframe src="<?php echo base_url('reportes/genera_ventas/' . $post['fecha_inicio'] . '/' . $post['fecha_fin'] . '/' . $post['estado']); ?>" title="Reporte de Ventas"></iframe>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>