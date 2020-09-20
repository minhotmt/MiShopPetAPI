<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId'])) {

		$userId = $_POST['userId'];

		$q = mysqli_query($conn, "select * from tb_review where user_id = ".$userId." order by id desc");
		while ($rows = mysqli_fetch_array($q)) {
			
			$p['productId'] = $rows['product_id'];
			$p['rating'] = $rows['rating'];
			$p['comment'] = $rows['comment'];
			$p['status'] = $rows['status'];

			// thumbnail
			$th = mysqli_query($conn, "select * from tb_product_image where product_id = ".$p['productId']."");
			$row = mysqli_fetch_row($th);
			$p['thumbnailUrl'] = $row[2];

			array_push($response, $p);

		}

	}
	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed.";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>