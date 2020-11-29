<?php
	require_once '../apiConnect/connect.php';
	error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $type = $_POST['type'];

        $id = $_POST['id_cust'];
        $iddirec = $_POST['id_direc'];
        $name = $_POST['name'];
        $direction = $_POST['direction'];
        $detail = $_POST['detail'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

		
		$state = 1;

        $id = stripslashes($id);
        $iddirec = stripslashes($iddirec);
        $name = stripslashes($name);
        $direction = stripslashes($direction);
        $detail = stripslashes($detail);
        $latitude = stripslashes($latitude);
        $longitude = stripslashes($longitude);


        $id = $conn->real_escape_string($id);
        $iddirec = $conn->real_escape_string($iddirec);
        $name = $conn->real_escape_string($name);
        $direction = $conn->real_escape_string($direction);
        $detail = $conn->real_escape_string($detail);
        $latitude = $conn->real_escape_string($latitude);
        $longitude = $conn->real_escape_string($longitude);
        
        if($type === 'insert'){
            
            $stmt=$conn->prepare("INSERT INTO direccion_customer (  
                name_direccust,
                direction_direccust,
                detail_direccust,
                latitude_direccust,
                longitude_direccust,
                state_direccust,
                id_customer )
                VALUES (?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("sssssis", $name, $direction, $detail, $latitude, $longitude, $state, $id);
            
            if ($stmt->execute()) {
                $error ="done_ins";
                echo json_encode(array("response"=>$error));
            } else {
                $error = "error_ins";
                echo json_encode(array("response"=>$error));
                die("Error in bind_param: (" .$conn->errno . ") " . $conn->error);
            }
        
        }elseif ($type === 'update') {

            $stmt=$conn->prepare("UPDATE direccion_customer SET 
                name_direccust =?, direction_direccust =?, detail_direccust =?, latitude_direccust=?, 
                longitude_direccust =? WHERE id_customer =? AND id_direccust =?");

            $stmt->bind_param("ssssssi", $name, $direction, $detail, $latitude, $longitude, $id, $iddirec);
            
            if ($stmt->execute()) {
                $error ="done_upd";
                echo json_encode(array("response"=>$error));
            } else {
                $error = "error_upd";
                echo json_encode(array("response"=>$error));
                die("Error in bind_param: (" .$conn->errno . ") " . $conn->error);
            }

        }
        
        $stmt->close();

    }