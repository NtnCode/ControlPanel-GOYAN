<?php
    require_once '../apiConnect/connect.php';
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD']=='POST') {

        $id_res = $_POST['id_reservation'];
        $id_cus = $_POST['id_customer'];
        $detail_res = $_POST['detail_res'];
        $id_typepay = $_POST['id_typepay'];
        $time_res = $_POST['time_res'];
        $id_direc = $_POST['id_direc'];

        date_default_timezone_set("America/Bogota");

        $date = date("Y-m-d");
        $time = date("H:i:s");
    
        $query_temp = "SELECT * FROM `temporal_cart` 
        WHERE `id_customer`='$id_cus' AND `state_tempcart` = '1'";

        $result_qtemp = mysqli_query($conn, $query_temp);
        $row_qtemp = mysqli_num_rows($result_qtemp);

        if ($result_qtemp->num_rows > 0) {
            $query_res = "INSERT INTO `reservation`(`id_reservation`, detail_reservation, 
            `date_reservation`, `time_reservation`, `timecollect_reservation`, `timeline_reservation`, 
            `state_reservation`, `id_customer`, `id_typepay`, `id_dealer`, `id_direccust`) 
        VALUES ('$id_res','$detail_res','$date','$time', '$time_res', 1, 1, '$id_cus',
            '$id_typepay', NULL, NULL)";

            $result_qres = mysqli_query($conn, $query_res);
            if (!$result_qres) {
                $error = "err_insert_res";
                echo json_encode(array('response'=>$error));
            }else{

                $error = "done_insert_res";
            
                /*$queryAI = "SELECT AUTO_INCREMENT
                    FROM information_schema.TABLES
                    WHERE TABLE_SCHEMA = 'db_goyan' AND TABLE_NAME = 'notifications_reservation'";
                    $resultAI = mysqli_query($conn, $queryAI);
                    $rowAI = $resultAI->fetch_array();
                    $ai =$rowAI['AUTO_INCREMENT'];*/

                /*$query_not = "INSERT INTO `notifications_reservation`(`id_notifreserv`,
                     `id_customer`, `id_reservation`, `stateview_notifreserv`)
                     VALUES ('','$id_cus','$id','0')";
                 mysqli_query($conn, $query_not);

                 $query_idnot = "INSERT INTO `detail_notifications_reservation`(`id_notifreserv`, `destination_notifreserv`,
                 `desc_notifreserv`, `date_notifreserv`, `time_notifreserv` )
                 VALUES ('$ai','system','Solicita Reservación','$date','$time')";
                 mysqli_query($conn, $query_idnot);*/

                while ($row_qtemp=$result_qtemp->fetch_array()) {
                    $id_item  = $row_qtemp['id_item'];
                    $qty = $row_qtemp['quantity_tempcart'];
                    $price = $row_qtemp['price_tempcart'];
                    $total = $row_qtemp['total_tempcart'];
                    $target = $row_qtemp['target_tempcart'];

                    if ($target == '1') {
                        $query_ins = "INSERT INTO `detail_reservation`(id_detres,`id_reservation`, 
                    `quantity_detres`, `total_detres`, `price_detres`, `target_detres`, `id_menu`, `id_product`) 
                    VALUES ('','$id_res','$qty','$total','$price', '$target', '$id_item', NULL)";

                        $result_qinsdet = mysqli_query($conn, $query_ins);
                        
                    } elseif ($target == '2') {
                        $query_ins = "INSERT INTO `detail_reservation`(id_detres,`id_reservation`, 
                    `quantity_detres`, `total_detres`, `price_detres`, `target_detres`, `id_menu`, `id_product`) 
                    VALUES ('','$id_res','$qty','$total','$price', '$target', NULL, '$id_item')";

                        $result_qinsdet = mysqli_query($conn, $query_ins);                    
                        
                    }
                }

                if ($result_qinsdet) {
                    $error_detres = "done_insertall_detres";

                    $query_empty = "DELETE FROM temporal_cart WHERE id_customer = '$id_cus'";
                    $result_dltres = mysqli_query($conn, $query_empty);

                    if (!$result_dltres) {
                        $error_dlt = "err_delete_res";
                        echo json_encode(array('response'=>$error,
                            'response_detres'=>$error_detres, 'response_delete'=>$error_dlt));

                    }else{
                        $error_dlt = "done_delete_res";
                        echo json_encode(array('response'=>$error, 
                            'response_detres'=>$error_detres, 'response_delete'=>$error_dlt));
                    }

                } else {
                    $error_detres = "err_insertall_detres";
                    echo json_encode(array('response'=>$error, 'response_detres'=>$error_detres));
                }
            }

        } else {
            $error = "err_empty_res";
            echo json_encode(array('response_empty'=>$error));
        }

        mysqli_close($conn);
    }