<?php

	require '../includes/DBConnection.php';

	if (isset($_POST['productId']) && $_POST['userId']) {

		$productId = $_POST['productId'];
		$userId = $_POST['userId'];

		if (isset($_POST['attributeId'])) {
			$attributeId = $_POST['attributeId'];
			$delete_cart_product = mysqli_query($conn, "delete from tb_cart where product_id = ".$productId." and attribute_id = ".$attributeId." and user_id = ".$userId."");
		}
		else {
			$delete_cart_product = mysqli_query($conn, "delete from tb_cart where product_id = ".$productId." and user_id = ".$userId."");
		}
	}

	
?>