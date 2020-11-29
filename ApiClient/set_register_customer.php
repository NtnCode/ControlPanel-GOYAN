<?php
	require_once '../apiConnect/connect.php';
	//error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $name = $_POST['mail'];
        $direction = $_POST['direction'];
        $detail = $_POST['lname'];
        $token = $_POST['token'];
        $phone = $_POST['phone'];
		$photo = $_POST['photo'];
		
		$state = 1;

        $id = stripslashes($id);
        $name = stripslashes($name);
        $direction = stripslashes($direction);
        $detail = stripslashes($detail);
        $token = stripslashes($token);
		$phone = stripslashes($phone);
		$photo = stripslashes($photo);

        $id = $conn->real_escape_string($id);
        $name = $conn->real_escape_string($name);
        $direction = $conn->real_escape_string($direction);
        $detail = $conn->real_escape_string($detail);
        $token = $conn->real_escape_string($token);
		$phone = $conn->real_escape_string($phone);
		$photo = $conn->real_escape_string($photo);
    
        $stmt=$conn->prepare("INSERT INTO customer ( id_customer,
			firstname_customer,
			lastname_customer,
			email_customer,
			key_notification_customer,
			phone_customer,
			photo_customer,
			state_customer)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssiisi", $id, $direction, $detail, $name, $token, $phone, $photo, $state);
        
        if ($stmt->execute()) {
            $error ="done";
            echo json_encode(array("response"=>$error));
        } else {
            $error = "error";
            echo json_encode(array("response"=>$error));

            die("Error in bind_param: (" .$conn->errno . ") " . $conn->error);
        }

        $stmt->close();

    }