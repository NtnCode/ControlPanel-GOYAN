<?php
require_once '../apiConnect/connect.php';
error_reporting(0);

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $type = $_POST['type'];

    $idprod = $_POST['id_item'];
    $idcus = $_POST['id_cus'];
    $nprod = $_POST['name'];
    $imgprod = $_POST['image'];
    $priceprod = $_POST['price'];
    $target = $_POST['target'];


    if ($type === 'insert_fav') {
        $query_ins = "INSERT INTO `favorite_item`(`id_favorite`, `id_customer`, 
            `id_item`, `name_fav`, `image_fav`, `price_fav`,`target_fav`, `state_fav`) 
        VALUES ('', '$idcus', $idprod, '$nprod', '$imgprod', $priceprod, $target,1)";
        $result_ins = mysqli_query($conn, $query_ins);
        if ($result_ins) {
            $error = "done_ins";
            echo json_encode(array('response' => $error));
        } else {
            $error = "error_ins";
            echo json_encode(array('response' => $result_ins));
        }
    } elseif ($type === 'select_fav') {
        # code...
        $query_sel = "SELECT * FROM `favorite_item` WHERE id_item = $idprod and id_customer = '$idcus'";

        $result = mysqli_query($conn, $query_sel);
        if (mysqli_num_rows($result)>0) {
            while ($row = mysqli_fetch_array($result)) {
                $state_fav = $row['state_fav'];
            }

            if ($state_fav ==='1') {
                $error = "uno_sel";
                echo json_encode(array('response'=>$error));
            } elseif ($state_fav === '0') {
                $error = "zero_sel";
                echo json_encode(array('response' => $error));
            }
        } else {
            $error = "error_sel";
            echo json_encode(array('response' => $error));
        }
    } elseif ($type === 'delete_fav') {
        # code...
        $query_dlt = "DELETE FROM `favorite_item` WHERE id_item = $idprod and id_customer = '$idcus'";

        if (mysqli_query($conn, $query_dlt)) {
            $error = "done_dlt";
            echo json_encode(array('response' => $error));
        } else {
            $error = "error_dlt";
            echo json_encode(array('response' => $error));
        }
    } elseif ($type === 'all_fav') {
        # code...
        $query_sel = "SELECT * FROM `favorite_item` WHERE id_customer = '$idcus'";

        $result = mysqli_query($conn, $query_sel);
        if (mysqli_num_rows($result) > 0) {
            $response = array();

            while ($row = mysqli_fetch_assoc($result)) {
                array_push(
                    $response,
                    array(
                    'id_favorite'   => $row['id_favorite'],
                    'id_customer'   => $row['id_customer'],
                    'id_item'    => $row['id_item'],
                    'name_fav'      => $row['name_fav'],
                    'image_fav'    => $row['image_fav'],
                    'price_fav'    => $row['price_fav'],
                    'target_fav'    => $row['target_fav'],
                    'state_fav'     => $row['state_fav']
                )
                );
            }
            echo json_encode($response);
        } else {
            $error = "error_all";
            echo json_encode(array('response' => $error));
        }
    }
    
    mysqli_close($conn);
}