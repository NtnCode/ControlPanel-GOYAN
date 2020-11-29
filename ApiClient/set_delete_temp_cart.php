<?php
	require_once '../apiConnect/connect.php';
	error_reporting(0);
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$id = $_POST['id_item'];
		$type = $_POST['type'];
		$id_customer = $_POST['id_customer'];

		
		if ($type === 'oneitem') {
			# code...
			$query = "DELETE FROM temporal_cart WHERE id_tempcart = $id AND id_customer = '$id_customer'";
			$result = mysqli_query($conn, $query);
			
			if ($result) {
				$error="ok";
				echo json_encode(array("response" => $error));
			} else {
				$error = "error";
				echo json_encode(array("response"=>$error));
			}

		}elseif ($type === 'allitem') {
			# code...
			$queryAll = "DELETE FROM temporal_cart WHERE id_customer = '$id_customer'";
			$resultAll = mysqli_query($conn, $queryAll);
					
			if ($resultAll) {
				$error="ok";
				echo json_encode(array("response" => $error));
			} else {
				$error = "error";
				echo json_encode(array("response"=>$error));
			}
		}

		
		
		mysqli_close($conn);
	}