<?php
include('../ApiConnect/connect.php');
error_reporting(0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $idc = $_POST['id_customer'];
    $idp = $_POST['id_item'];
    $quant = $_POST['quantity_tempcart'];
    $price = $_POST['price_tempcart'];
    $total = $_POST['total_tempcart'];
    $image = $_POST['image_tempcart'];
    $nprod = $_POST['name_tempcart'];
    $target = $_POST['target_tempcart'];



    $querys = "SELECT * FROM temporal_cart WHERE id_customer = '$idc' and id_item = '$idp'";

    $result = mysqli_query($conn, $querys);
    if($result){
        while ($row = mysqli_fetch_assoc($result)) {
            $ch_prod = $row['id_item'];
            $ch_qty =$row['quantity_tempcart'];
            $ch_tot =$row['total_tempcart'];
        }
    }

    //VERIFICA SI EL PRODUCTO YA ESTA INSERTADO
    if ($idp === $ch_prod) {
        $sum = $quant + $ch_qty;
        $sumt = $total + $ch_tot;
        if ($sum>10) {
            $error = "max_u";
            echo json_encode(array("response"=>$error));
        } else {
            $queryu = "UPDATE `temporal_cart` 
            SET `quantity_tempcart`='$sum', `total_tempcart`='$sumt'
            WHERE id_customer = '$idc' and id_item = '$idp'";

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
        $query = "INSERT INTO `temporal_cart`(`id_tempcart`, 
            `id_customer`, 
            `id_item`, 
            `quantity_tempcart`, 
            `price_tempcart`,
            `total_tempcart`, 
            `image_tempcart`, 
            `name_tempcart`,
            `target_tempcart`,
            `state_tempcart`) 
            VALUES ('','$idc','$idp','$quant', '$price','$total','$image','$nprod',$target, '1') ";

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

}