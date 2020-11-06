<?php
    include('../ApiConnect/connect.php');
    error_reporting(0);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $id = $_POST['id'];
        $user = $_POST['mail'];
        $firstn = $_POST['firstn'];
        $lastn = $_POST['lastn'];
        $token = $_POST['token'];
        $phone = $_POST['phone'];

        $state = 1;

        $id = stripslashes($id);
        $user = stripslashes($user);
        $firstn = stripslashes($firstn);
        $lastn = stripslashes($lastn);
        $token = stripslashes($token);
        $phone = stripslashes($phone);

        $id = $conn->real_escape_string($id);
        $user = $conn->real_escape_string($user);
        $firstn = $conn->real_escape_string($firstn);
        $lastn = $conn->real_escape_string($lastn);
        $token = $conn->real_escape_string($token);
        $phone = $conn->real_escape_string($phone);
        

        $stmt=$conn->prepare("INSERT INTO customer ( id_customer,
            firstname_cust,
            lastname_cust,
            email_cust,
            token_cust,
            phone_cust,
            state_cust)
            VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssi", $id, $firstn, $lastn, $user, $token, $phone, $state);
        
        if ($stmt->execute()) {
            $error ="ok_cust";
            echo json_encode(array("response"=>$error));
        } else {
            $error = "error_cust";
            echo json_encode(array("response"=>$error));

            die("Error in bind_param: (" .$conn->errno . ") " . $conn->error);
        }

        $stmt->close();
    }
    