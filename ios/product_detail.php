<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['productId']) && isset($_POST['userId'])) {

		$productId = $_POST['productId'];
		$userId = $_POST['userId'];

		// cell 1
		$fetch_detail = mysqli_query($conn, "select * from tb_product where id = ". $productId ."");
		$row_product = mysqli_fetch_row($fetch_detail);

		$c1['id'] = $row_product[0];
		$c1['name'] = $row_product[1];
		$c1['price'] = $row_product[2];
		$c1['isSale'] = $row_product[3];
		$c1['salePrice'] = $row_product[4];
		$c1['images'] = array();

		// fetch images
		$c1['images'] = array();
		$fetch_image_url = mysqli_query($conn, "select * from tb_product p, tb_product_image i where i.product_id = p.id and p.id = ". $c1['id'] ."");
		while ($row_image_url = mysqli_fetch_array($fetch_image_url)) {

			$image['imageUrl'] = $row_image_url['image_url'];

			array_push($c1['images'], $image);
		}

		// fetch rating
		$fetch_rating = mysqli_query($conn, "select sum(rating), count(rating) from tb_review where product_id = ". $c1['id'] ." and status = '1'");
		$row_rating = mysqli_fetch_row($fetch_rating);
		if (!$row_rating[0]) {
			$c1['rating'] = null;
		}
		else {
			$rating = $row_rating[0] / $row_rating[1];
			$c1['rating'] = round($rating, 1);
		}

		$get_total_comment = mysqli_query($conn, "select count(comment) from tb_review where product_id = ". $c1['id'] ." and status = '1'");
		$row_comment = mysqli_fetch_row($get_total_comment);
		$c1['comment'] = $row_comment[0];

		// check favourite
		$f = mysqli_query($conn, "select * from tb_favourite where product_id = ".$c1['id']." and user_id = ".$userId."");
		$row_f = mysqli_num_rows($f);

		if ($row_f > 0) {
			$c1['isFavourite'] = true;	
		}
		else {
			$c1['isFavourite'] = false;	
		}

		// check attributes
		$att = mysqli_query($conn, "select * from tb_product_attribute where product_id = ".$c1['id']."");
		$row_att = mysqli_num_rows($att);

		if ($row_att > 0) {
			$c1['isAttribute'] = true;	
		}
		else {
			$c1['isAttribute'] = false;	
		}
		
		array_push($response, $c1);

		// cell 2
		$c2['title'] = "MÔ TẢ SẢN PHẨM";
		$c2['description'] = $row_product[6];

		array_push($response, $c2);

		// cell 3
		$c3['title'] = "ĐÁNH GIÁ SẢN PHẨM";

		if (!$row_rating[0]) {
			$c3['rating'] = null;
		}
		else {
			$rating = $row_rating[0] / $row_rating[1];
			$c3['rating'] = round($rating, 1);
		}

		$c3['comment'] = $row_comment[0];

		$c3['comments'] = array();

		$q = mysqli_query($conn, "select r.rating, r.comment, u.name, r.created_at from tb_review r, tb_product p, tb_user u where r.product_id = p.id and p.id = ".$productId." and r.user_id = u.id and r.status = '1'");

		while ($rows = mysqli_fetch_array($q)) {
			$r['rating'] = $rows['rating'];
			$r['commentText'] = $rows['comment'];
			$r['userName'] = $rows['name'];
			$r['createAt'] = $rows['created_at'];

			array_push($c3['comments'], $r);
		}

		array_push($response, $c3);

	}
	else {
		$response['error'] = true;
        $response['message'] = "Request not allowed";
	}


	echo json_encode($response, JSON_NUMERIC_CHECK);


?>