<?php

$this->extend('plantilla/layout');
$this->section('contenido');

?>

<h4 class="my-3">Cambiar contraseña</h4>

<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null) : ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-8" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<!-- Mensajes de éxito -->
<?php if (session()->getFlashdata('success') !== null) : ?>
    <div class="alert alert-success alert-dismissible fade show col-md-8" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="g-3" method="post" action="<?= base_url('cambia-password'); ?>" autocomplete="off">

    <?= csrf_field(); ?>
    <input type="hidden" id="id_usuario" name="id_usuario" value="<?= $usuario->usuarioId; ?>">

    <div class="row mb-3">
        <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $usuario->usuarioNombre; ?>" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <label for="password" class="col-sm-2 col-form-label">Nueva contraseña</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" id="password" name="password" required autofocus>
        </div>
    </div>

    <div class="row mb-3">
        <label for="con_password" class="col-sm-2 col-form-label">Confirmar contraseña</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" id="con_password" name="con_password" required autofocus>
        </div>
    </div>

    <div class="col-12 mt-3">
        <a href="<?= base_url('inicio'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php
$this->endSection();
$this->section('script');
?>


<?php $this->endSection(); ?>