<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId'])) {

		$userId = $_POST['userId'];

		$query = mysqli_query($conn, "select distinct(od.product_id), od.price from tb_order o, tb_order_detail od where o.user_id = ".$userId." and od.order_id = o.order_id and o.status = '3' order by od.id desc");

		while ($rows = mysqli_fetch_array($query)) {
			
			$p['id'] = $rows['product_id'];

			$attributes = mysqli_query($conn, "select name from tb_product where id = ".$p['id']."");
			$r = mysqli_fetch_row($attributes);
			$p['name'] = $r[0];

			$p['price'] = $rows['price'];

			// fetch thumbnail url
			$thumbnail = mysqli_query($conn, "select * from tb_product_image where product_id = ".$p['id']." order by id asc");
			$row = mysqli_fetch_row($thumbnail);
			$p['thumbnailUrl'] = $row[2];

			// fetch rating
			$fetch_rating = mysqli_query($conn, "select sum(rating), count(rating) from tb_review where product_id = ". $p['id'] ." and status = '1'");
			$row_rating = mysqli_fetch_row($fetch_rating);

			if (!$row_rating[0]) {
				$p['rating'] = null;
			}
			else {
				$rating = $row_rating[0] / $row_rating[1];
				$p['rating'] = round($rating, 1);
				
			}

			$p['comment'] = $row_rating[1];
			
			array_push($response, $p);

		}

	}
	else {
		$response['error'] = true;
		$response['message'] = "Request is not allowed.";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>