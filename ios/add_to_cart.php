<?php

	require '../includes/DBConnection.php';

	$response = array();

	function isProductExist($productId, $userId) {
		require '../includes/DBConnection.php';
		$q = mysqli_query($conn, "select * from tb_cart where product_id = ".$productId." and user_id = ".$userId."");
		$row = mysqli_num_rows($q);
		return $row;
	}

	function isProductExistWithAttributeId($productId, $userId, $attributeId) {
		require '../includes/DBConnection.php';
		$q = mysqli_query($conn, "select * from tb_cart where product_id = ".$productId." and user_id = ".$userId." and attribute_id = ".$attributeId."");
		$row = mysqli_num_rows($q);
		return $row;
	}

	if (isset($_POST['productId']) && isset($_POST['userId'])) {

		$productId = $_POST['productId'];
		$userId = $_POST['userId'];

		if (isset($_POST['attributeId'])) {
			$attributeId = $_POST['attributeId'];
			if (isProductExistWithAttributeId($productId, $userId, $attributeId) > 0) {
				$update_quantity = mysqli_query($conn, "update tb_cart set quantity = (quantity + 1) where product_id = ".$productId." and user_id = ".$userId." and attribute_id = ".$attributeId."");
				
				$response['error'] = false;
			
			}
			else {
				$add_to_cart = mysqli_query($conn, "insert into tb_cart (product_id, attribute_id, user_id, quantity) values (".$productId.", ".$attributeId.", ".$userId.", '1')");
				$response['error'] = false;
			}
		}
		else {
			if (isProductExist($productId, $userId) > 0) {
				$update_quantity = mysqli_query($conn, "update tb_cart set quantity = (quantity + 1) where product_id = ".$productId." and user_id = ".$userId."");
				
				$response['error'] = false;
			
			}
			else {
				$add_to_cart = mysqli_query($conn, "insert into tb_cart (product_id, user_id, quantity) values (".$productId.", ".$userId.", '1')");
				$response['error'] = false;
			}
		}
	}
	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>