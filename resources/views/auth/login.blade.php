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
<link rel="icon" type="image/png" href="{{ asset('img/app/favicon.png"') }}">
<meta name="theme-color" content="black">

<title>Tareas</title>

<!-- Custom fonts for this template-->
<link rel="stylesheet" href="{{ node('@fortawesome/fontawesome-free/css/all.css') }}">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- SweetAlert -->
<link rel="stylesheet" href="{{ node('sweetalert2/dist/sweetalert2.css') }}">

<!-- Custom styles for this template-->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="bg-gradient-primary">

<div class="container">

<!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Iniciar sesión</h1>
                                </div>
                                
                                <form class="user" method="POST" action="/login">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" placeholder="Correo electrónico" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" required placeholder="Contraseña">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-secondary password" placeholder="Contraseña">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Recuérdame</label>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-block submit">Iniciar sesión</button>

                                    <hr>
                                </form>

                                <div class="text-center">
                                    <a class="small" href="/forgot">¿Olvidó su contraseña?</a>
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
<script src="{{ node('jquery/dist/jquery.js') }}"></script>
<script src="{{ node('bootstrap/dist/js/bootstrap.bundle.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ node('jquery.easing/jquery.easing.js') }}"></script>

<!-- SweetAlert -->
<script src="{{ node('sweetalert2/dist/sweetalert2.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/main.js') }}"></script>

<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
