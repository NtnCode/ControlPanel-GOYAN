<?php
include('../ApiConnect/connect.php');
error_reporting(0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $query = "SELECT id_typemenu , name_typemenu, state_typemenu, image_typemenu
    FROM type_menu ";

    $result = mysqli_query($conn, $query);
    $response = array();


    while ($row = mysqli_fetch_assoc($result)) {
        array_push(
            $response,
            array(
            'id_typemenu'      =>$row['id_typemenu'],
            'name_typemenu'    =>$row['name_typemenu'],
            'state_typemenu'   =>$row['state_typemenu'],
            'image_typemenu'   =>$row['image_typemenu']
        )
        );
    }

    echo json_encode($response);

    mysqli_close($conn);


}