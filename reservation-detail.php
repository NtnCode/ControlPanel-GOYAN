<?php
    ob_start();
    session_start();
    if (($_SESSION['login']=="ok_logged")) {
      include("apiConnect/connect.php");

      $con=$conn;
      if (isset($_GET['cdg'])) {
          $cdg=$_GET['cdg'];
          $result=$con->query(
              "SELECT r.id_reservation, r.time_reservation, r.date_reservation, r.timecollect_reservation,
                r.detail_reservation, r.state_reservation,
                tl.id_timelinereserv, tl.name_timelinereserv, tl.description_timelinereserv,
                c.firstname_customer, c.lastname_customer, c.phone_customer, c.id_customer, c.photo_customer, c.email_customer,
                tp.id_typepay, tp.name_typepay, tp.description_typepay,
                (SELECT SUM(dr.quantity_detres) FROM detail_reservation dr WHERE dr.id_reservation = r.id_reservation) As quantity_detres,
                (SELECT SUM(dr.total_detres) FROM detail_reservation dr WHERE dr.id_reservation = r.id_reservation) As gtotal_detres
                FROM reservation r 
                INNER JOIN customer c ON r.id_customer = c.id_customer
                INNER JOIN timeline_reservation tl ON tl.id_timelinereserv = r.id_timelinereserv
                INNER JOIN type_pay tp ON tp.id_typepay = r.id_typepay
                WHERE r.id_reservation ='$cdg'"
          );
        $rowSel = $result->fetch_array(); 
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

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="css/style_global.css">
        <link rel="stylesheet" href="css/timeline.css">
        <link rel="stylesheet" href="css/style_reservationdetail.css">

        <!-- Custom styles for this template -->
        <link href="css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- JavaScript -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script src="js/multiple-carousel.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    </head>
    <style>
        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%6db3b7' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%6db3b7' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
        }

        .carousel-control-prev,
        .carousel-control-next {
            bottom: 0%;
            width: 2%;
        }
    </style>

    <body id="page-top" onload="javascript:get_timeline('<?php echo $rowSel['id_reservation']; ?>')">

        <script type="text/javascript">
            function refresh_count_notif() {

                jQuery.ajax({
                    url: 'apiManagePanel/query_count_view_notifications.php',
                    type: 'POST',
                    success: function (results) {
                        jQuery(".badge-notify").html(results);
                    }
                });
            }

            //tnotif = setInterval(refresh_count_notif, 1000);
            //onload="javascript:verifyStatesButtons(<?php echo $rowSel['name_timelinereserv']; ?>)"

            function get_timeline(id) {

                jQuery.ajax({
                    url: 'apiManagePanel/layout_detail_reserv_timeline.php',
                    method: 'POST',
                    data: {
                        id_reservation: id
                    },
                    success: function (results) {
                        jQuery("#retrieve-timeline").html(results);
                    }
                });
            }
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

                <div class=" d-flex flex-column p-4 "
                    style="margin-top: 50px; min-height: 200px; position: absolute; top: 0; right: 0;">

                    <div id="toastDone" class="toast rounded" role="alert" data-delay="6000" data-autohide="true"
                        style=" min-width: 300px; ">
                        <div class="toast-header">
                            <div class="icon-circle bg-success mr-2">
                                <i class="fas fa-flag text-white"></i>
                            </div>
                            <strong class="mr-auto text-success">Reservación Notificada</strong>

                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="toast-body">Se notificó al cliente el estado de su reserva.</div>
                    </div>

                </div>

                <div class=" d-flex flex-column p-4 "
                    style="margin-top: 50px; min-height: 200px; position: absolute; top: 0; right: 0;">

                    <div id="toastError" class="toast rounded" role="alert" data-delay="6000" data-autohide="true"
                        style=" min-width: 300px; ">
                        <div class="toast-header">
                            <div class="icon-circle bg-danger mr-2">
                                <i class="fas fa-flag text-white"></i>
                            </div>
                            <strong class="mr-auto text-danger">¡Hubo un problema!</strong>

                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="toast-body">No se logro realizar la reserva. Verifique su conexion a internet.</div>
                    </div>

                </div>

                <div class=" d-flex flex-column p-4 "
                    style="margin-top: 50px; min-height: 200px; position: absolute; top: 0; right: 0;">

                    <div id="toastRechazed" class="toast rounded" role="alert" data-delay="6000" data-autohide="true"
                        style=" min-width: 300px; ">
                        <div class="toast-header">
                            <div class="icon-circle bg-warning mr-2">
                                <i class="fas fa-flag text-white"></i>
                            </div>
                            <strong class="mr-auto text-warning">Reserva Rechazada</strong>

                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="toast-body">Se notificó al cliente el estado de su reserva.</div>
                    </div>

                </div>


                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top">

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
                            <h1 class="h4 mb-0 text-gray-800">Detalle de Reservación</h1>
                        </div>

                        <div class="d-sm-flex mb-4">
                            <a class="h6 mb-0 text-gray-800" href="dashboard.php"><i class="fas faw fa-home"></i></a>
                            <a class="h6 mb-0 text-gray-800">&nbsp;/&nbsp; </a>
                            <a class="h6 mb-0 text-gray-800" href="reservation.php">Reservaciones</a>
                            <a class="h6 mb-0 text-gray-800">&nbsp;/&nbsp;</a>
                            <a class="h6 mb-0 text-primary active">Detalle de Reservación</a>
                        </div>

                        <div class="top-content">

                            <!-- CAROUSEL CARD INFORMATION ONLY LG -->
                            <div class="d-none d-md-none d-sm-none d-lg-block d-xl-block">
                                <div id="recipeCarousel" class="carousel slide carousel-fade w-100" data-ride="carousel"
                                    data-interval="0">
                                    <div class="carousel-inner w-100" role="listbox">
                                        <div class="carousel-item row active">
                                            <div class="col-4 float-left">
                                                <div class="card mb-3 pt-4 pl-3 pb-3 pr-3">

                                                    <div class="media">
                                                        <a href="#">
                                                            <img src="<?php echo $rowSel['photo_customer']; ?>"
                                                                class="card-img align-self-center rounded-circle mr-3 align-content-center"
                                                                style="width:85px; height:85px;" alt="...">
                                                        </a>
                                                        <div class="media-body text-left">
                                                            <small class="card-text text-muted">Cliente:</small>
                                                            <h5 class="card-title is-text-black font-weight-bold ">
                                                                <?php echo $rowSel["firstname_customer"]." ". $rowSel["lastname_customer"]; ?>
                                                            </h5>
                                                            <small class="card-text text-muted">Celular:</small>
                                                            <h5 class=" is-text-black">
                                                                <?php echo $rowSel["phone_customer"]; ?>
                                                            </h5>
                                                            <small class="card-text text-muted">Correo
                                                                electrónico:</small>
                                                            <h5 class=" is-text-black">
                                                                <?php echo $rowSel["email_customer"]; ?>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 float-left">
                                                <div class="card mb-3 pt-4 pl-3 pb-3 pr-3">
                                                    <p class="text-secondary card-title">Detalles de la reservación</p>
                                                    <small class="card-text text-muted text-left">Código de
                                                        reservación:</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["id_reservation"]; ?>
                                                    </h6>

                                                    <small class="card-text text-muted text-left">Fecha y Hora de
                                                        reservación</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["date_reservation"]. ' / '.$rowSel["time_reservation"]; ?>
                                                    </h6>
                                                    <small class="card-text text-muted text-left">Hora de recojo</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["timecollect_reservation"]; ?>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-4 float-left">
                                                <div class="card mb-3 pt-4 pl-3 pb-3 pr-3">
                                                    <p class="text-secondary card-title">Detalles de pago</p>
                                                    <small class="card-text text-muted text-left">Tipo de pago:</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["name_typepay"]; ?>
                                                    </h6>
                                                    <small class="card-text text-muted text-left">Totalidad de
                                                        items:</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["quantity_detres"]; ?>
                                                    </h6>
                                                    <small class="card-text text-muted text-left">Monto total:</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["gtotal_detres"]; ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item row no-gutters">
                                            <div class="col-4 float-left">

                                            </div>
                                        </div>
                                    </div>

                                    <a class="carousel-control-prev" href="#recipeCarousel" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true">
                                        </span>
                                        <span class="sr-only">Anterior</span>
                                    </a>
                                    <a class="carousel-control-next" href="#recipeCarousel" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true">
                                        </span>
                                        <span class="sr-only">Siguiente</span>
                                    </a>
                                </div>
                            </div>
                            <!-- CAROUSEL CARD INFORMATION ONLY MD SM -->
                            <div class=" d-none d-md-block d-sm-block d-lg-none d-block">
                                <div id="recipeCarousel" class="carousel slide carousel-fade" data-ride="carousel"
                                    data-interval="0">
                                    <div class="carousel-inner" role="">
                                        <div class="carousel-item  active">
                                            <div class="">
                                                <div class="card mb-2 pt-2 pl-2 pb-2 pr-2">
                                                    <div class="media">
                                                        <a href="#">
                                                            <img src="<?php echo $rowSel['photo_customer']; ?>"
                                                                class="card-img align-self-center rounded-circle mr-3 align-content-center"
                                                                style="width:85px; height:85px;" alt="...">
                                                        </a>
                                                        <div class="media-body text-left">
                                                            <small class="card-text text-muted">Cliente:</small>
                                                            <h5 class="card-title is-text-black font-weight-bold ">
                                                                <?php echo $rowSel["firstname_customer"]." ". $rowSel["lastname_customer"]; ?>
                                                            </h5>
                                                            <small class="card-text text-muted">Celular:</small>
                                                            <h5 class=" is-text-black">
                                                                <?php echo $rowSel["phone_customer"]; ?>
                                                            </h5>
                                                            <small class="card-text text-muted">Correo
                                                                electrónico:</small>
                                                            <h5 class=" is-text-black">
                                                                <?php echo $rowSel["email_customer"]; ?>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="carousel-item  no-gutters">
                                            <div class="">
                                                <div class="card mb-2 pt-2 pl-2 pb-2 pr-2">
                                                    <p class="text-secondary card-title">Detalles de la reservación</p>
                                                    <small class="card-text text-muted text-left">Código de
                                                        reservación:</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["id_reservation"]; ?>
                                                    </h6>

                                                    <small class="card-text text-muted text-left">Fecha y Hora de
                                                        reservación</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["date_reservation"]. ' / '.$rowSel["time_reservation"]; ?>
                                                    </h6>
                                                    <small class="card-text text-muted text-left">Hora de recojo</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["timecollect_reservation"]; ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item  no-gutters">
                                            <div class="">
                                                <div class="card mb-2 pt-2 pl-2 pb-2 pr-2">
                                                    <p class="text-secondary card-title">Detalles de pago</p>
                                                    <small class="card-text text-muted text-left">Tipo de pago:</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["name_typepay"]; ?>
                                                    </h6>
                                                    <small class="card-text text-muted text-left">Totalidad de
                                                        items:</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["quantity_detres"]; ?>
                                                    </h6>
                                                    <small class="card-text text-muted text-left">Monto total:</small>
                                                    <h6 class=" is-text-black text-left">
                                                        <?php echo $rowSel["gtotal_detres"]; ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item  no-gutters">
                                            <div class="">

                                            </div>
                                        </div>
                                    </div>

                                    <a class="carousel-control-prev" href="#recipeCarousel" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true">
                                        </span>
                                        <span class="sr-only">Anterior</span>
                                    </a>
                                    <a class="carousel-control-next" href="#recipeCarousel" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true">
                                        </span>
                                        <span class="sr-only">Siguiente</span>
                                    </a>
                                </div>
                            </div>
                            <!-- TIMELINE STATE RESERVATION -->
                            <div class="card mb-4 card-hover-style">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="page-header">
                                                <h4 class="is-text-black">Linea de tiempo</h4>
                                            </div>
                                            <div id="retrieve-timeline">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php

                        $sql2="SELECT r.id_reservation, dr.id_detres, dr.target_detres
                            FROM reservation r 
                            INNER JOIN detail_reservation dr ON dr.id_reservation = r.id_reservation
                            WHERE r.id_reservation = '$cdg'";
                        $result=mysqli_query($conn, $sql2); 
                        
                        $sql_menu="SELECT r.id_reservation, dr.id_detres, dr.target_detres,
                            dr.quantity_detres, dr.total_detres, dr.price_detres,
                            m.id_menu, m.name_menu, m.target_item as target_menu, 
                            m.state_menu, m.image_menu
                            FROM reservation r 
                            INNER JOIN detail_reservation dr ON dr.id_reservation = r.id_reservation
                            INNER JOIN menu m ON m.id_menu = dr.id_menu
                            WHERE r.id_reservation = '$cdg' AND dr.target_detres = '1'";
                        $result_menu=mysqli_query($conn, $sql_menu);
                        
                        $sql_prod="SELECT r.id_reservation, dr.id_detres, dr.target_detres,
                            dr.quantity_detres, dr.total_detres, dr.price_detres,
                            p.id_product, p.name_product, p.target_item as target_product, 
                            p.state_product, p.image_product
                            FROM reservation r 
                            INNER JOIN detail_reservation dr ON dr.id_reservation = r.id_reservation
                            INNER JOIN product p ON p.id_product = dr.id_product
                            WHERE r.id_reservation = '$cdg' AND dr.target_detres = '2'";
                        
                        $result_prod=mysqli_query($conn, $sql_prod);
                        ?>

                            <!-- DataTale -->
                            <div class="card  mb-2 card-hover-style">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered " class="display" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Opciones</th>
                                                    <th>Código Item</th>
                                                    <th>Nombre Item</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">Precio</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Estado</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">Opciones</th>
                                                    <th>Código Item</th>
                                                    <th>Nombre Item</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">Precio</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Estado</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                            
                                            while ($row = mysqli_fetch_array($result)) {
                                                $target_res = $row['target_detres'];

                                                if ($target_res == '1') {

                                                    while ($row_menu = mysqli_fetch_array($result_menu)) {
                                                        ?>

                                                <tr>
                                                    <td class="align-content-center text-center align-align-self-center small"
                                                        width="10%">
                                                        <i class="icon-hover-blue fas faw fa-eye" type="button"
                                                            style="border-radius: 9px; padding: 9px;"
                                                            title="Mostrar detalles del Menu"
                                                            onclick='getDetail("<?php echo $row_menu["id_menu"]; ?>","<?php echo $row["target_detres"]; ?>")'>&nbsp;Mostrar</i>
                                                    </td>
                                                    <td class="text-center" width="10%">
                                                        <?php echo $row_menu["id_menu"] ?>
                                                    </td>
                                                    <td class="is-text-black">
                                                        <img class="img-fluid"
                                                            src="<?php echo $row_menu['image_menu']; ?>" width="55"
                                                            height="50" />
                                                        &nbsp;<?php echo $row_menu["name_menu"]?>
                                                    </td>
                                                    <td class="text-center" width="10%">
                                                        <?php echo $row_menu["quantity_detres"]?>
                                                    </td>
                                                    <td class="text-center" width="10%">
                                                        <?php echo $row_menu["price_detres"]?>
                                                    </td>
                                                    <td class="text-center" width="10%">
                                                        <?php echo $row_menu["total_detres"]?>
                                                    </td>
                                                    <td class="text-center"><?php echo "" ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                } elseif ($target_res == '2') {
                                                    
                                                    while ($row_prod = mysqli_fetch_array($result_prod)) {

                                                        ?>
                                                <tr>
                                                    <td class="align-content-center text-center align-align-self-center small"
                                                        width="10%">
                                                        <i class="icon-hover-blue fas faw fa-eye" type="button"
                                                            style="border-radius: 9px; padding: 9px;"
                                                            title="Mostrar detalles del Menu"
                                                            onclick='getDetail("<?php echo $row_prod["id_product"]; ?>","<?php echo $row["target_detres"]; ?>")'>&nbsp;Mostrar</i>
                                                    </td>
                                                    <td class="text-center" width="10%">
                                                        <?php echo $row_prod["id_product"] ?>
                                                    </td>
                                                    <td class="is-text-black">
                                                        <img class="img-fluid"
                                                            src="<?php echo $row_prod['image_product']; ?>" width="55"
                                                            height="50" />
                                                        &nbsp;<?php echo $row_prod["name_product"]?>
                                                    </td>
                                                    <td class="text-center" width="10%">
                                                        <?php echo $row_prod["quantity_detres"]?>
                                                    </td>
                                                    <td class="text-center" width="10%">
                                                        <?php echo $row_prod["price_detres"]?>
                                                    </td>
                                                    <td class="text-center" width="10%">
                                                        <?php echo $row_prod["total_detres"]?>
                                                    </td>
                                                    <td class="text-center"><?php echo "" ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                }
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
                            <button class="btn btn-info" type=" button" data-dismiss="modal">Cancelar</button>
                            <a class="btn btn-danger" type="submit" name="submit_logout" href="logout_user.php">Cerrar
                                Sesión</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmo Modal-->
            <div class="modal fade" id="PositiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6>¿Desea confirmar la reservación?</h6>
                            <!--<label for="exampleFormControlTextarea1">Example textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        placeholder=-->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type=" button" data-dismiss="modal">Cancelar</button>
                            <input type="button" class="btn btn-success" href="#"
                                onclick=' reservationConfirmed("<?php echo $rowSel["id_customer"]; ?>", "<?php echo $rowSel["id_reservation"]; ?>");'
                                value="Confirmar">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Rechazo Modal-->
            <div class="modal fade" id="NegativeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">¿Desea rechazar la reservación del cliente?</div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type=" button" data-dismiss="modal">Cancelar</button>
                            <input type="button" class="btn btn-success" href="#"
                                onclick=' reservationRechazed("<?php echo $rowSel["id_customer"]; ?>", "<?php echo $rowSel["id_reservation"]; ?>");'
                                value="Confirmar">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="dataModala" style="opacity: 1; background : rgba(7, 7, 7, 0.219);" tabindex="-1"
                role="dialog " aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" style="border-radius: 10px; border: none;">
                    <div class="modal-content" style="border-radius: 10px; border: none;">
                        <div class="modal-header">
                            <Span class="modal-title h5 font-weight-bold" id="ModalNotifLabel">
                                <i class="fas faw fa-info-circle text-primary"></i>&nbsp;&nbsp;Información</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body " id="item_detail">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary card-hover-style"
                                data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>

                <script>
                    function getDetail(id, target) {
                        if (target == "2") {
                            jQuery.ajax({
                                url: 'apiManagePanel/layout_detail_prod_modal.php',
                                method: "POST",
                                data: {
                                    id_prod: id
                                },
                                success: function (data) {
                                    $('#item_detail').html(data);
                                    $('#dataModala').modal('show');
                                }
                            });
                        } else if (target == "1") {
                            jQuery.ajax({
                                url: 'apiManagePanel/layout_detail_menu_modal.php',
                                method: "POST",
                                data: {
                                    id_menu: id
                                },
                                success: function (data) {
                                    $('#item_detail').html(data);
                                    $('#dataModala').modal('show');
                                }
                            });
                        }
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
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js">
            </script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/datatables-demo.js"></script>
            <script src="js/methods_reservation.js"></script>

            <!-- ALERTIFY -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
            <!-- Default theme -->
            <link rel="stylesheet"
                href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
            <!-- Semantic UI theme -->
            <link rel="stylesheet"
                href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
            <!-- Bootstrap theme -->
            <link rel="stylesheet"
                href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />
    </body>
    <?php
      }
  } else {
      header("location:index.php");
  }
ob_end_flush();

?>

</html>