<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= lang('App.siteName'); ?></title>

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
                                    <h3 class="text-center font-weight-light my-4"><?= lang('App.loginTitle'); ?></h3>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('login'); ?>" method="post" autocomplete="off">
                                        <?= csrf_field(); ?>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" name="username" type="text" placeholder="<?= lang('App.loginUsername'); ?>" />
                                            <label for="username"><?= lang('App.loginUsername'); ?></label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" name="password" type="password" placeholder="<?= lang('App.loginPassword'); ?>" />
                                            <label for="password"><?= lang('App.loginPassword'); ?></label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary"><?= lang('App.loginBtnLogin'); ?></button>
                                        </div>
                                    </form>

                                    <?php
                                    if (isset($validation)) {
                                        echo $validation->listErrors('my_list');
                                    }
                                    ?>
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
                        <div class="text-muted"><?= lang('App.siteCopyright', [date('Y')]); ?></div>
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