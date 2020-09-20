<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['phone']) && isset($_POST['new_password'])) {

		$phone = $_POST['phone'];
		$new_password = md5($_POST['new_password']);

		$q = mysqli_query($conn, "update tb_user set password = '".$new_password."' where phone = '".$phone."'");

		if ($q) {
			$response['error'] = false;
		}
		else {
			$response['error'] = true;	
		}

	}

	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);


?>