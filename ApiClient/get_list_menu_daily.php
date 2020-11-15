<?php
include('../ApiConnect/connect.php');
error_reporting(0);

if($_SERVER['REQUEST_METHOD']==='POST'){

    $type = $_POST['type'];

    $response = array();

    if (!empty($type)) {

        if ($type === '1') {
            $query = "SELECT m.id_dailymenu, m.id_menu , m.name_dailymenu, 
            m.price_dailymenu, m.image_dailymenu, m.state_dailymenu, 
            t.id_typemenu, t.name_typemenu
            FROM daily_menu m
            INNER JOIN type_menu t on t.id_typemenu  = m.id_typemenu
            WHERE t.id_typemenu = 1 or t.id_typemenu = 3";

            
        } elseif ($type === '2') {
            $query = "SELECT m.id_dailymenu, m.id_menu , m.name_dailymenu, 
            m.price_dailymenu, m.image_dailymenu, m.state_dailymenu, 
            t.id_typemenu, t.name_typemenu
            FROM daily_menu m
            INNER JOIN type_menu t on t.id_typemenu  = m.id_typemenu
            WHERE t.id_typemenu = 2 or t.id_typemenu = 4";
        } elseif ($type === '3') {
            $query = "SELECT m.id_dailymenu, m.id_menu , m.name_dailymenu, 
            m.price_dailymenu, m.image_dailymenu, m.state_dailymenu, 
            t.id_typemenu, t.name_typemenu
            FROM daily_menu m
            INNER JOIN type_menu t on t.id_typemenu  = m.id_typemenu
            WHERE t.id_typemenu = 5 or t.id_typemenu = 6";
        }

        $result = mysqli_query($conn, $query);

        $response = array();

        while ($row = mysqli_fetch_assoc($result)) {
            array_push(
                $response,
                array(
                'id_dailymenu'      =>$row['id_dailymenu'],
                'id_menu'           =>$row['id_menu'],
                'name_dailymenu'    =>$row['name_dailymenu'],
                'price_dailymenu'   =>$row['price_dailymenu'],
                'image_dailymenu'   =>$row['image_dailymenu'],
                'state_dailymenu'   =>$row['state_dailymenu'],
                'id_typemenu'       =>$row['id_typemenu'],
                'name_typemenu'     =>$row['name_typemenu']

                )
            );
        }

            echo json_encode($response);

    }else{
        print 'Error data is empty';

    }
    mysqli_close($conn);

}