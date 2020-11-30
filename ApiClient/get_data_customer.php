<?php 
    require_once '../ApiConnect/connect.php';
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD']=='POST') {

        $id = $_POST['id'];

        $id = stripslashes($id);

        $id = $conn->real_escape_string($id);
        
        $stmt=$conn->prepare("SELECT * FROM customer where id_customer = ?");

        $stmt->bind_param("s", $id);
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
                'response'              =>'done',        
                'id_customer'           =>$row['id_customer'],
                'firstname_customer'    =>$row['firstname_customer'],
                'lastname_customer'     =>$row['lastname_customer'],
                'phone_customer'        =>$row['phone_customer'],
                'email_customer'        =>$row['email_customer'],
                'photo_customer'        =>$row['photo_customer'],
                'state_customer'        =>$row['state_customer'],
                'key_notification_customer' =>$row['key_notification_customer']
            )
            );
        }

        echo json_encode($response);

        $stmt->close();

    }else{
        echo 'Denied access.';
    }