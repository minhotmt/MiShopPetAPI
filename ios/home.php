<?php

	require '../includes/DBConnection.php';

	$response = array();

	// header banners
	$b['id'] = null;
	$b['title'] = "";
	$b['banner'] = "";
	$b['products'] = array();
	$fetch_banners = mysqli_query($conn, "select * from tb_banner");
	while ($row_banners = mysqli_fetch_array($fetch_banners)) {
		$banner['thumbnailUrl'] = $row_banners['banner_url'];
		array_push($b['products'], $banner);
	}
	array_push($response, $b);



	// sản phẩm mới
	$n['id'] = 1;
	$n['title'] = "SẢN PHẨM MỚI";
	$n['banner'] = "https://tamnguyenshop.vn/wp-content/uploads/2019/07/banner01.png";
	$n['products'] = array();

	$new_p = mysqli_query($conn, "select * from tb_product order by id desc limit 20");
	while ($rows = mysqli_fetch_array($new_p)) {
		$np['id'] = $rows['id'];
		$np['name'] = $rows['name'];
		$np['price'] = $rows['price'];
		$np['isSale'] = $rows['is_sale'];
		$np['salePrice'] = $rows['sale_price'];

		// fetch thumbnail image for new product
		$thumbnail = mysqli_query($conn, "select * from tb_product_image where product_id = ".$np['id']." order by id asc");
		$row = mysqli_fetch_row($thumbnail);
		$np['thumbnailUrl'] = $row[2];

		// fetch rating
		$r = mysqli_query($conn, "select sum(rating), count(rating) from tb_review where product_id = ". $np['id'] ." and status = '1'");
		$row_r = mysqli_fetch_row($r);

		if (!$row_r[0]) {
			$np['rating'] = null;
		}
		else {
			$rating = $row_r[0] / $row_r[1];
			$np['rating'] = round($rating, 1);
		}

		$np['comment'] = $row_r[1];
		
		array_push($n['products'], $np);
	}
	array_push($response, $n);



	// sản phẩm giảm giá
	$s['id'] = 2;
	$s['title'] = "SẢN PHẨM GIẢM GIÁ";
	$s['banner'] = "https://media3.scdn.vn/img3/2019/10_24/5OOCTC.jpg";
	$s['products'] = array();

	// fetch sale products
	$sale_p = mysqli_query($conn, "select * from tb_product where is_sale = '1' order by id desc limit 20");
	while ($rows = mysqli_fetch_array($sale_p)) {
		$sp['id'] = $rows['id'];
		$sp['name'] = $rows['name'];
		$sp['price'] = $rows['price'];
		$sp['isSale'] = $rows['is_sale'];
		$sp['salePrice'] = $rows['sale_price'];
		
		// fetch thumbnail image for sale product
		$thumbnail = mysqli_query($conn, "select * from tb_product_image where product_id = ".$sp['id']." order by id asc");
		$row = mysqli_fetch_row($thumbnail);
		$sp['thumbnailUrl'] = $row[2];

		// fetch rating
		$rating = mysqli_query($conn, "select sum(rating), count(rating) from tb_review where product_id = ". $sp['id'] ." and status = '1'");
		$row_rating = mysqli_fetch_row($rating);

		if (!$row_rating[0]) {
			$sp['rating'] = null;
		}
		else {
			$rating = $row_rating[0] / $row_rating[1];
			$sp['rating'] = round($rating, 1);
			
		}

		$sp['comment'] = $row_rating[1];

		array_push($s['products'], $sp);
	}
	array_push($response, $s);

	
	// sản phẩm bán nhiều nhất
	$bs['id'] = 3;
	$bs['title'] = "SẢN PHẨM BÁN NHIỀU NHẤT";
	$bs['banner'] = "https://dslv9ilpbe7p1.cloudfront.net/dj3ZqbCKSKhKM61HXiH1BA_store_banner_image.jpeg";
	$bs['products'] = array();

	// fetch best selling products
	$bs_p = mysqli_query($conn, "select distinct(p.id), p.name, p.price, p.is_sale, p.sale_price from tb_product p, tb_order o, tb_order_detail od where od.order_id = od.order_id and o.status = '3' and od.product_id = p.id order by id desc limit 20");
	while ($rows = mysqli_fetch_array($bs_p)) {
		$bsp['id'] = $rows['id'];
		$bsp['name'] = $rows['name'];
		$bsp['price'] = $rows['price'];
		$bsp['isSale'] = $rows['is_sale'];
		$bsp['salePrice'] = $rows['sale_price'];
		
		// fetch thumbnail image for best selling product
		$thumbnail = mysqli_query($conn, "select * from tb_product_image where product_id = ".$bsp['id']." order by id asc");
		$row = mysqli_fetch_row($thumbnail);
		$bsp['thumbnailUrl'] = $row[2];

		// fetch rating
		$rating = mysqli_query($conn, "select sum(rating), count(rating) from tb_review where product_id = ". $bsp['id'] ." and status = '1'");
		$row_rating = mysqli_fetch_row($rating);

		if (!$row_rating[0]) {
			$bsp['rating'] = null;
		}
		else {
			$rating = $row_rating[0] / $row_rating[1];
			$bsp['rating'] = round($rating, 1);
			
		}

		$bsp['comment'] = $row_rating[1];

		array_push($bs['products'], $bsp);
	}
	array_push($response, $bs);


	echo json_encode($response, JSON_NUMERIC_CHECK);

?>