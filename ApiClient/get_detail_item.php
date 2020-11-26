<?php
include('../ApiConnect/connect.php');
error_reporting(0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $type = $_POST['type'];
    $id = $_POST['id'];

    $responsemenu = array();
    $responseprod = array();

    if($type === 'menu'){

        $queryM = "SELECT m.id_menu , m.name_menu, m.description_menu, m.image_menu, m.state_menu, m.target_item,
        c.id_catmenu , c.name_catmenu , t.id_typemenu, t.name_typemenu,
        d.price_detmenu
        FROM menu m
        INNER JOIN type_menu t on t.id_typemenu  = m.id_typemenu
        INNER JOIN category_menu c on c.id_catmenu  = m.id_category
        INNER JOIN detail_menu d on m.id_menu = d.id_menu
        WHERE m.id_menu = '$id'";

        $resultmenu = mysqli_query($conn, $queryM);

        while ($rowM = mysqli_fetch_assoc($resultmenu)) {
            array_push(
                $responsemenu,
                array(
                'id_menu'           =>$rowM['id_menu'],
                'name_menu'         =>$rowM['name_menu'],
                'description_menu'  =>$rowM['description_menu'],
                'image_menu'        =>$rowM['image_menu'],
                'state_menu'        =>$rowM['state_menu'],
                'id_catmenu'        =>$rowM['id_catmenu'],
                'name_catmenu'      =>$rowM['name_catmenu'],
                'id_typemenu'       =>$rowM['id_typemenu'],
                'name_typemenu'     =>$rowM['name_typemenu'],
                'price_detmenu'     =>$rowM['price_detmenu'],
                'target_item'     =>$rowM['target_item']
                )
            );
        }
        echo json_encode($responsemenu);


    }else if ($type === 'product') {

        $queryP = "SELECT p.id_product, p.name_product, p.state_product, p.image_product, p.description_product, p.target_item,
            b.id_brandprod, b.name_brandprod, c.id_catprod, c.name_catprod, 
            d.priceunit_detprod, d.stock_detprod, d.stockmin_detprod, 
            d.qtyperunit_detprod
            FROM product p
            INNER JOIN brand_product b on p.id_brandprod   = b.id_brandprod 
            INNER JOIN category_product c on p.id_catprod   = c.id_catprod 
            INNER JOIN detail_product d on p.id_product  = d.id_product 
            WHERE p.id_product = '$id'";

        $resultprod = mysqli_query($conn, $queryP);


        while ($rowP = mysqli_fetch_assoc($resultprod)) {
            array_push(
                $responseprod,
                array(
                'id_product'         =>$rowP['id_product'],
                'name_product'       =>$rowP['name_product'],
                'description_product'=>$rowP['description_product'],
                'state_product'      =>$rowP['state_product'],
                'image_product'      =>$rowP['image_product'],
                'id_brandprod'       =>$rowP['id_brandprod'],
                'name_brandprod'     =>$rowP['name_brandprod'],
                'id_catprod'         =>$rowP['id_catprod'],
                'name_catprod'       =>$rowP['name_catprod'],
                'priceunit_detprod'  =>$rowP['priceunit_detprod'],
                'stock_detprod'      =>$rowP['stock_detprod'],
                'stockmin_detprod'   =>$rowP['stockmin_detprod'],
                'qtyperunit_detprod' =>$rowP['qtyperunit_detprod'],
                'target_item'     =>$rowP['target_item']
                )
            );
        }

        echo json_encode($responseprod);

    }   

    mysqli_close($conn);

}