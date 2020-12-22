<?php
    error_reporting(0);

    include('../apiConnect/connect.php');
    date_default_timezone_set("America/Bogota");

    $date = date("Y-m-d");
    $time = date("H:i:s");

    $type = $_POST['type'];
    $id_res = $_POST['id_res'];
    $id_cus = $_POST['id_cus'];
    $msg = $_POST['msg'];
    $title = $_POST['title'];
    $destination = "customer";

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    if ($type > 0 && $type <7 && $type != 3) {
        
        $queryU = "UPDATE `reservation` SET `id_timelinereserv` = '$type' 
            WHERE `id_reservation`= '$id_res' AND id_customer  = '$id_cus'";
        $result = mysqli_query($conn, $queryU);
        

        $queryAI = "SELECT AUTO_INCREMENT 
            FROM information_schema.TABLES 
            WHERE TABLE_SCHEMA = 'db_goyan' AND TABLE_NAME = 'notifications'";

        $resultAI = mysqli_query($conn, $queryAI);
        $rowAI = $resultAI->fetch_array();
        $ai =$rowAI['AUTO_INCREMENT'];

        if ($result) {
            echo "ok update";
            $query_not = "INSERT INTO `notifications`(`id_notifications`, 
                        `id_customer`, `id_reservation`, `stateview_notifications`) 
                        VALUES ('', '$id_cus', '$id_res', 0)";
            $res11 = mysqli_query($conn, $query_not);

            if($res11){
                echo "ok ins not";
            }else{echo "fail ins not";}

            $query_idnot = "INSERT INTO `detail_notifications`(`id_detnotifications`, destination_detnotif,
                    `detail_detnotif`, `date_detnotif`, `time_detnotif`, `title_detnotif`) 
                    VALUES ('$ai', '$destination', '$msg', '$date', '$time', '$title')";
            $res22 =mysqli_query($conn, $query_idnot);
            if($res22){
                echo "ok ins denot";
            }else{echo "fail ins denot";}


        }else{
            echo "error update";
            debug_to_console("error update reservation");
        }

    } elseif ($type==3) {

        $queryU = "UPDATE `reservation` SET `id_timelinereserv`='3' 
            WHERE `id_reservation`= '$id_res' AND id_customer  = '$id_cus'";
        $result = mysqli_query($conn, $queryU);

        $queryAI = "SELECT AUTO_INCREMENT   
            FROM information_schema.TABLES 
            WHERE TABLE_SCHEMA = 'db_goyan' AND TABLE_NAME = 'notifications'";

        $resultAI = mysqli_query($conn, $queryAI);
        $rowAI = $resultAI->fetch_array();
        $ai =$rowAI['AUTO_INCREMENT'];

        if ($result) {
            # code...
            $query_temp = "SELECT r.id_reservation, r.id_customer, dr.id_product, dr.quantity_detres, dr.target_detres
                FROM reservation r
                INNER JOIN detail_reservation dr ON dr.id_reservation = r.id_reservation
                WHERE r.id_reservation = '$id_res' and r.id_customer='$id_cus' AND dr.target_detres = 2";

            $result1 = mysqli_query($conn, $query_temp);

            if($result1){
                echo "ok ins denot";
            }else{echo "fail ins denot";}

            while ($row=$result1->fetch_array()) {
                $idprod = $row['id_product'];
                $qty = $row['quantity_detres'];

                $query_stock = "UPDATE `detail_product` SET 
                    `stock_detprod`= stock_detprod + '$qty' WHERE id_product = '$idprod'";
                mysqli_query($conn, $query_stock);
            }
        
            $query_not = "INSERT INTO `notifications`(`id_notifications`, 
                        `id_customer`, `id_reservation`, `stateview_notifications`) 
                        VALUES ('','$id_cus','$id_res','0')";
            mysqli_query($conn, $query_not);

            $query_idnot = "INSERT INTO `detail_notifications`(`id_detnotifications`, destination_detnotif,
                    `detail_detnotif`, `date_detnotif`, `time_detnotif`, `title_detnotif` ) 
                    VALUES ('$ai','$destination','$msg','$date','$time', '$title')";
            mysqli_query($conn, $query_idnot);

            //echo "complete";
        }
    }
    mysqli_close($conn);
