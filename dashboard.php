<?php
  ob_start();
  session_start();
  if(($_SESSION['login']=="ok_logged")){
    include("apiConnect/connect.php");

      $con=$conn;

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>GOYAN Catering - Panel de Control</title>

        <link rel="shortcut icon" href="assets/image/goyan-logo.png" type="image/png">

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style_dashboard.css">
        <link rel="stylesheet" href="css/style_global.css">

    </head>

    <body id="page-top">

        <script>
            function refresh_count_notif() {

                jQuery.ajax({
                    url: 'apiManagePanel/query_count_view_notifications.php',
                    type: 'POST',
                    success: function (results) {
                        jQuery(".badge-notify").html(results);
                    }
                });
            }

            tnotif = setInterval(refresh_count_notif, 5000);
        </script>

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-white sidebar sidebar-light accordion " id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand text-center d-flex align-items-center mt-3 mb-3 justify-content-center"
                    href="">

                    <img src="assets/image/goyan-logo.png" alt="Logo goyan" class="img-fluid sidebar-brand-icon"
                        width="60%">&nbsp;

                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link " href="dashboard.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span class="">Panel de Control</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Pendiente
                </div>

                <li class="nav-item">
                    <a class="nav-link " href="notification-list.php">
                        <i class="fas fa-fw fa-bell"></i>
                        <span>Notificaciones</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="reservation.php">
                        <i class="fas fa-fw fa-bolt"></i>
                        <span>Panel de reservas</span>
                    </a>
                </li>

                <!-- Heading -->
                <div class="sidebar-heading">
                    Inventario
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-box-open"></i>
                        <span>Productos</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Opciones:</h6>
                            <a class="collapse-item" href="products.php">Mostrar Todo</a>
                            <!--<a class="collapse-item" href="">Recien añadidos</a>
                            <a class="collapse-item" href="">Por acabarse</a>
                            <a class="collapse-item" href="">Sin Stock</a>-->
                        </div>
                    </div>
                </li>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProv"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cheese"></i>
                        <span>Menús</span>
                    </a>
                    <div id="collapseProv" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Opciones:</h6>
                            <a class="collapse-item" href="menus.php">Mostrar todos</a>
                            <!--<a class="collapse-item" href="">Gráficos</a>
                            <a class="collapse-item" href="">Buscar y filtrar</a>
                            <a class="collapse-item" href="">Observaciones</a>-->
                        </div>
                    </div>
                </li>
                <!-- Heading -->
                <div class="sidebar-heading">
                    Salida
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVenta"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                        <span>Ventas</span>
                    </a>
                    <div id="collapseVenta" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Opciones:</h6>
                            <a class="collapse-item" href="">Mostrar todos</a>
                            <a class="collapse-item" href="">Movimientos recientes</a>
                            <a class="collapse-item" href="">Gráficos</a>
                            <a class="collapse-item" href="">Buscar y filtrar</a>
                            <a class="collapse-item" href="">Observaciones</a>
                        </div>
                    </div>
                </li>
                <!-- Heading -->
                <div class="sidebar-heading">
                    Empresa
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmp"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Empleados</span>
                    </a>
                    <div id="collapseEmp" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Opciones:</h6>
                            <a class="collapse-item" href="">Mostrar todos</a>
                            <a class="collapse-item" href="">Historial de ventas</a>
                            <a class="collapse-item" href="">Gráficos</a>
                            <a class="collapse-item" href="">Buscar y filtrar</a>
                            <a class="collapse-item" href="">Observaciones</a>

                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#">
                        <i class="fas fa-fw fa-briefcase"></i>
                        <span>Cargos</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

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
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top ">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar"
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Buscar" aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-warning" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a id="dropdown-notif-nav" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    onclick="clickDropdowNotif()">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <div id="notification-count" class="badge badge-danger badge-counter badge-notify">
                                    </div>
                                </a>

                                <script type="text/javascript">
                                    function clickDropdowNotif() {
                                        var droppop = document.getElementById("dropdown-notif");
                                        if (droppop.style.display === "none") {
                                            droppop.style.display = "block";
                                        } else {
                                            droppop.style.display = "none";
                                        }

                                        $.ajax({
                                            url: "apiManagePanel/query_latest_notifications.php",
                                            type: "POST",
                                            processData: false,
                                            success: function (data) {
                                                $("#notification-latest").show();
                                                $("#notification-latest").html(data);
                                            },
                                            error: function () {}
                                        });

                                        $(document).ready(function () {
                                            $('body').click(function (e) {
                                                if (e.target.id != 'dropdown-notif-nav') {
                                                    $("#dropdown-notif").hide();
                                                }
                                            });
                                        });

                                    }
                                </script>

                                <!-- Dropdown - Alerts -->
                                <div id="dropdown-notif"
                                    class="dropdown-list  dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown" style="display: none;">
                                    <h6 class="dropdown-header bg-warning active">
                                        Notificaciones
                                    </h6>
                                    <div id="notification-latest"></div>

                                    <a class="dropdown-item text-center small text-gray-500"
                                        href="notification-list.php">Mostrar todo</a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $_SESSION['fname_user'].", ".$_SESSION['lname_user']." "; ?></span>
                                    <img class="img-profile rounded-circle"
                                        src="https://source.unsplash.com/CS2uCrpNzJY/60x60">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Perfil
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Configuración
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-info-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Información
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cerrar Sesión
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- CABECERA DE PAGINA -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Panel General</h1>
                            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary  -sm"><i
                                    class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generar Reporte</a>-->
                        </div>

                        <!-- Content CARDS ACCESS -->
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card card-hover-style border-left-primary  h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Nro. Ventas Mensuales</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card card-hover-style border-left-success h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    N. Ventas diarias</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card card-hover-style border-left-info h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Items recien agregados</div>
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card card-hover-style border-left-danger h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    Solicitudes pendientes</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-bolt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Content CHARTS -->

                        <div class="row">

                        </div>



                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="text-center my-auto">
                            <span>Developed with <i class="fas fa-heart fa-sm fa-fw mr-2 text-danger"></i></span>
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

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">¿Desea cerrar la Sesión actual?</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger" type="submit" name="submit_logout" href="logout_user.php">Cerrar
                            Sesión</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

    </body>
    <?php

}else{
   header("location:index.php");
}
ob_end_flush();

?>

</html>