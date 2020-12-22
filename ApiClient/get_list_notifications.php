<?php
include('../apiConnect/connect.php');
//error_reporting(0);

if ($_SERVER['REQUEST_METHOD']== 'POST' ) {

    $type = $_POST['type'];
    $id_cus=$_POST['id_customer'];

    $type = stripslashes($type);
    $id_cus = stripslashes($id_cus);
    $type = $conn->real_escape_string($type);  
    $id_cus = $conn->real_escape_string($id_cus);

    if ($type == 'short') {

        $queryS = "SELECT n.id_notifications, n.id_customer, n.id_reservation, n.stateview_notifications,
            d.destination_detnotif, d.detail_detnotif, d.date_detnotif, d.time_detnotif, d.title_detnotif
            FROM notifications n
            INNER JOIN detail_notifications d ON n.id_notifications = d.id_detnotifications 
            WHERE n.id_customer = '$id_cus' AND d.destination_detnotif = 'customer'
            ORDER BY d.date_detnotif DESC, d.time_detnotif DESC
            LIMIT 5";

        $result = mysqli_query($conn, $queryS);

        $response = array();

        while ($row = mysqli_fetch_assoc($result)) {
            array_push(
                $response,
                array(
                'id_notifications'            =>$row['id_notifications'],
                'id_customer'                 =>$row['id_customer'],
                'id_reservation'              =>$row['id_reservation'],
                'destination_detnotif'        =>$row['destination_detnotif'],
                'detail_detnotif'             =>$row['detail_detnotif'],
                'date_detnotif'               =>$row['date_detnotif'],
                'time_detnotif'               =>$row['time_detnotif'],
                'title_detnotif'              =>$row['title_detnotif'],
                'stateview_notifications'     =>$row['stateview_notifications']
        )
            );
        }

        echo json_encode($response);

    }elseif ($type == 'list') {

        $queryS = "SELECT n.id_notifications, n.id_customer, n.id_reservation, n.stateview_notifications,
            d.destination_detnotif, d.detail_detnotif, d.date_detnotif, d.time_detnotif, d.title_detnotif
            FROM notifications n
            INNER JOIN detail_notifications d ON n.id_notifications = d.id_detnotifications 
            WHERE n.id_customer = '$id_cus' AND d.destination_detnotif = 'customer'
            ORDER BY d.date_detnotif DESC, d.time_detnotif DESC";

        $result = mysqli_query($conn, $queryS);

        $response = array();

        while ($row = mysqli_fetch_assoc($result)) {
            array_push(
                $response,
                array(
                'id_notifications'            =>$row['id_notifications'],
                'id_customer'                 =>$row['id_customer'],
                'id_reservation'              =>$row['id_reservation'],
                'destination_detnotif'        =>$row['destination_detnotif'],
                'detail_detnotif'             =>$row['detail_detnotif'],
                'date_detnotif'               =>$row['date_detnotif'],
                'time_detnotif'               =>$row['time_detnotif'],
                'title_detnotif'              =>$row['title_detnotif'],
                'stateview_notifications'     =>$row['stateview_notifications']
        )
            );
        }

        echo json_encode($response);
        
    }

    

    mysqli_close($conn);
}