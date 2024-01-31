<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistema Punto de Venta CDP Lite v1.0</title>

    <!-- Carga template SB Admin -->
    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet" />
    <!-- Carga Font Awesome -->
    <link href="<?= base_url('css/all.min.css'); ?>" rel="stylesheet" />
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
                                    <h3 class="text-center font-weight-light my-4">Iniciar sesión</h3>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('login'); ?>" method="post" autocomplete="off">
                                        <?= csrf_field(); ?>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Usuario" required1 autofocus />
                                            <label for="usuario">Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" required1 />
                                            <label for="password">Contraseña</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">Ingresar</button>
                                        </div>
                                    </form>

                                    <?php if (!empty($errors)) : ?>
                                        <div class="alert alert-danger my-3" role="alert">
                                            <ul>
                                                <?php foreach ($errors as $error) : ?>
                                                    <li><?= esc($error) ?></li>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted"><?= 'MRoblesDev © ' . date('Y'); ?></div>
                        <div>
                            <a href="https://github.com/mroblesdev/pos-cdp-lite"><i class="fa-brands fa-github"></i> GitHub</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--<script src="js/scripts.js"></script>-->
</body>

</html>