<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId']) && isset($_POST['productId'])) {

		$productId = $_POST['productId'];
		$userId = $_POST['userId'];

		$q = mysqli_query($conn, "insert into tb_favourite (user_id, product_id) values (".$userId.", ".$productId.")");

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