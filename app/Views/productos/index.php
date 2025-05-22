<?php

$this->extend('plantilla/layout');
$this->section('contenido');

?>

<h4 class="mt-3" id="titulo">Productos</h4>

<div class="centrado">
    <p>
        <a href="<?= base_url('productos/new'); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Nuevo
        </a>
        <a href="<?= base_url('productos/baja'); ?>" class="btn btn-warning btn-sm">
            Eliminados
        </a>
    </p>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" id="dataTable" aria-describedby="titulo" style="width: 100%">
        <thead>
            <tr>
                <th>C&oacute;digo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Existencia</th>
                <th style="width: 3%"></th>
                <th style="width: 3%"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($productos as $producto) : ?>
                <tr>
                    <td><?= esc($producto['codigo']); ?></td>
                    <td><?= esc($producto['nombre']); ?></td>
                    <td><?= $producto['precio']; ?></td>
                    <td><?= $producto['existencia']; ?></td>
                    <td>
                        <a class='btn btn-warning btn-sm' href='<?= base_url('productos/' . $producto['id'] . '/edit'); ?>' rel='tooltip' data-bs-placement='top' title='Modificar registro'>
                            <span class='fas fa-edit'></span>
                        </a>
                    </td>
                    <td>
                        <a class='btn btn-danger btn-sm' href='#' data-bs-href='<?= base_url('productos/' . $producto['id']); ?>' rel='tooltip' data-bs-toggle='modal' data-bs-target='#confirmaModal' data-bs-placement='top' title='Eliminar registro'>
                            <span class='fa-solid fa-trash'></span>
                        </a>
                    </td>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class=" modal fade" id="confirmaModal" tabindex="-1" aria-labelledby="confirmaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="confirmaModalLabel">Eliminar registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="post" id="form-elimina">
                    <input type="hidden" name="_method" value="delete">
                    <?= csrf_field(); ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$this->endSection();
$this->section('script');
?>

<script>
    $(document).ready(function(e) {

        $('#dataTable').DataTable({
            "language": {
                "url": "<?= base_url('js/DatatablesSpanish.json'); ?>"
            },
            "pageLength": 10,
            "order": [
                [0, "asc"]
            ]
        });
    });

    const confirmaModal = document.getElementById('confirmaModal')
    confirmaModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const url = button.getAttribute('data-bs-href')

        const formElimina = confirmaModal.querySelector('.modal-footer #form-elimina')
        formElimina.action = url
    })
</script>

<?php $this->endSection(); ?>