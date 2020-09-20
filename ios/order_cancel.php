<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId']) && isset($_POST['orderId'])) {

		$userId = $_POST['userId'];
		$orderId = $_POST['orderId'];

		$q = mysqli_query($conn, "update tb_order set status = '4' where user_id = ".$userId." and order_id = ".$orderId."");
		if ($q) {
			$response['error'] = false;
		}

	}
	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>