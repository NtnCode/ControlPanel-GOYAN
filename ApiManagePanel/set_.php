<?php
include('../apiConnect/connect.php');
date_default_timezone_set("America/Bogota");

$date = date("Y-m-d");
$time = date("H:i:s");

$type = $_POST['type'];
$id_res = $_POST['id_res'];
$id_cus = $_POST['id_cus'];

if ($type=="yes") {
    # code...
    
    $queryU = "UPDATE `reservation` SET `state_reserv`='1' 
        WHERE `id_reservation`= '$id_res'";
    $result = mysqli_query($conn, $queryU);

    $queryAI = "SELECT AUTO_INCREMENT 
                FROM information_schema.TABLES 
                WHERE TABLE_SCHEMA = 'system_ryt' AND TABLE_NAME = 'notifications_reservation'";
    $resultAI = mysqli_query($conn, $queryAI);
    $rowAI = $resultAI->fetch_array();
    $ai =$rowAI['AUTO_INCREMENT'];

    
    $query_not = "INSERT INTO `notifications_reservation`(`id_notifreserv`, 
                `id_customer`, `id_reservation`, `stateview_notifreserv`) 
                VALUES ('','$id_cus','$id_res','0')";
    mysqli_query($conn, $query_not);

    $query_idnot = "INSERT INTO `detail_notifications_reservation`(`id_notifreserv`, destination_notifreserv,
            `desc_notifreserv`, `date_notifreserv`, `time_notifreserv` ) 
            VALUES ('$ai','customer','Su reservación listo para su recojo.','$date','$time')";
    mysqli_query($conn, $query_idnot);
    echo "complete";

} elseif ($type=="no") {
    $queryU = "UPDATE `reservation` SET `state_reserv`='2' 
        WHERE `id_reservation`= '$id_res'";
    $result = mysqli_query($conn, $queryU);

    $queryAI = "SELECT AUTO_INCREMENT 
                FROM information_schema.TABLES 
                WHERE TABLE_SCHEMA = 'system_ryt' AND TABLE_NAME = 'notifications_reservation'";
    $resultAI = mysqli_query($conn, $queryAI);
    $rowAI = $resultAI->fetch_array();
    $ai =$rowAI['AUTO_INCREMENT'];

    if ($result) {
        # code...
        $query_temp = "SELECT r.id_reservation, r.id_customer, dr.id_prod, dr.quantity_detres, dr.price_detres
            FROM reservation r
            INNER JOIN detail_reservation dr ON r.id_reservation = dr.id_reservation
            WHERE r.id_reservation = '$id_res' and r.id_customer='$id_cus'";

        $result1 = mysqli_query($conn, $query_temp);
        $row = mysqli_num_rows($result1);

        while ($row=$result1->fetch_array()) {
            $idprod = $row['id_prod'];
            $qty = $row['quantity_detres'];
            $price = $row['price_detres'];
            $tot = $row['total_detres'];

            $query_stock = "UPDATE `detail_entry_prod` SET 
                `stock_prod`= stock_prod +'$qty' WHERE id_prod = '$idprod'";
            mysqli_query($conn, $query_stock);
        }
    
        $query_not = "INSERT INTO `notifications_reservation`(`id_notifreserv`,
                    `id_customer`, `id_reservation`, `stateview_notifreserv`)
                    VALUES ('','$id_cus','$id_res','0')";
        mysqli_query($conn, $query_not);

        $query_idnot = "INSERT INTO `detail_notifications_reservation`(`id_notifreserv`, destination_notifreserv,
                `desc_notifreserv`, `date_notifreserv`, `time_notifreserv` )
                VALUES ('$ai','customer','Su reservación fue rechazada. Intente con otro pedido.','$date','$time')";
        mysqli_query($conn, $query_idnot);

        echo "complete";
    }
    echo "error";
}
