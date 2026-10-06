<?php

$this->extend('plantilla/layout');
$this->section('contenido');

$maximoDia = max(array_column($ventasPorDia, 'total'));

?>

<div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card bg-primary text-white h-100">
            <div class="card-body">
                <div class="fs-2 fw-bold"><?php echo $totalProductos; ?></div>
                Total de productos
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('productos'); ?>">Ver detalles</a>
                <div class="small text-white">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card bg-success text-white h-100">
            <div class="card-body">
                <div class="fs-2 fw-bold">$<?php echo number_format($ventasDia['total'], 2, '.', ','); ?></div>
                Ventas del día (<?php echo $ventasDia['tickets']; ?> tickets)
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('ventas'); ?>">Ver detalles</a>
                <div class="small text-white">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card bg-info text-dark h-100">
            <div class="card-body">
                <div class="fs-2 fw-bold">$<?php echo number_format($ventasMes['total'], 2, '.', ','); ?></div>
                Ventas del mes (<?php echo $ventasMes['tickets']; ?> tickets)
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-dark stretched-link" href="<?php echo base_url('reportes/crea_ventas'); ?>">Ver reporte</a>
                <div class="small text-dark">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card bg-warning text-dark h-100">
            <div class="card-body">
                <div class="fs-2 fw-bold"><?php echo $totalExistenciasBajas; ?></div>
                Productos con poco stock
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-dark stretched-link" href="<?php echo base_url('productos'); ?>">Ver productos</a>
                <div class="small text-dark">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-7 mb-4">
        <div class="card h-100">
            <div class="card-header"><i class="fa-solid fa-chart-column me-1"></i> Ventas de los últimos <?php echo count($ventasPorDia); ?> días</div>
            <div class="card-body d-flex align-items-end justify-content-around" style="min-height: 290px; gap: 14px;">
                <?php foreach ($ventasPorDia as $dia) { ?>
                    <?php $alto = $maximoDia > 0 ? round($dia['total'] / $maximoDia * 200) : 0; ?>
                    <div class="text-center flex-fill">
                        <div class="d-flex flex-column justify-content-end" style="height: 230px;">
                            <div class="small fw-semibold mb-1">$<?php echo number_format($dia['total'], 0, '.', ','); ?></div>
                            <div class="bg-primary rounded-top flex-shrink-0" style="height: <?php echo $alto; ?>px;"></div>
                        </div>
                        <div class="small text-muted mt-1"><?php echo $dia['etiqueta']; ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-xl-5 mb-4">
        <div class="card h-100">
            <div class="card-header"><i class="fa-solid fa-trophy me-1"></i> Productos más vendidos</div>
            <table class="table table-sm table-striped mb-0">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th class="text-end">Piezas</th>
                        <th class="text-end">Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($masVendidos as $producto) { ?>
                        <tr>
                            <td><?php echo esc($producto['nombre']); ?></td>
                            <td class="text-end"><?php echo $producto['cantidad']; ?></td>
                            <td class="text-end">$<?php echo number_format($producto['importe'], 2, '.', ','); ?></td>
                        </tr>
                    <?php } ?>
                    <?php if (empty($masVendidos)) { ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Aún no hay ventas registradas.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
