<?php

/**
 * Vista para mostrar mensajes
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
        <h3><?= $mensaje; ?></h3>
    </div>
</div>

<?php $this->endSection(); ?>