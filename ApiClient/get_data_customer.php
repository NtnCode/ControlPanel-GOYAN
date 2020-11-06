<?php
    include('../ApiConnect/connect.php');
    error_reporting(0);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];

        $id = stripslashes($id);

        $id = $conn->real_escape_string($id);
        

        $stmt=$conn->prepare("SELECT * FROM customer where id_customer = ?");

        $stmt->bind_param ("s", $id);
        $stmt->execute();

        $response = array();

        $result = $stmt->get_result();
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
                    'response' => 'done',
                    'id_customer'    =>$row['id_customer'],
                    'firstname_cust' =>$row['firstname_cust'],
                    'lastname_cust'  =>$row['lastname_cust'],
                    'email_cust'     =>$row['email_cust'],
                    'phone_cust'     =>$row['phone_cust'],
                    'state_cust'     =>$row['state_cust']
                    
                )
            );
        }

        echo json_encode($response);


        $stmt->close();
    }else{
        echo 'Denied access.';
    }
