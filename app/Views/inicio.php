<?php

$this->extend('plantilla/layout');
$this->section('contentido');

?>

<div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card bg-primary text-white mb-4 h-100">
            <div class="card-body"><?php echo $totalProductos; ?> Total de productos</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('productos'); ?>">View Details</a>
                <div class="small text-white">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card bg-success text-white mb-4 h-100">
            <div class="card-body"><?php echo number_format($totalVentas['total'], 2, '.', ','); ?> Ventas del día</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('productos'); ?>">Ver detalles</a>
                <div class="small text-white">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>