<?php
include('../apiConnect/connect.php');
error_reporting(0);

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $type=$_POST['type'];
    $id_cus=$_POST['id_customer'];
    $id_res=$_POST['id_reservation'];

    $type = stripslashes($type);
    $id_cus = stripslashes($id_cus);
    $id_res = stripslashes($id_res);
    $type = $conn->real_escape_string($type);
    $id_cus = $conn->real_escape_string($id_cus);
    $id_res = $conn->real_escape_string($id_res);


    if ($type == 'id') {

        $queryS = "SELECT r.id_reservation, r.detail_reservation, r.date_reservation, r.time_reservation,
        r.timecollect_reservation, r.state_reservation, r.id_customer, r.grandtotal_reservation,
        r.id_timelinereserv, tl.name_timelinereserv, tl.description_timelinereserv,
        r.id_typepay, tp.name_typepay, tp.description_typepay,
        r.id_direccust,
        dr.target_detres,
        (SELECT SUM(dr.quantity_detres) FROM detail_reservation dr 
            WHERE dr.id_reservation = r.id_reservation) 
            As quantitytotal_detres
        FROM reservation r
        INNER JOIN detail_reservation dr ON dr.id_reservation = r.id_reservation
        INNER JOIN timeline_reservation tl ON tl.id_timelinereserv = r.id_timelinereserv
        INNER JOIN type_pay tp ON tp.id_typepay = r.id_typepay
        WHERE r.id_customer='$id_cus' AND r.id_reservation='$id_res'";

        $result = mysqli_query($conn, $queryS);
        # code...
        $response = array();

        while ($row = mysqli_fetch_assoc($result)) {
            array_push(
                $response,
                    array(
                        'id_reservation'            =>$row['id_reservation'],
                        'detail_reservation'        =>$row['detail_reservation'],
                        'date_reservation'          =>$row['date_reservation'],
                        'time_reservation'          =>$row['time_reservation'],
                        'timecollect_reservation'   =>$row['timecollect_reservation'],
                        'id_customer'               =>$row['id_customer'],
                        'state_reservation'         =>$row['state_reservation'],
                        'id_timelinereserv'         =>$row['id_timelinereserv'],
                        'name_timelinereserv'       =>$row['name_timelinereserv'],
                        'description_timelinereserv'=>$row['description_timelinereserv'],
                        'id_typepay'                =>$row['id_typepay'],
                        'name_typepay'              =>$row['name_typepay'],
                        'description_typepay'       =>$row['description_typepay'],
                        'id_direccust'              =>$row['id_direccust'],
                        'target_detres'             =>$row['target_detres'],
                        'quantitytotal_detres'      =>$row['quantitytotal_detres'],
                        'grandtotal_reservation'    =>$row['grandtotal_reservation']
                )
            );
        }
        echo json_encode($response);

    }elseif ($type == 'list') {

        $queryS = "SELECT r.id_reservation,
            dr.target_detres,
            FROM reservation r
            INNER JOIN detail_reservation dr ON dr.id_reservation = r.id_reservation
            WHERE r.id_customer='$id_cus' AND r.id_reservation='$id_res'";
        $result = mysqli_query($conn, $queryS);
        # code...
        $response = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $target = $row['target_detres'];
            if($target == 1){
                
            }

            array_push(
                $response,
                array(
                        'id_reservation'            =>$row['id_reservation'],
                        'detail_reservation'        =>$row['detail_reservation']
                )
            );
        }
        echo json_encode($response);


    }
    
    mysqli_close($conn);
}