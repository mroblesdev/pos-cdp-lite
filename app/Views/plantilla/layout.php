<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistema Punto de Venta CDP Lite" />
    <meta name="author" content="MRoblesDev" />
    <title>Sistema Punto de Venta CDP Lite v1.0</title>
    <link rel="icon" href="<?= base_url('images/favicon.png'); ?>" sizes="32x32" />

    <!-- Carga template SB Admin -->
    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet" />
    <!-- Carga Font Awesome -->
    <link href="<?= base_url('css/all.min.css'); ?>" rel="stylesheet" />

    <!-- Page level plugin CSS-->
    <link href="<?= base_url('assets/datatables/datatables.min.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/jquery-ui/jquery-ui.min.css'); ?>" rel="stylesheet">

    <?php $this->renderSection('style'); ?>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?= base_url('inicio'); ?>">POS CDP Lite</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav d-none d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i> <?= $_SESSION['usuarioNombre']; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= base_url('cambia-password'); ?>">Cambiar contraseña</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('logout'); ?>">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">

        <?= $this->include('plantilla/menu'); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?php $this->renderSection('contentido'); ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted"><?= 'MRoblesDev © ' . date('Y'); ?></div>
                        <div>
                            <a href="https://github.com/mroblesdev/pos-cdp-lite">
                                <i class="fa-brands fa-github"></i> GitHub
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>" crossorigin="anonymous"></script>

    <script src="<?= base_url('js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <script src="<?= base_url('assets/datatables/datatables.min.js'); ?>"></script>
    <script src="<?= base_url('js/scripts.js'); ?>"></script>

    <?php $this->renderSection('script'); ?>

</body>

</html>