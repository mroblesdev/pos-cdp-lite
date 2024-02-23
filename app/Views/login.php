<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="MRoblesDev" />
    <title>Sistema Punto de Venta CDP Lite v1.0</title>
    <link rel="icon" href="<?= base_url('images/logotipo.png'); ?>" sizes="32x32" />

    <!-- Carga template SB Admin -->
    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet" />
    <!-- Carga Font Awesome -->
    <link href="<?= base_url('css/all.min.css'); ?>" rel="stylesheet" />

    <style>
        body {
            background-image: url("<?php echo base_url('images/background_pos.jpg'); ?>");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="bg-light">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-2"><img src="<?php echo base_url('images/logotipo.png'); ?>" width="64">&nbsp; Punto de Venta CDP Lite</h3>

                                </div>
                                <div class="card-body">
                                    <h3 class="text-center font-weight-light mb-3">Iniciar sesión</h3>
                                    <form action="<?= base_url('login'); ?>" method="post" autocomplete="off">
                                        <?= csrf_field(); ?>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Usuario" required autofocus>
                                            <label for="usuario">Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" required>
                                            <label for="password">Contraseña</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">Ingresar</button>
                                        </div>
                                    </form>

                                    <!-- Mensajes de validación -->
                                    <?php if (session()->getFlashdata('errors') !== null) : ?>
                                        <div class="alert alert-danger my-3" role="alert">
                                            <?= session()->getFlashdata('errors'); ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <b class="text-end pe-4">Ver. Lite 1.0.0 &nbsp; </b>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-3">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">POS CDP Lite - <?= date('Y'); ?> MRoblesDev</div>
                        <div>
                            <a href="https://github.com/mroblesdev/pos-cdp-lite"><i class="fa-brands fa-github"></i> GitHub</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>