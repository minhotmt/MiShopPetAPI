<?php
	
	require '../includes/DBConnection.php';

	$response = array();
	
	if (isset($_POST['categoryId'])) {

		$categoryId = $_POST['categoryId'];

		$fetch_products = mysqli_query($conn, "select * from tb_product where child_category_id = ". $categoryId ." order by id desc");
		while ($row_products = mysqli_fetch_array($fetch_products)) {
		
			$product['id'] = $row_products['id'];
			$product['name'] = $row_products['name'];
			$product['price'] = $row_products['price'];
			$product['isSale'] = $row_products['is_sale'];
			$product['salePrice'] = $row_products['sale_price'];

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

	else if (isset($_POST['searchText'])) {
		
		$searchText = $_POST['searchText'];

		$fetch_products = mysqli_query($conn, "select * from tb_product where name like '%$searchText%' order by id desc");
		while ($row_products = mysqli_fetch_array($fetch_products)) {
		
			$product['id'] = $row_products['id'];
			$product['name'] = $row_products['name'];
			$product['price'] = $row_products['price'];
			$product['isSale'] = $row_products['is_sale'];
			$product['salePrice'] = $row_products['sale_price'];

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
				$product['rating'] = $rating;
			}

			$product['comment'] = $row_rating[1];

			array_push($response, $product);

		}

	}

	else if (isset($_POST['homeCategoryId'])) {

		$homeCategoryId = $_POST['homeCategoryId'];

		if ($homeCategoryId == 1) {
			$fetch_products = mysqli_query($conn, "select * from tb_product order by id desc limit 100");
		}
		if ($homeCategoryId == 2) {
			$fetch_products = mysqli_query($conn, "select * from tb_product where is_sale = '1' order by id desc");
		}
		if ($homeCategoryId == 3) {
			$fetch_products = mysqli_query($conn, "select distinct(p.id), p.name, p.price, p.is_sale, p.sale_price from tb_product p, tb_order o, tb_order_detail od where od.order_id = od.order_id and o.status = '3' and od.product_id = p.id order by id desc");
		}

		while ($row_products = mysqli_fetch_array($fetch_products)) {
		
			$product['id'] = $row_products['id'];
			$product['name'] = $row_products['name'];
			$product['price'] = $row_products['price'];
			$product['isSale'] = $row_products['is_sale'];
			$product['salePrice'] = $row_products['sale_price'];

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
	else if (isset($_POST['trademarkId'])) {

		$brand_id = $_POST['trademarkId'];

		$fetch_products = mysqli_query($conn, "select * from tb_product where brand_id = ". $brand_id ." order by id desc");
		while ($row_products = mysqli_fetch_array($fetch_products)) {
		
			$product['id'] = $row_products['id'];
			$product['name'] = $row_products['name'];
			$product['price'] = $row_products['price'];
			$product['isSale'] = $row_products['is_sale'];
			$product['salePrice'] = $row_products['sale_price'];

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