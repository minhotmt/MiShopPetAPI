<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId'])) {

		$userId = $_POST['userId'];
		$status = 3; // san pham da mua

		$q = mysqli_query($conn, "select distinct(od.product_id), o.order_id, o.user_id from tb_order o, tb_order_detail od, tb_user u where od.order_id = o.order_id and o.user_id = u.id and u.id = ".$userId." and o.status = ".$status." and not exists (select rv.order_id, rv.product_id, rv.user_id from tb_review rv where rv.order_id = o.order_id and rv.product_id = od.product_id and rv.user_id = o.user_id)");

		while ($rows = mysqli_fetch_array($q)) {
			
			$p['id'] = $rows['product_id'];
			$p['orderId'] = $rows['order_id'];

			$attributes = mysqli_query($conn, "select name from tb_product where id = ".$p['id']."");
			$r = mysqli_fetch_row($attributes);
			$p['name'] = $r[0];

			// fetch thumbnail_url
			$thumbnail = mysqli_query($conn, "select * from tb_product_image where product_id = ".$p['id']." order by id asc");
			$row = mysqli_fetch_row($thumbnail);

			$p['thumbnailUrl'] = $row[2];

			array_push($response, $p);

		}

	}
	else {
		$response['error'] = true;
        $response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>