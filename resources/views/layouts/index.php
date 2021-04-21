<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">

<!-- Metadata -->

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="mobile-web-app-capable" content="yes">
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicon -->
<link rel="icon" type="image/png" href="<?php asset('img/app/favicon.png'); ?>">
<meta name="theme-color" content="black">

<title>Tareas</title>

<!-- Custom fonts for this template-->
<link rel="stylesheet" href="<?php node('@fortawesome/fontawesome-free/css/all.css'); ?>">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Datatables -->
<link rel="stylesheet" href="<?php node('datatables.net-bs4/css/dataTables.bootstrap4.css'); ?>">

<!-- SweetAlert -->
<link rel="stylesheet" href="<?php node('sweetalert2/dist/sweetalert2.css'); ?>">

<!-- Lightbox -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.css">

<!-- Custom styles for this template-->
<link rel="stylesheet" href="<?php asset('css/style.css'); ?>">

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
				<div class="sidebar-brand-icon rotate-n-15">
					<!-- Logo here -->
				</div>
				<div class="">Tareas</div>
			</a>

			<li class="nav-item mb-3 active">
				<a class="nav-link menu" href="/dashboard">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<div class="sidebar-heading mt-3">Proyectos</div>

			<?php foreach (projects() as $project): ?>
				<li class="nav-item">
					<a class="nav-link menu" href="<?php echo '/projects/' . $project->slug; ?>">
						<i class="<?php echo $project->icon; ?>" style="<?php echo 'color: ' . $project->color; ?>"></i>
						<span><?php echo $project->name; ?></span>
					</a>
				</li>
			<?php endforeach; ?>

      		<hr class="sidebar-divider mt-3 mb-5">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->

    	<!-- Content Wrapper -->
    	<div id="content-wrapper" class="d-flex flex-column">

      		<!-- Main Content -->
      		<div id="content">

        		<!-- Topbar -->
        		<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          			<!-- Sidebar Toggle (Topbar) -->
          			<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            			<i class="fa fa-bars"></i>
          			</button>

          			<!-- Topbar Navbar -->
          			<ul class="navbar-nav ml-auto">

            			<!-- Nav Item - User Information -->
            			<li class="nav-item dropdown no-arrow">
            				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            					<span class="mr-2 d-none d-lg-inline text-gray-600 small username"><?php echo auth()->name; ?></span>
            					<img class="img-profile rounded-circle" src="<?php echo (auth()->photo != '') ? auth()->photo : asset('img/app/user.png'); ?>">
              				</a>
              				
              				<!-- Dropdown - User Information -->
              				<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              					<a class="dropdown-item profile" href="<?php echo '/users/edit/' . auth()->id ?>">
              						<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              						Perfil
              					</a>

              					<div class="dropdown-divider"></div>

              					<a class="dropdown-item" href="/logout" data-toggle="modal" data-target="#logoutModal">
              						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              						Cerrar sesión
              					</a>
              				</div>
              			</li>
              		</ul>
              	</nav>
              	<!-- End of Topbar -->

              	<div class="content">
              		             		
              	</div>

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Todos los derechos reservados &copy; Nisa Delgado 2020</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

	    </div>
	    <!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<?php include 'logout.php'; ?>

	<!-- Bootstrap core JavaScript-->
	<script src="<?php node('jquery/dist/jquery.js'); ?>"></script>
	<script src="<?php node('bootstrap/dist/js/bootstrap.bundle.js'); ?>"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?php node('jquery.easing/jquery.easing.js'); ?>"></script>

	<!-- Datatables -->
	<script src="<?php node('datatables.net/js/jquery.dataTables.js'); ?>"></script>
	<script src="<?php node('datatables.net-bs4/js/dataTables.bootstrap4.js'); ?>"></script>
	<script src="<?php node('datatables.net-fixedheader/js/dataTables.fixedHeader.js'); ?>"></script>
	<script src="<?php node('datatables.net-responsive/js/dataTables.responsive.js'); ?>"></script>
	<script src="<?php node('datatables.net-responsive-bs4/js/responsive.bootstrap4.js'); ?>"></script>

	<!-- SweetAlert -->
	<script src="<?php node('sweetalert2/dist/sweetalert2.js'); ?>"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.js·"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?php asset('js/main.js'); ?>"></script>

	<script src="<?php asset('js/layout.js'); ?>"></script>

</body>

</html>
