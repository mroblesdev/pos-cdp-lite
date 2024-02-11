<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="<?= base_url('productos'); ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-basket-shopping"></i></div>
                    Productos
                </a>

                <a class="nav-link" href="<?= base_url('caja'); ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cash-register"></i></div>
                    Caja
                </a>

                <a class="nav-link" href="<?= base_url('ventas'); ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                    Ventas
                </a>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReportes" aria-expanded="false" aria-controls="collapseReportes">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list-alt"></i></div>
                    Reportes
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseReportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?php echo base_url('reportes/crea_ventas'); ?>">Reporte de ventas</a>
                        <a class="nav-link" href="<?php echo base_url('reportes/productos'); ?>">Reporte de productos</a>
                    </nav>
                </div>

                <a class="nav-link" href="<?= base_url('datos'); ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                    Datos de la tienda
                </a>
            </div>
        </div>
    </nav>
</div>