<?php
include('../ApiConnect/connect.php');
error_reporting(0);


$idc = $_POST['id_customer'];
$idp = $_POST['id_prod'];
$quant = $_POST['quantity_tres'];
$price = $_POST['price_tres'];
$total = $_POST['total_tres'];
$image = $_POST['image_prod_tres'];
$nprod = $_POST['name_prod_tres'];


$querys = "SELECT * FROM temp_detail_reservation WHERE id_customer = '$idc' and id_prod = '$idp'";

$result = mysqli_query($conn, $querys);
while ($row = mysqli_fetch_assoc($result)) {
    $ch_prod = $row['id_prod'];
    $ch_qty =$row['quantity_tres'];
    $ch_tot =$row['total_tres'];
}

//VERIFICA SI EL PRODUCTO YA ESTA INSERTADO
if ($idp === $ch_prod) {
    $sum = $quant + $ch_qty;
    $sumt = $total + $ch_tot;
    if ($sum>10) {
        $error = "max_u";
        echo json_encode(array("response"=>$error));
    } else {
        $queryu = "UPDATE `temp_detail_reservation` 
        SET `quantity_tres`='$sum', `total_tres`='$sumt'
        WHERE id_customer = '$idc' and id_prod = '$idp'";

        if (mysqli_query($conn, $queryu)) {
            # code...
            $error = "ok_u";
            echo json_encode(array("response"=>$error));
        } else {
            $error = "fail_u";
            echo json_encode(array("response"=>$error));
        }
    }
    //CASO CONTRARIO INSERTA EL NUEVO PEDIDO
} else {
    $query = "INSERT INTO `temp_detail_reservation`(`id_tres`, 
        `id_customer`, 
        `id_prod`, 
        `quantity_tres`, 
        `price_tres`,
        `total_tres`, 
        `image_prod_tres`, 
        `name_prod_tres`,
        `state_prod_tres`) 
        VALUES ('','$idc','$idp','$quant', '$price','$total','$image','$nprod', '1') ";

    $response = array();


    if (mysqli_query($conn, $query)) {
        $error = "ok_reg";
        echo json_encode(array("response"=>$error));
    } else {
        $error = "fail_reg";
        echo json_encode(array("response"=>$error));
    }
}


mysqli_close($conn);

