<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId'])) {

		$userId = $_POST['userId'];

		$get_user = mysqli_query($conn, "select * from tb_user where id = ".$userId."");
		$row = mysqli_fetch_row($get_user);
		$response['id'] = $row[0];
		$response['name'] = $row[1];
		$response['phone'] = $row[3];
		$response['email'] = $row[4];
		$response['gender'] = $row[5];
		$response['accountType'] = $row[6];
		$response['avatarUrl'] = $row[7];
		$response['birthday'] = $row[9];

	}

	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed";
	}


	echo json_encode($response, JSON_NUMERIC_CHECK);

?>