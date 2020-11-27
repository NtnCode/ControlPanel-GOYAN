<?php 
require_once '../apiConnect/connect.php';
error_reporting(0);

if ($_SERVER['REQUEST_METHOD']=== 'POST') {
    $idc = $_POST['id_customer'];

    $query = "SELECT * FROM temporal_cart WHERE id_customer = '$idc'";

    $result = mysqli_query($conn, $query);
    $response = array();


    while ($row = mysqli_fetch_assoc($result)) {
        array_push(
            $response,
            array(
                'id_tempcart'       =>$row['id_tempcart'],
                'id_customer'       =>$row['id_customer'],
                'id_item'           =>$row['id_item'],
                'quantity_tempcart' =>$row['quantity_tempcart'],
                'price_tempcart'    =>$row['price_tempcart'],
                'total_tempcart'    =>$row['total_tempcart'],
                'image_tempcart'    =>$row['image_tempcart'],
                'name_tempcart'     =>$row['name_tempcart'],
                'state_tempcart'    =>$row['state_tempcart'],
                'target_tempcart'   =>$row['target_tempcart']
            )
            );
        }

    echo json_encode($response);

    mysqli_close($conn);
}