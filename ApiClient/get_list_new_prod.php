<?php
include('../ApiConnect/connect.php');
error_reporting(0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $query = "SELECT p.id_prod, p.name_prod, p.price_unit_prod, p.description_prod, p.state_prod, 
    p.image_prod, b.id_brand, b.name_brand, c.id_category, c.name_cat, e.date_ent
    FROM product p
    INNER JOIN brand b on p.id_brand=b.id_brand
    INNER JOIN category c on p.id_category = c.id_category
    INNER JOIN detail_entry_prod d ON p.id_prod = d.id_prod
    INNER JOIN entry e ON d.id_entry = e.id_entry
    ORDER BY e.date_ent DESC
    LIMIT 6";

    $result = mysqli_query($conn, $query);
    $response = array();


    while ($row = mysqli_fetch_assoc($result)) {
        array_push( $response,
            array(
                'id_prod'            =>$row['id_prod'], 
                    'name_prod'         =>$row['name_prod'], 
                    'price_unit_prod'   =>$row['price_unit_prod'],
                    'description_prod'  =>$row['description_prod'],
                    'image_prod'        =>$row['image_prod'],
                    'state_prod'        =>$row['state_prod'],
                    'id_brand'          =>$row['id_brand'], 
                    'name_brand'        =>$row['name_brand'],
                    'id_category'       =>$row['id_category'],
                    'name_cat'          =>$row['name_cat'],
                    'date_ent'          =>$row['date_ent']
                )
            );
    }

    echo json_encode($response);

    mysqli_close($conn);


}