<?php
include('../ApiConnect/connect.php');
error_reporting(0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $limit = $_POST['limit'];
    $param = $_POST['param'];

    if (isset($_POST['param'])) {

        $query = "SELECT p.id_product, p.name_product, p.state_product, p.image_product,
            b.id_brandprod, b.name_brandprod, c.id_catprod, c.name_catprod, d.priceunit_detprod, d.stock_detprod
            FROM product p
            INNER JOIN brand_product b on p.id_brandprod   = b.id_brandprod 
            INNER JOIN category_product c on p.id_catprod   = c.id_catprod 
            INNER JOIN detail_product d on p.id_product  = d.id_product 
            WHERE p.name_product LIKE '%$param%' AND p.state_product = 1 
            ORDER BY p.name_product
            LIMIT $limit";

    }else{
        $query = "SELECT p.id_product, p.name_product, p.state_product, p.image_product,
            b.id_brandprod, b.name_brandprod, c.id_catprod, c.name_catprod, d.priceunit_detprod, d.stock_detprod
            FROM product p
            INNER JOIN brand_product b on p.id_brandprod   = b.id_brandprod 
            INNER JOIN category_product c on p.id_catprod   = c.id_catprod 
            INNER JOIN detail_product d on p.id_product  = d.id_product 
            WHERE p.state_product = 1 
            ORDER BY p.name_product
            LIMIT $limit";

    }  

    $result = mysqli_query($conn, $query);
    $response = array();


    while ($row = mysqli_fetch_assoc($result)) {
        array_push(
            $response,
            array(
            'id_product'         =>$row['id_product'],
            'name_product'       =>$row['name_product'],
            'state_product'      =>$row['state_product'],
            'image_product'      =>$row['image_product'],
            'id_brandprod'       =>$row['id_brandprod'],
            'name_brandprod'     =>$row['name_brandprod'],
            'id_catprod'         =>$row['id_catprod'],
            'name_catprod'       =>$row['name_catprod'],
            'priceunit_detprod'  =>$row['priceunit_detprod'],
            'stock_detprod'      =>$row['stock_detprod']

            )
        );
    }

    echo json_encode($response);

    mysqli_close($conn);


}