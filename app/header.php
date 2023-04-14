<?php
if (!isset($_SESSION["usu_id"])) {
    header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="icon" href="icon.png" type="image/png">

    <title>Veterinaria Messavet</title>

    <!-- Custom fonts for this template-->
    <link href="view/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="view/public/css/nunito.css" rel="stylesheet" type="text/css">
    
    <!-- Custom styles for this template-->
    <link href="view/public/css/sb-admin-2.css" rel="stylesheet">
    <!-- <link href="view/public/css/select.dataTables.min.css" rel="stylesheet">
    <link href="view/public/gijgo/gijgo.min.css" rel="stylesheet"> -->
    <!-- Bootstrap core JavaScript-->
    <script src="view/public/vendor/jquery/jquery.min.js"></script>
    <script src="view/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

<body id="page-top" >

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Veterinaria</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Menu -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?vista=veterinarios">
                <i class="fas fa-stethoscope"></i>
                    <span>Veterinarios</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?vista=clientes">
                <i class="fas fa-users"></i>
                    <span>Clientes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?vista=animales">
                <i class="fas fa-horse-head"></i>
                    <span>Animales</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?vista=citas">
                <i class="far fa-calendar-check"></i>
                    <span>Citas</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            
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

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['usu_nom'] . " " . $_SESSION['usu_ape']; ?></span>
                                <i class="fas fa-user fa-sm fa-fw text-secondary rounded-circle"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
