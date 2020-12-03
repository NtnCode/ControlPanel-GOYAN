<?php
  session_start();
  unset($_SESSION['login']);
  unset($_SESSION['id_user']); 
  unset($_SESSION['lname_user']);
  unset( $_SESSION['fname_user']);
  unset($_SESSION['mail_user']);
  unset($_SESSION['photo_user']);
  unset($_SESSION['idrole_user']);

  session_destroy();
  header("location: index.php");
  exit;
?>