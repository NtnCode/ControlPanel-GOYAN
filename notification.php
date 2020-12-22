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

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <link rel="stylesheet" href="css/style_notification.css">
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
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    </head>

    <body id="page-top">

        <script type="text/javascript">
            /*function refresh_notif_pending() {
                jQuery.ajax({
                    url: 'apiManagePanel/get_count_reservation.php',
                    type: 'POST',
                    success: function (results) {
                        jQuery(".query_notpend").html(results);
                    }
                });
            }

            /*function refresh_notif_date() {
                jQuery.ajax({
                    url: 'apiManagePanel/query_count_bydate_notifications.php',
                    type: 'POST',

                    success: function (results) {
                        jQuery(".query_bydate").html(results);
                    }
                });
            }*/

            function refresh_count_notif() {

                jQuery.ajax({
                    url: 'apiManagePanel/get_count_notification.php',
                    type: 'POST',
                    success: function (results) {
                        jQuery(".badge-notify").html(results);
                    }
                });
            }

            tnotif = setInterval(refresh_count_notif, 10000);
            //tp = setInterval(refresh_notif_pending, 1000);
            //tall = setInterval(refresh_notif_date, 1000);
        </script>

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-white sidebar sidebar-light accordion " id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand text-center d-flex align-items-center mt-3 mb-3 justify-content-center" href="dashboard.php">

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

                <li class="nav-item active">
                    <a class="nav-link " href="notification.php">
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
                                            url: "apiManagePanel/layout_list_notification_popup.php",
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
                                        href="notifications.php">Mostrar todo</a>
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
                            <h1 class="h3 mb-0 text-gray-800">Panel de Notificaciones</h1>
                        </div>

                        <!-- Content CARDS ACCESS -->
                        <div class="row">

                            <!-- Card de resumen de total de productos -->
                            <div class="col-xl-4 col-md-4 mb-4 d-none">
                                <div class="card card-hover-style border-left-primary  h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Notificaciones pendientes</div>
                                                <div class="h6 mb-0 text-gray-800 query_notpend">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- card de resumen de la cantidad de productos sin stock -->
                            <div class="col-xl-4 col-md-4 mb-4">
                                <div class="card card-hover-style border-left-success h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Notificaciones de hoy </div>
                                                <div class="h6 mb-0 text-gray-800 query_bydate">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Content Row -->
                        <?php              
                            $result=$con->query("SELECT n.id_notifications, n.id_reservation, 
                                c.id_customer, c.firstname_customer, c.lastname_customer, r.time_reservation,
                                d.detail_detnotif,  r.date_reservation, r.time_reservation, r.state_reservation, d.destination_detnotif,
                                r.id_timelinereserv,
                                (SELECT tl.name_timelinereserv FROM timeline_reservation tl WHERE tl.id_timelinereserv = r.id_timelinereserv) As name_timelinereserv
                                FROM notifications n
                                INNER JOIN detail_notifications d ON d.id_detnotifications  = n.id_notifications 
                                INNER JOIN customer c ON c.id_customer = n.id_customer
                                INNER JOIN reservation r ON r.id_reservation = n.id_reservation
                                WHERE d.destination_detnotif= 'system'
                                ORDER BY r.date_reservation DESC");
                        ?>
                        <!-- DataTales Example -->
                        <div class="card card-hover-style mb-4">
                            <div class="card-header py-3">
                                <span class="m-0 font-weight-bold text-primary" style="float: left;">Lista de
                                    Notificaciones</span>
                                <span class=" font-weight-bold text-primary  p-1 icon-icon-hover-yellow"
                                    style="float: right; cursor: pointer;" onclick="refreshPage()">
                                    <i class="fa-sync fa-w fas"></i>
                                    Refrescar
                                </span>
                            </div>
                            <?php
              if ($result->num_rows > 0) {
                  ?>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Opciones</th>
                                                <th class="text-center">Código Reservación</th>
                                                <th class="text-center">Fecha Solicitud</th>
                                                <th class="text-center">Estado</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Opciones</th>
                                                <th class="text-center">Código Reservación</th>
                                                <th class="text-center">Hota solicitud</th>
                                                <th class="text-center">Estado</th>
                                            </tr>
                                        </tfoot>

                                        <tbody>
                                            <?php
                                            while ($row = $result->fetch_array()) {
                                                $state = $row['name_timelinereserv'];
                                                 ?>
                                            <tr>
                                                <td class="align-content-center text-center align-self-center"
                                                    width=10%>
                                                    <i class="icon-hover-yellow fas faw fa-eye" type="button"
                                                        style="border-radius: 13px; padding: 5px;" title="ver detalles"
                                                        onclick="getDetail( <?php echo $row['id_notifications'] ?> )"></i>
                                                </td>
                                                <td>
                                                    <center class="small"><?php echo $row['id_reservation']; ?>
                                                    </center>
                                                </td>

                                                <td class="small text-center"><?php echo $row["date_reservation"]. " / ". $row["time_reservation"];?>
                                                </td>

                                                <td class=" text-center font-weight-bold is-text-black">
                                                    <?php echo $state ?>
                                                </td>
                                            </tr>
                                            <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
              }else{ ?>
                            <div>
                                <h5 class="text-center text-black-50 mt-4 mb-4">
                                    <i class=" fas fa-fw fa-times mr-2"></i>No se obtuvo datos &nbsp;<i
                                        class="fas faw fa-frown-open"></i></h5>
                            </div>
                            <?php }?>
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


        <!-- Modal -->
        <div class="modal fade" id="dataModala" style="opacity: 1; background : rgba(7, 7, 7, 0.219);" tabindex="-1"
            role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="border-radius: 15px; border: none;">
                <div class="modal-content" style="border-radius: 15px; border: none;">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold"  id="ModalNotifLabel">
                            <i class="fa fas fa-info text-primary"></i>&nbsp;
                            Detalles de la notificación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body " id="notification_detail">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success card-hover-style" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
            <script>
                function getDetail(id) {
                    jQuery.ajax({
                        url: 'apiManagePanel/layout_detail_notif_modal.php',
                        method: "POST",
                        data: {
                            id_notif: id
                        },
                        success: function (data) {
                            $('#notification_detail').html(data);
                            $('#dataModala').modal('show');
                        },
                        error: function (params) {
                            $('#dataModala').modal('hide')
                        }
                    });

                }
            </script>
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

        <script src="js/methods_reservation.js"></script>

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