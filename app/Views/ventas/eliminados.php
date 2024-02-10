<?php

/**
 * Vista de catálogo de ventas canceladas
 *
 * Esta vista proporciona una tabla para mostrar las ventas canceladas
 * con opción para ver ticket de venta.
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-ci
 * @author mroblesdev
 */

$this->extend('plantilla/layout');
$this->section('contentido');

?>

<h4 class="mt-3" id="titulo">Ventas canceladas</h4>

<div class="centrado">
    <p>
        <a href="<?php echo base_url('ventas'); ?>" class="btn btn-primary btn-sm">Ventas</a>
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
                <?php endforeach; ?>
        </tbody>
    </table>
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
</script>

<?php $this->endSection(); ?>