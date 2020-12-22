<?php

include('../apiConnect/connect.php');

$id_not=$_POST['id_notifications'];

$queryS = "UPDATE `notifications` 
    SET `stateview_notifications`='1' 
    WHERE `id_notifications` = '$id_not'";

$result = mysqli_query($conn, $queryS);
    # code...

if ($result) {
    # code...
    $error = "yes_notif";
    echo json_encode(array('response'=>$error));
}else {
    # code...
    $error = "no_notif";
    echo json_encode(array('response'=>$error));
}

mysqli_close($conn);