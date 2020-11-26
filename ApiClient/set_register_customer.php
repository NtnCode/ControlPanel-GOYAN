<?php
	require_once '../apiConnect/connect.php';
	//error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $user = $_POST['mail'];
        $firstn = $_POST['name'];
        $lastn = $_POST['lname'];
        $token = $_POST['token'];
        $phone = $_POST['phone'];
		$photo = $_POST['photo'];
		
		$state = 1;

        $id = stripslashes($id);
        $user = stripslashes($user);
        $firstn = stripslashes($firstn);
        $lastn = stripslashes($lastn);
        $token = stripslashes($token);
		$phone = stripslashes($phone);
		$photo = stripslashes($photo);

        $id = $conn->real_escape_string($id);
        $user = $conn->real_escape_string($user);
        $firstn = $conn->real_escape_string($firstn);
        $lastn = $conn->real_escape_string($lastn);
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

        $stmt->bind_param("ssssiisi", $id, $firstn, $lastn, $user, $token, $phone, $photo, $state);
        
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