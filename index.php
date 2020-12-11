<?php
ob_start();
session_start();
error_reporting(0);
if (($_SESSION['login'] === "ok_logged")) {
    header("location:dashboard.php");
} else {
?>
<!doctype html>
<html lang="es">

    <head>
        <title>GOYAN Catering</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <link rel="shortcut icon" href="assets/image/goyan-logo.png" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/style_login.css">
        <link rel="stylesheet" href="css/style_global.css">
        <!-- GOOGLE fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- JavaScript ALERTIFY -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

        <script src="js/methods_login.js"></script>
    </head>

    <body class="" >
        <div class="container" >
            <div class=" row py-1 border-md align-items-center" >

                <div class="col-md-5 text-center ml-auto mr-auto ">
                    <img src="assets/image/goyan-logo.png" alt="Logo GOYAN" class="img-fluid "
                        style="margin-bottom: 1rem; margin-top: 1rem;" width="40%">
                    <h1 class="resize-font" style="font-family: 'Lato';"><b class="resize-font">GOYAN</b> Catering </h1>
                    <img src="assets/image/accountpanel-animated.gif" alt="" class="d-none d-sm-none  d-md-mone d-lg-block" 
                        width="90%">
                </div>
                
                <!-- Login Form -->

                <div class="col-md-7 col-lg-4 ml-auto mr-auto  frm" >
                    <form id="log" style="display: block;" method="post" action="index.php">
                        <div class="row ">
                            <h1 class="py-3 col-md-12 mb-3 resize-font" style="text-align: center; font-family: 'Montserrat';">
                                Iniciar Sesión</h1>
                            <!-- Email Address -->
                            <div class="form-group col-md-12 mb-4">

                                <input type="email" name="mail_log" placeholder="Correo Electrónico"
                                    style="border-radius: 15px;" class="form-control bg-white" require="">
                            </div>
                            <!-- Password -->
                            <div class="form-group col-lg-12 mb-4">

                                <input name="pass_log" type="password" placeholder="Contraseña"
                                    style="border-radius: 15px;" class="form-control bg-white" require="">
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group col-lg-12  mx-auto">
                                <input class=" btn btn-warning btn-block py-2" name="log_submit" type="submit"
                                    style="border-radius: 20px;" value="Ingresar">

                            </div>

                            <!-- Divider Text -->
                            <div class=" col-lg-12 mx-auto d-flex align-items-center">
                                <div class="border-bottom w-100 ml-5"></div>
                                <span class="px-2 small text-muted font-weight-bold text-muted">ó</span>
                                <div class="border-bottom w-100 mr-5"></div>
                            </div>

                            <!-- Already Registered -->
                            <div class="text-center w-100">
                                <p class="text-muted font-weight-bold">¿No tiene cuenta? <a class="text-warning ml-2"
                                        onclick="myFunction()">Registrese</a></p>
                            </div>
                        </div>

                    </form>

                    <?php
                    if (isset($_POST['log_submit'])) {
                        if (empty($_POST['mail_log']) || empty($_POST['pass_log'])) {
                            //$error = "Datos Erroneos";
                        } else {
                            // Define $username and $password
                            $username=$_POST['mail_log'];
                            $password=$_POST['pass_log'];
                            // Establishing Connection with Server by passing server_name, user_id and password as a parameter
                            include("apiConnect/connect.php");
                            $con=$conn;
                            // To protect MySQL injection for Security purpose
                            $username = stripslashes($username);
                            $password = stripslashes($password);
                            $username = $con->real_escape_string($username);
                            $password = $con->real_escape_string($password);

                            // SQL query to fetch information of registerd users and finds user match.
                            $query = $con->query("SELECT * FROM employee 
                                where password_employee ='$password' AND email_employee='$username'");
                            $rows = mysqli_num_rows($query);
                            
                            if ($rows == 1) {
                                $r=$query->fetch_array();
                                
                                $id = $r['id_employee'];
                                $fname = $r['firstname_employee'];
                                $lname = $r['lastname_employee'];
                                $photo = $r['photo_employee'];
                                $mail = $r['email_employee'];
                                $rol = $r['id_role'];
                                $state = $r['state_employee'];
                                if ($state=='1') {
                                    # code...
                                    $_SESSION['login']="ok_logged";
                                    $_SESSION['id_user']=$id;
                                    $_SESSION['lname_user']=$lname;
                                    $_SESSION['fname_user']=$fname;
                                    $_SESSION['mail_user']=$mail;
                                    $_SESSION['photo_user']=$photo;
                                    $_SESSION['idrole_user']=$rol;
                                    $query->free();
                                    header("location:dashboard.php");
                                    
                                } else {
                                    ?>
                    <script>
                        alertify.error('Usted no está habilitado.\nContáctese con el Administrador.');
                    </script>
                    <?php 
                                }
                            } else {
                                ?><script>
                        alertify.error("Datos erroneos");
                    </script><?php
                            }
                        }
                    } ?>

                    <!--SCRIPT CONNECT PHP TO register-->
                    <form id="reg" action="index.php" method="post" id="reg" style="display: none;">
                        <div class="row" style=" margin-bottom: 1rem;">
                            <h1 class=" col-md-12"
                                style="text-align: center; font-family: 'Montserrat'; margin-bottom: 20px; margin-top: 20px; ">
                                Registrarse</h1>

                            <!-- First Name -->
                            <div class="input-group col-lg-6 mb-4">

                                <input type="text" name="firstname" placeholder="Nombre" required=""
                                    autocomplete="FALSE" class="form-control bg-white" style="border-radius: 15px;">
                            </div>

                            <!-- Last Name -->
                            <div class="input-group col-lg-6 mb-4">
                                <input type="text" name="lastname" placeholder="Apellido" required=""
                                    autocomplete="FALSE" class="form-control bg-white" style="border-radius: 15px;">
                            </div>

                            <!-- Email Address -->
                            <div class="input-group col-lg-12 mb-4">
                                <input type="email" name="email" placeholder="Correo Electrónico" required=""
                                    autocomplete="FALSE" class="form-control bg-white" style="border-radius: 15px;">
                            </div>
                            <!-- Phone Number -->
                            <div class="input-group col-lg-12 mb-4">
                                <input type="tel" name="phone" placeholder="Número de celular" required=""
                                    class="form-control bg-white " style="border-radius: 15px;" maxlength="9">
                            </div>
                            <!-- Password -->
                            <div class="input-group col-lg-6 mb-4">

                                <input id="password" type="password" name="password" placeholder="Contraseña"
                                    autocomplete="FALSE" required="" class="form-control bg-white"
                                    style="border-radius: 15px;">
                            </div>

                            <!-- Password Confirmation -->
                            <div class="input-group col-lg-6 mb-4">
                                <input id="passwordConfirmation" type="password" name="passwordConfirmation" required=""
                                    autocomplete="FALSE" placeholder="Confirme su contraseña"
                                    style="border-radius: 15px;" class="form-control bg-white
                                border-md">
                            </div>


                            <!-- Submit Button -->
                            <div class="form-group col-lg-12  mx-auto">
                                <input type="submit" name="reg_submit" class="btn btn-warning btn-block py-2"
                                    style="border-radius: 20px;" value="Registrarse">

                            </div>
                            <!-- Divider Text -->
                            <div class="form-group col-lg-12 mx-auto d-flex align-items-center">
                                <div class="border-bottom w-100 ml-5"></div>
                                <span class="px-2 small text-muted font-weight-bold text-muted">ó</span>
                                <div class="border-bottom w-100 mr-5"></div>
                            </div>
                            <!-- Already Registered -->
                            <div class="text-center w-100">
                                <p id="tolog" class="text-muted font-weight-bold">¿Usted ya tiene cuenta? <a
                                        class="text-warning ml-2" onclick="myFunction()">Inicie Sesión</a></p>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['reg_submit'])) {
                        if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['phone'])
                            || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['passwordConfirmation'])) {
                            //$error = "Datos Erroneos";
                        } else {
                            // Define $username and $password
                            $firstname_reg=$_POST['firstname'];
                            $lastname_reg=$_POST['lastname'];
                            $username_reg=$_POST['email'];
                            $password_reg=$_POST['password'];
                            $passwordConfirmation=$_POST['passwordConfirmation'];
                            $phone_reg=$_POST['phone'];
                            // Establishing Connection with Server by passing server_name, user_id and password as a parameter
                            if ($password_reg === $passwordConfirmation) {
                                include("apiConnect/connect.php");
                                $con=$conn;
                                // To protect MySQL injection for Security purpose
                                $firstname_reg = stripslashes($firstname_reg);
                                $lastname_reg = stripslashes($lastname_reg);
                                $username_reg = stripslashes($username_reg);
                                $password_reg = stripslashes($password_reg);
                                $phone_reg = stripslashes($phone_reg);

                                $firstname_reg = $con->real_escape_string($firstname_reg);
                                $lastname_reg = $con->real_escape_string($lastname_reg);
                                $username_reg = $con->real_escape_string($username_reg);
                                $password_reg = $con->real_escape_string($password_reg);
                                $phone_reg = $con->real_escape_string($phone_reg);

                                // SQL query to fetch information of registerd users and finds user match.
                                $result = $con->query("INSERT INTO `employee` (`id_employee`, `lastname_employee`, `firstname_employee`, 
                                    `phone_employee`, `email_employee`, `password_employee`, `state_employee`, `id_role`) 
                                    VALUES ('', '$lastname_reg', '$firstname_reg', '$phone_reg', '$username_reg', '$password_reg', '1','5 ')");
                                                                                               
                                $query_sel = $con->query("SELECT id_employee FROM employee where email_employee ='$username_reg' and password_employee = '$password_reg'");
                                    
                                if($result){
                                    $res=$query_sel->fetch_array();
                                    $id_reg = $res['id_employee '];

                                    $_SESSION['login']="ok_logged";
                                    $_SESSION['id_user']=$id_reg;
                                    $_SESSION['lname_user']=$lname;
                                    $_SESSION['fname_user']=$fname;
                                    $_SESSION['mail_user']=$mail;
                                    $_SESSION['photo_user']=$photo;
                                    $_SESSION['idrole_user']='5';

                                    header("Location:dashboard.php");
                                    ?>
                    <meta http-equiv='refresh' content='1; url=dashboard.php' />
                    <?php
                                    exit();
                                }else{
                                    ?>
                    <script>
                        alertify.error("No se logro registrar.\nIntente mas adelante");
                    </script><?php
                                } 
                            } else {
                                ?>
                    <script>
                        alertify.warning("Contraseñas incorrectas.");
                    </script><?php
                            }
                        }
                    } ?>
                </div>
            </div>

        </div>

        <footer class="">
            <div class="brand-dev col-md-12 col-12 text-center ">
                <p>Developed with&nbsp;<i class="fas fa-heart fa-sm fa-fw mr-2 text-danger"></i>
                    
                </p>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>
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
}
ob_end_flush();

?>

</html>