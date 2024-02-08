<?php

/**
 * Vista para mostrar ticket
 *
 * Esta vista proporciona la caja para realizar ventas
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */


$this->extend('plantilla/layout');
$this->section('contentido');

?>

<div class="row mt-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="ratio ratio-16x9" style="margin-bottom: -20px;">
            <iframe src="<?php echo base_url('ventas/generaTicket/' . $idVenta); ?>" title="Ticket"></iframe>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>