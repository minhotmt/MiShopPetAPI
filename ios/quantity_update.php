<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['quantity']) && isset($_POST['userId']) && isset($_POST['productId'])) {

		$quantity = $_POST['quantity'];
		$userId = $_POST['userId'];
		$productId = $_POST['productId'];

		if (isset($_POST['attributeId'])) {
			$attributeId = $_POST['attributeId'];
			$quantity_update = mysqli_query($conn, "update tb_cart set quantity = ". $quantity ." where user_id = ". $userId ." and product_id = ". $productId ." and attribute_id = ".$attributeId."");
		} else {
			$quantity_update = mysqli_query($conn, "update tb_cart set quantity = ". $quantity ." where user_id = ". $userId ." and product_id = ". $productId ."");
		}
	}
	else {
		$response['error'] = true;
		$response['message'] = "Request is not allowed.";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);


?>