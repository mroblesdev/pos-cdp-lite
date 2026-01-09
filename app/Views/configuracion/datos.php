<?php

$this->extend('plantilla/layout');
$this->section('contenido');

?>

<h4 class="mt-3">Datos de la tienda</h4>

<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null) : ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<?php if (session()->getFlashdata('success') !== null) : ?>
    <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="row g-3" method="post" action="<?= base_url('datos'); ?>" autocomplete="off">
    <input type="hidden" name="_method" value="PUT">
    <?= csrf_field(); ?>

    <div class="col-md-7">
        <label for="tienda_nombre" class="form-label"><span class="text-danger">*</span> Nombre</label>
        <input type="text" class="form-control" id="tienda_nombre" name="tienda_nombre" value="<?= esc($datos['tienda_nombre']); ?>" required>
    </div>

    <div class="col-md-5">
        <label for="tienda_telefono" class="form-label"><span class="text-danger">*</span> Teléfono</label>
        <input type="text" class="form-control" id="tienda_telefono" name="tienda_telefono" value="<?= esc($datos['tienda_telefono']); ?>" required>
    </div>

    <div class="col-md-12">
        <label for="tienda_direccion" class="form-label"><span class="text-danger">*</span> Dirección</label>
        <input type="text" class="form-control" id="tienda_direccion" name="tienda_direccion" value="<?= esc($datos['tienda_direccion']); ?>" required>
    </div>

    <div class="col-md-7">
        <label for="ticket_leyenda" class="form-label"><span class="text-danger">*</span> Leyenda de ticket</label>
        <input type="text" class="form-control" id="ticket_leyenda" name="ticket_leyenda" value="<?= esc($datos['ticket_leyenda']); ?>" required>
    </div>

    <div class="col-md-5">
        <label for="ventas_folio" class="form-label"><span class="text-danger">*</span> Folio de venta</label>
        <input type="text" class="form-control" id="ventas_folio" name="ventas_folio" value="<?= esc($datos['ventas_folio']); ?>" required>
    </div>

    <div class="col-12">
        <p class="fst-italic">
            Campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.
        </p>
    </div>

    <div class="col-12">
        <a href="<?= base_url('inicio'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php $this->endSection(); ?>