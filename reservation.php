<?php
  ob_start();
  session_start();
  if (($_SESSION['login']=="ok_logged")) {
      include("apiConnect/connect.php");

      $con=$conn; ?>
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

        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <link rel="stylesheet" href="css/style_global.css">
        <!-- Custom styles for this template -->
        <link href="css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- JavaScript -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
        <!-- Bootstrap theme -->

    </head>

    <body id="page-top">

        <script type="text/javascript">
            function refresh_reserv_pending() {
                jQuery.ajax({
                    url: 'apiManagePanel/query_count_wait_reservations.php',
                    type: 'POST',
                    success: function (results) {
                        jQuery(".query_notpend").html(results);
                    }
                });
            }

            function refresh_reserv_complete() {
                jQuery.ajax({
                    url: 'apiManagePanel/query_count_complete_reservations.php',
                    type: 'POST',

                    success: function (results) {
                        jQuery(".query_complete").html(results);
                    }
                });
            }

            function refresh_reserv_total() {
                jQuery.ajax({
                    url: 'apiManagePanel/query_count_total_reservations.php',
                    type: 'POST',

                    success: function (results) {
                        jQuery(".query_total").html(results);
                    }
                });
            }

            function refresh_count_notif() {

                jQuery.ajax({
                    url: 'apiManagePanel/query_count_view_notifications.php',
                    type: 'POST',
                    success: function (results) {
                        jQuery(".badge-notify").html(results);
                    }
                });
            }

            /*tnotif = setInterval(refresh_count_notif, 1000);
            tp = setInterval(refresh_reserv_pending, 1000);
            tall = setInterval(refresh_reserv_complete, 1000);
            tt = setInterval(refresh_reserv_total, 1000);*/
        </script>

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-white sidebar sidebar-light accordion " id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand text-center d-flex align-items-center mt-3 mb-3 justify-content-center"
                    href="dashboard.php">

                    <img src="assets/image/goyan-logo.png" alt="Logo goyan" class="img-fluid sidebar-brand-icon"
                        width="60%">&nbsp;

                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item ">
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

                <li class="nav-item active">
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
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProv"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cheese"></i>
                        <span>Menús</span>
                    </a>
                    <div id="collapseProv" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Opciones:</h6>
                            <a class="collapse-item " href="menus.php">Mostrar todos</a>
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
                                    <button class="btn btn-primary" type="button">
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
                                                <button class="btn btn-primary" type="button">
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
                                    <h6 class="dropdown-header">
                                        Notificaciones
                                    </h6>

                                    <div id="notification-latest"></div>

                                    <a class="dropdown-item text-center small text-gray-500"
                                        href="notification-list.php">Mostrar todo</a>
                                </div>
                            </li>


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
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
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

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Panel de Reservaciones</h1>
                        </div>

                        <!-- Content CARDS ACCESS -->
                        <div class="row">

                            <!-- Card de resumen de total de productos -->
                            <div class="col-xl-4 col-md-4 mb-2">
                                <div class="card card-hover-style border-left-info  h-100">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Reservaciones en espera</div>
                                                <div class="h6 mb-0 text-gray-800 query_notpend">
                                                </div>

                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="reservation-wait.php" class="text-info">Mostrar mas detalles</a>
                                        <i class="fas faw fa-arrow-alt-circle-right ml-2 text-info"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- card de resumen de la cantidad de productos sin stock -->
                            <div class="col-xl-4 col-md-4 mb-2">
                                <div class="card card-hover-style border-left-warning h-100">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Reservaciones atendidas Hoy</div>
                                                <div class="h6 mb-0 text-gray-800 query_complete">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dolly fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="reservation-completed.php" class="text-warning"
                                            style="text-decoration: none;">Mostrar mas detalles</a>
                                        <i class="fas faw fa-arrow-alt-circle-right ml-2" style="color: #F7C649"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-2">
                                <div class="card card-hover-style border-left-success h-100">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total de reservaciones de hoy</div>
                                                <div class="h6 mb-0 text-gray-800 query_total">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <nav class="mt-4 d-none">
                            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active col-xl-4 col-md-4 card-hover-style"
                                    id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab"
                                    aria-controls="nav-pending" aria-selected="true">Reservaciones Pendientes</a>
                                <a class="nav-item nav-link col-xl-4 col-md-4 card-hover-style" id="nav-complete-tab"
                                    data-toggle="tab" href="#nav-complete" role="tab" aria-controls="nav-complete"
                                    aria-selected="false">Reservaciones Finalizadas</a>
                                <a class="nav-item nav-link col-xl-4 col-md-4 card-hover-style" id="nav-general-tab"
                                    data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general"
                                    aria-selected="false">General</a>
                            </div>
                        </nav>
                        <div class="tab-content d-none" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-pending" role="tabpanel"
                                aria-labelledby="nav-pending-tab">
                                <!-- Content Row -->
                            </div>
                        </div>

                        <?php
                        
                        $sql2="SELECT r.id_reservation, r.date_reservation, r.time_reservation, 
                            r.state_reservation, r.timecollect_reservation, tl.id_timelinereserv, tl.name_timelinereserv,
                            (SELECT c.firstname_customer FROM customer c WHERE r.id_customer = c.id_customer) As firstname,
                            (SELECT c.lastname_customer FROM customer c WHERE r.id_customer = c.id_customer) As lastname,
                            (SELECT SUM(dr.quantity_detres) FROM detail_reservation dr WHERE dr.id_reservation = r.id_reservation) As quantity_detres,
                            (SELECT SUM(dr.total_detres) FROM detail_reservation dr WHERE r.id_reservation = dr.id_reservation) As price
                            FROM reservation r
                            INNER JOIN timeline_reservation tl ON tl.id_timelinereserv = r.id_timelinereserv
                            ORDER BY `r`.`date_reservation` DESC, r.time_reservation DESC";
                        $result=mysqli_query($conn, $sql2);
                        ?>
                        <!-- DataTale -->
                        <div class="card  mb-2 card-hover-style" id="test">

                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Opciones</th>
                                                <th>Código Reserva</th>
                                                <th class="text-center">Cliente</th>
                                                <th class="text-center">Nro. Items</th>
                                                <th class="text-center">Monto Total</th>
                                                <th class="text-center">Hora de recojo</th>
                                                <th class="text-center">Estado</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Opciones</th>
                                                <th>Código Reserva</th>
                                                <th class="text-center">Cliente</th>
                                                <th class="text-center">Nro. Items</th>
                                                <th class="text-center">Monto Total</th>
                                                <th class="text-center">Hora de recojo</th>
                                                <th class="text-center">Estado</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                while ($row = mysqli_fetch_array($result)) {
                                                        $state = $row['name_timelinereserv'];
                                            ?>
                                            <tr>
                                                <td class="small align-content-center align-self-center text-center"
                                                    width=10%>
                                                    <a
                                                        href="reservation-detail.php?cdg=<?php echo $row["id_reservation"]; ?>">
                                                        <i class=" fas faw fa-eye mt-2 card-hover-style"
                                                            style="border-radius: 13px; padding: 10px;"
                                                            title="ver detalles" type="button">
                                                        </i>
                                                    </a>
                                                </td>
                                                <td class="small"><?php echo  $row["id_reservation"]; ?>
                                                </td>
                                                <td class="small"><?php echo  $row["firstname"]; ?>,
                                                    <?php echo $row["lastname"]; ?>
                                                </td>
                                                <td class="small text-center" width=10%>
                                                    <?php echo $row["quantity_detres"]; ?></td>
                                                <td class="small text-center" width=10%>S/. <?php echo $row["price"]; ?>
                                                </td>
                                                <td class="small text-center" width=10%>
                                                    <?php echo $row["timecollect_reservation"]; ?>
                                                </td>
                                                <td class="small text-center"><?php echo $state ?>
                                                </td>
                                            </tr>
                                            <?php
                                                } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Developed with &nbsp;<i class="fas fa-heart fa-sm fa-fw mr-2 text-danger"></i>by
                                Beginners</span>
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
                        <button class="btn btn-primary" type=" button" data-dismiss="modal">Cancelar</button>
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
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

        <!-- ALERTIFY -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />
    </body>
    <?php
  } else {
      header("location:index.php");
  }
ob_end_flush();

?>

</html>