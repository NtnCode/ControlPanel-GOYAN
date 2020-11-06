<?php
include('../ApiConnect/connect.php');
error_reporting(0);

if($_SERVER['REQUEST_METHOD']=== 'POST'){

    $idc = $_POST['id_customer'];
    $id = $_POST['id_product'];

    $id = stripslashes($id);
    $idc = stripslashes($idc);
    $id = $conn->real_escape_string($id);
    $idc = $conn->real_escape_string($idc);

    $ch_qty ="0";

    if (!empty($idc)) {
        $querys = "SELECT * FROM temp_detail_reservation WHERE id_customer = '$idc' and id_prod = '$id'";

        $result = mysqli_query($conn, $querys);
        while ($row1 = mysqli_fetch_assoc($result)) {
            $ch_prod = $row1['id_prod'];       
            $ch_qty =$row1['quantity_tres'];
        }
    }

    $query = "SELECT p.id_prod, p.name_prod, p.price_unit_prod, p.description_prod, p.state_prod, 
        p.image_prod, b.id_brand, b.name_brand, c.id_category, c.name_cat, 
        d.stock_prod, d.minstock_prod
        FROM product p
        INNER JOIN brand b on p.id_brand=b.id_brand
        INNER JOIN category c on p.id_category = c.id_category
        INNER JOIN detail_entry_prod d on p.id_prod = d.id_prod
        WHERE p.id_prod = '$id'";

    $result = mysqli_query($conn, $query);
    $response = array();

    if ($result->num_rows === 0) {
        array_push(
            $response,
            array('response' => 'error')
        );
    }

    while ($row = mysqli_fetch_assoc($result)) {

        $minstock = $row['minstock_prod'];
        $stock = $row['stock_prod'];

        $valor = $stock-$minstock;
        $state = "";

        if ($valor<21) {
            $state="denied";
        }else{
            $state="allow";
        }

        array_push(
            $response,
            array(
                'id_prod'           =>$row['id_prod'],
                'name_prod'         =>$row['name_prod'],
                'price_unit_prod'   =>$row['price_unit_prod'],
                'description_prod'  =>$row['description_prod'],
                'image_prod'        =>$row['image_prod'],
                'state_prod'        =>$row['state_prod'],
                'statestock_prod'   =>$state,
                'countprodtemp'   =>$ch_qty,
                'id_brand'          =>$row['id_brand'],
                'name_brand'        =>$row['name_brand'],
                'id_category'       =>$row['id_category'],
                'name_cat'          =>$row['name_cat']
            )
        );
    }

    echo json_encode($response);

    mysqli_close($conn);

}else{
    echo "Denied access.";
}