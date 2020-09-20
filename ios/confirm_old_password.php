<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['phone']) && isset($_POST['old_password'])) {

		$phone = $_POST['phone'];
		$old_password = md5($_POST['old_password']);

		$q = mysqli_query($conn, "select * from tb_user where phone = '". $phone ."' and password = '". $old_password ."'");
		$row_count = mysqli_num_rows($q);

		if ($row_count == 0) {
			$response['error'] = true;
		}
		else {
			$response['error'] = false;
		}

	}
	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed";
	}

	

	echo json_encode($response, JSON_NUMERIC_CHECK);


?>