<?php

/**
 * Vista de catálogo de ventas
 *
 * Esta vista proporciona una tabla para mostrar las ventas con opciones
 * para ver y cancelar registro.
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-ci
 * @author mroblesdev
 */

$this->extend('plantilla/layout');
$this->section('contentido');

?>

<h4 class="mt-3" id="titulo">Ventas</h4>

<div class="centrado">
    <p>
        <a href="<?php echo site_url('ventas/bajas'); ?>" class="btn btn-warning btn-sm">Eliminadas</a>
    </p>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" id="dataTable" aria-describedby="titulo" style="width: 100%">
        <thead>
            <tr>
                <th>Folio</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th width="3%"></th>
                <th width="3%"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($ventas as $venta) : ?>
                <tr>
                    <td><?= $venta['folio']; ?></td>
                    <td><?= $venta['total']; ?></td>
                    <td><?= $venta['fecha']; ?></td>
                    <td><?= esc($venta['usuario']); ?></td>
                    <td>
                        <a href='<?= base_url('ventas/muestraTicket/' . $venta['id']); ?>' class='btn btn-primary btn-sm' rel='tooltip' data-bs-placement='top' title='Ver ticket'>
                            <span class='fas fa-list-alt'></span>
                        </a>
                    </td>

                    <td>
                        <a class='btn btn-danger btn-sm' href='#' data-bs-href='<?= base_url('ventas/' . $venta['id']); ?>' rel='tooltip' data-bs-toggle='modal' data-bs-target='#confirmaModal' data-bs-placement='top' title='Eliminar registro'>
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
                <h1 class="modal-title fs-5" id="confirmaModalLabel">Cancelar venta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea cancelar esta venta?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="post" id="form-elimina">
                    <input type="hidden" name="_method" value="delete">
                    <?= csrf_field(); ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Sí, cancelar</button>
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
                [0, "desc"]
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