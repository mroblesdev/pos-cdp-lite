<?php

/**
 * Vista para crear reporte de ventas
 *
 * Esta vista proporciona el formulario para generar el reporte de ventas por fechas
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

$this->extend('plantilla/layout');

$this->section('contenido');
?>

<h4 class="mt-3">Reporte de ventas</h4>

<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null) : ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form id="form_venta" method="post" action="<?php echo base_url('reportes/ventas'); ?>" autocomplete="off">
    <?= csrf_field(); ?>

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-4">
                <label><span class="text-danger">*</span> Fecha de inicio:</label>
                <input type='date' id="fecha_inicio" name="fecha_inicio" class="form-control" required1>
            </div>

            <div class="col-12 col-sm-4">
                <label><span class="text-danger">*</span> Fecha de fin:</label>
                <input type='date' id="fecha_fin" name="fecha_fin" class="form-control" required1>
            </div>


            <div class="col-12 col-sm-4">
                <label><span class="text-danger">*</span> Estado:</label>
                <select name="estado" id="estado" class="form-select" required1>
                    <option value="1">Activas</option>
                    <option value="0">Canceladas</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-12 mt-3">
        <p class="fst-italic">
            Campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.
        </p>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-4">
                <button type="submit" class="btn btn-success">Generar</button>
            </div>
        </div>
    </div>
</form>

<?php $this->endSection(); ?>