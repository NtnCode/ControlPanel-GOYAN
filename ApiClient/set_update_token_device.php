<?php

if ($_SERVER['REQUEST_METHOD']==='POST') {
    require_once '../apiConnect/connect.php';
    error_reporting(0);

    $token = $_POST['token'];
    $id_cus = $_POST['id_customer'];

    # code...
    $query_du = "UPDATE customer 
    SET `key_notification_customer`='$token'
    WHERE id_customer = '$id_cus'";

    $result = mysqli_query($conn, $query_du);

    if ($result) {
        # code...
        $error = "done_du";
        echo json_encode(array('response' => $error));
    } else {
        $error = "error_du";
        echo json_encode(array('response' => $error));
    }
    


    mysqli_close($conn);
}