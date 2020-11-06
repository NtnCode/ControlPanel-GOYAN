<?php
include('../ApiConnect/connect.php');
error_reporting(0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $type = $_POST['type'];
    $page = $_POST['page'];
    $qsearch = $_POST['query'];


    $response = array();

    if (!empty($type)) {
        
        if ($type === 'vibere') {
            $query = "SELECT id_prod, name_prod, price_unit_prod, description_prod, state_prod, 
                image_prod, b.id_brand, b.name_brand, c.id_category, c.name_cat
                FROM product p
                INNER JOIN brand b on p.id_brand=b.id_brand
                INNER JOIN category c on p.id_category = c.id_category
                WHERE c.id_category IN ((1),(3),(4),(6)) AND name_prod LIKE '%$qsearch%'
                ORDER BY name_prod DESC
                LIMIT $page";
        } elseif ($type === 'golosina') {
            $query = "SELECT id_prod, name_prod, price_unit_prod, description_prod, state_prod, 
                image_prod, b.id_brand, b.name_brand, c.id_category, c.name_cat
                FROM product p
                INNER JOIN brand b on p.id_brand=b.id_brand
                INNER JOIN category c on p.id_category = c.id_category
                WHERE c.id_category IN (2) AND name_prod LIKE '%$qsearch%'
                ORDER BY name_prod DESC
                LIMIT $page";
        } elseif ($type === 'higiene') {
            $query = "SELECT id_prod, name_prod, price_unit_prod, description_prod, state_prod, 
                image_prod, b.id_brand, b.name_brand, c.id_category, c.name_cat
                FROM product p
                INNER JOIN brand b on p.id_brand=b.id_brand
                INNER JOIN category c on p.id_category = c.id_category
                WHERE c.id_category IN (5) AND name_prod LIKE '%$qsearch%'
                ORDER BY name_prod DESC
                LIMIT $page";
        }  elseif($type === '1'){
            $query = "SELECT id_prod, name_prod, price_unit_prod, description_prod, state_prod, 
                image_prod, b.id_brand, b.name_brand, c.id_category, c.name_cat
                FROM product p
                INNER JOIN brand b on p.id_brand=b.id_brand
                INNER JOIN category c on p.id_category = c.id_category
                WHERE name_prod LIKE '%$qsearch%'
                ORDER BY name_prod DESC
                LIMIT $page";
        }

        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push(
                $response,
                array(
                    'id_prod'      =>$row['id_prod'],
                    'name_prod'    =>$row['name_prod'],
                    'price_unit_prod'   =>$row['price_unit_prod'],
                    'description_prod'    =>$row['description_prod'],
                    'image_prod'   =>$row['image_prod'],
                    'state_prod'   =>$row['state_prod'],
                    'id_brand'    =>$row['id_brand'],
                    'name_brand'   =>$row['name_brand'],
                    'id_category'    =>$row['id_category'],
                    'name_cat'   =>$row['name_cat']
                )
            );
        }
        
        echo json_encode($response);
    }

    mysqli_close($conn);

}