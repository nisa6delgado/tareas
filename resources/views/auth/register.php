<!DOCTYPE html>
<html lang="en">
<head>

<!-- Metadata -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="mobile-web-app-capable" content="yes">
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicon -->
<link rel="icon" type="image/png" href="<?php asset('img/app/favicon.png" '); ?>">
<meta name="theme-color" content="black">

<title>Tareas</title>

<!-- Custom fonts for this template-->
<link rel="stylesheet" href="<?php node('@fortawesome/fontawesome-free/css/all.css'); ?>">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- SweetAlert -->
<link rel="stylesheet" href="<?php node('sweetalert2/dist/sweetalert2.css'); ?>">

<!-- Custom styles for this template-->
<link rel="stylesheet" href="<?php asset('css/style.css'); ?>">
</head>

<body class="bg-gradient-primary">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Registro</h1>
                                </div>

                                <form class="user" method="POST" action="/logup">
                                    <?php if (message('error')): ?>
                                        <div class="alert alert-danger"><?php echo message('error'); ?></div>
                                    <?php endif; ?>
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <input type="text" name="name" class="form-control" placeholder="Nombre" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" placeholder="Correo electr??nico" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Contrase??a" name="password" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-secondary password">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirmar contrase??a" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-secondary password">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary btn-block submit">Registrar</button>
                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="/forgot">??Olvido su contrase??a?</a>
                                </div>

                                <div class="text-center">
                                    <a class="small" href="/login">??Ya tiene una cuenta? ??Inicia sesi??n!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php node('jquery/dist/jquery.js'); ?>"></script>
<script src="<?php node('bootstrap/dist/js/bootstrap.bundle.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php node('jquery.easing/jquery.easing.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php asset('js/main.js'); ?>"></script>

<!-- SweetAlert -->
<script src="<?php node('sweetalert2/dist/sweetalert2.js'); ?>"></script>

<script src="<?php asset('js/register.js'); ?>"></script>

</body>
</html>
