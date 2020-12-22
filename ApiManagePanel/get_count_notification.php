<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
    include('../apiConnect/connect.php');
    date_default_timezone_set("America/Bogota");

    $count=0;

    $sql2="SELECT 
        n.stateview_notifications
        FROM notifications n
        INNER JOIN detail_notifications d ON d.id_detnotifications = n.id_notifications
        WHERE n.stateview_notifications  = 0 AND d.destination_detnotif = 'system'";

    $result=mysqli_query($conn, $sql2);
    $count=mysqli_num_rows($result);

    if ($count>0) {
        echo $count;
    } else {
        echo "Vacio";
    }

    mysqli_close($conn);

}
