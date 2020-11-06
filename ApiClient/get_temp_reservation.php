<?php 
require_once '../apiConnect/connect.php';
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idc = $_POST['id_customer'];

    $query = "SELECT * FROM temp_detail_reservation WHERE id_customer = '$idc'";

    $result = mysqli_query($conn, $query);
    $response = array();


    while( $row = mysqli_fetch_assoc($result) ){
        
        array_push($response,
        array(
            'id_tres'      =>$row['id_tres'], 
            'id_customer'      =>$row['id_customer'], 
            'id_prod'    =>$row['id_prod'], 
            'quantity_tres'   =>$row['quantity_tres'],
            'price_tres'    =>$row['price_tres'],
            'total_tres'    =>$row['total_tres'],
            'image_prod_tres'   =>$row['image_prod_tres'],
            'name_prod_tres'   =>$row['name_prod_tres'],
            'state_prod_tres'   =>$row['state_prod_tres']
        ));
    }

    echo json_encode($response);
    mysqli_close($conn);

}
