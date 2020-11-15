<?php
include('../ApiConnect/connect.php');
error_reporting(0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $query = "SELECT id_catmenu, name_catmenu, state_catmenu
    FROM category_menu
    Where state_catmenu = 1";

    $result = mysqli_query($conn, $query);
    $response = array();


    while ($row = mysqli_fetch_assoc($result)) {
        array_push(
            $response,
            array(
            'id_catmenu'      =>$row['id_catmenu'],
            'name_catmenu'    =>$row['name_catmenu'],
            'state_catmenu'   =>$row['state_catmenu']
        )
        );
    }

    echo json_encode($response);

    mysqli_close($conn);


}