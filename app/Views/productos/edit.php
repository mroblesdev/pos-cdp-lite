<?php

$this->extend('plantilla/layout');
$this->section('contenido');

?>

<h4 class="mt-3">Modificar producto</h4>

<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null) : ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="row g-3" method="post" action="<?= base_url('productos/' . $producto['id']); ?>" autocomplete="off">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?= $producto['id'] ?>">

    <div class="col-md-3">
        <label for="codigo" class="form-label"><span class="text-danger">*</span> Código de barras</label>
        <input type="text" class="form-control" id="codigo" name="codigo" value="<?= esc($producto['codigo']); ?>" required autofocus>
    </div>

    <div class="col-md-9">
        <label for="nombre" class="form-label"><span class="text-danger">*</span> Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= esc($producto['nombre']); ?>" required>
    </div>

    <div class="col-md-4">
        <label for="precio" class="form-label"><span class="text-danger">*</span> Precio</label>
        <input type="text" class="form-control" id="precio" name="precio" value="<?= esc($producto['precio']); ?>" onkeypress="return validateDecimal(this.value);" required>
    </div>

    <div class="col-md-4">
        <label for="inventariable" class="form-label"><span class="text-danger">*</span> Es inventariable</label>
        <select class="form-select" name="inventariable" id="inventariable" required>
            <option value="1" <?php echo ($producto['inventariable'] == 1) ? 'selected' : '' ?>>Si</option>
            <option value="0" <?php echo ($producto['inventariable'] == 0) ? 'selected' : '' ?>>No</option>
        </select>
    </div>


    <div class="col-md-4">
        <label for="existencia" class="form-label">Existencia actual</label>
        <input type="text" class="form-control" id="existencia" name="existencia" value="<?= esc($producto['existencia']); ?>" <?php echo ($producto['inventariable'] == 0) ? 'readonly' : ''; ?>>
    </div>

    <div class="col-12">
        <p class="fst-italic">
            Campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.
        </p>
    </div>

    <div class="col-12">
        <a href="<?= base_url('productos'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php
$this->endSection();
$this->section('script');
?>

<script>
    document.addEventListener("keypress", function(e) {
        let code = e.keyCode || e.which;
        if (code === 13) {
            e.preventDefault();
            return false;
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        let inventariableSelect = document.getElementById("inventariable");
        let existenciaInput = document.getElementById("existencia");

        inventariableSelect.addEventListener("change", function() {
            let option = inventariableSelect.options[inventariableSelect.selectedIndex].value;

            if (option == 1) {
                existenciaInput.readOnly = false;
            } else {
                existenciaInput.readOnly = true;
            }

            existenciaInput.value = 0;
        });
    });

    function validateDecimal(valor) {
        let re = /^\d*\.?\d*$/;
        return re.test(valor);
    }
</script>


<?php $this->endSection(); ?>