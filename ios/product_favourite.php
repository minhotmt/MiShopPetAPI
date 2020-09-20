<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId'])) {

		$userId = $_POST['userId'];

		$query = mysqli_query($conn, "select p.id, p.name, p.price, p.is_sale, p.sale_price from tb_favourite f, tb_product p, tb_user u where f.user_id = u.id and f.product_id = p.id and u.id = ".$userId." order by f.id desc");
		while ($rows = mysqli_fetch_array($query)) {
			
			$product['id'] = $rows['id'];
			$product['name'] = $rows['name'];
			$product['price'] = $rows['price'];
			$product['isSale'] = $rows['is_sale'];
			$product['salePrice'] = $rows['sale_price'];

			// fetch thumbnail url
			$thumbnail = mysqli_query($conn, "select * from tb_product_image where product_id = ".$product['id']." order by id asc");
			$row = mysqli_fetch_row($thumbnail);
			$product['thumbnailUrl'] = $row[2];

			// fetch rating
			$fetch_rating = mysqli_query($conn, "select sum(rating), count(rating) from tb_review where product_id = ". $product['id'] ." and status = '1'");
			$row_rating = mysqli_fetch_row($fetch_rating);
			if (!$row_rating[0]) {
				$product['rating'] = null;
			}
			else {
				$rating = $row_rating[0] / $row_rating[1];
				$product['rating'] = round($rating, 1);
			}

			$product['comment'] = $row_rating[1];

			array_push($response, $product);

		}

	}
	else {
		$response['error'] = true;
        $response['message'] = "Request not allowed";
	}	

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>