<?php 
    require_once '../ApiConnect/connect.php';
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD']==='POST') {

        $id = $_POST['id_cus'];

        $id = stripslashes($id);

        $id = $conn->real_escape_string($id);
        
        $stmt=$conn->prepare("SELECT * FROM direccion_customer where id_customer = ?");

        $stmt->bind_param("s", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $response = array();

        if (!$result) {
            array_push(
                $response,
                array(
                    'response' => 'error_conn',
                )
            );
        }

        if ($result->num_rows === 0) {
            array_push(
                $response,
                array(
                        'response' => 'error_empty',
                    )
            );
        }
        
        while ($row = $result->fetch_assoc()) {
            array_push(
                $response,
                array(
                'response'              =>'done',        
                'id_direccust'          =>$row['id_direccust'],
                'name_direccust'        =>$row['name_direccust'],
                'direction_direccust'   =>$row['direction_direccust'],
                'detail_direccust'      =>$row['detail_direccust'],
                'latitude_direccust'    =>$row['latitude_direccust'],
                'longitude_direccust'   =>$row['longitude_direccust'],
                'state_direccust'       =>$row['state_direccust'],
                'id_customer'           =>$row['id_customer']
            )
            );
        }

        echo json_encode($response);

        $stmt->close();

    }else{
        echo 'Denied access.';
    }