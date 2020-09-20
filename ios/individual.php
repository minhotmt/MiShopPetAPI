<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId'])) {

		$userId = $_POST['userId'];
		$status = 3; // san pham da mua

		$pending = mysqli_query($conn, "select count(order_id) as pending from tb_order where user_id = ".$userId." and status = '1'");

		$shipping = mysqli_query($conn, "select count(order_id) as pending from tb_order where user_id = ".$userId." and status = '2'");


		$purchased = mysqli_query($conn, "select distinct(od.product_id), o.order_id, o.user_id from tb_order o, tb_order_detail od, tb_user u where od.order_id = o.order_id and o.user_id = u.id and u.id = ".$userId." and o.status = ".$status." and not exists (select rv.order_id, rv.product_id, rv.user_id from tb_review rv where rv.order_id = o.order_id and rv.product_id = od.product_id and rv.user_id = o.user_id)");

		$row_purchased = mysqli_num_rows($purchased);
		$row_pending = mysqli_fetch_row($pending);
		$row_shipping = mysqli_fetch_row($shipping);

		$response['error'] = false;
		$response['pending'] = $row_pending[0];
		$response['shipping'] = $row_shipping[0];
		$response['purchased'] = $row_purchased;


	}

	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>