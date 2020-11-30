<?php 
    require_once '../ApiConnect/connect.php';
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        
        $stmt=$conn->prepare("SELECT * FROM type_pay ORDER BY id_typepay ASC");

        $stmt->execute();

        $result = $stmt->get_result();
        $response = array();

        if ($result->num_rows === 0) {
            array_push(
                $response,
                array(
                        'response' => 'error',
                    )
            );
        }
        
        while ($row = $result->fetch_assoc()) {
            array_push(
                $response,
                array(
                'response'             =>'done',        
                'id_typepay'          =>$row['id_typepay'],
                'name_typepay'         =>$row['name_typepay'],
                'description_typepay'  =>$row['description_typepay'],
                'state_typepay'        =>$row['state_typepay']
            )
            );
        }

        echo json_encode($response);

        $stmt->close();

    }else{
        echo 'Denied access.';
    }