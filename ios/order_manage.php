<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId']) && isset($_POST['orderStatus'])) {

		$userId = $_POST['userId'];
		$orderStatus = $_POST['orderStatus'];

		$q = mysqli_query($conn, "select order_id, order_date, status from tb_order where user_id = ".$userId." and status = ".$orderStatus." order by id desc");
		while ($row_orders = mysqli_fetch_array($q)) {
			
			$order['orderId'] = $row_orders['order_id'];

			$q2 = mysqli_query($conn, "select od.id from tb_order_detail od where od.order_id = ".$order['orderId']." order by id asc");
			$row_count = mysqli_num_rows($q2);

			// $row = mysqli_fetch_row($q2);

			$order['orderName'] = "Đơn hàng gồm " . $row_count . " sản phẩm";
			$order['orderDate'] = $row_orders['order_date'];
			$order['orderStatus'] = $row_orders['status'];

			array_push($response, $order);

		}

	}
	else {
		$response['error'] = true;
        $response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>