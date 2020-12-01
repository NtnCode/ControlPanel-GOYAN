<?php
include('../ApiConnect/connect.php');
error_reporting(0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $query = "SELECT m.id_menu , m.name_menu, m.description_menu, m.image_menu, m.state_menu, m.target_item,
        c.id_catmenu , c.name_catmenu , t.id_typemenu, t.name_typemenu,
        d.price_detmenu
        FROM menu m
        INNER JOIN type_menu t on t.id_typemenu  = m.id_typemenu
        INNER JOIN category_menu c on c.id_catmenu  = m.id_category
        INNER JOIN detail_menu d on m.id_menu = d.id_menu
        WHERE m.state_menu = 1
        LIMIT 12";

    $result = mysqli_query($conn, $query);
    $response = array();


    while ($row = mysqli_fetch_assoc($result)) {
        array_push(
            $response,
            array(
            'id_menu'           =>$row['id_menu'],
            'name_menu'         =>$row['name_menu'],
            'description_menu'  =>$row['description_menu'],
            'image_menu'        =>$row['image_menu'],
            'state_menu'        =>$row['state_menu'],
            'id_catmenu'        =>$row['id_catmenu'],
            'name_catmenu'      =>$row['name_catmenu'],
            'id_typemenu'       =>$row['id_typemenu'],
            'name_typemenu'     =>$row['name_typemenu'],
            'price_detmenu'     =>$row['price_detmenu'],
            'target_item'       =>$row['target_item']

            )
        );
    }

    echo json_encode($response);

    mysqli_close($conn);


}