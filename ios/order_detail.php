<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['orderId']) && isset($_POST['userId'])) {

		$orderId = $_POST['orderId'];
		$userId = $_POST['userId'];

		// 1
		$q = mysqli_query($conn, "select o.order_date, o.status, o.transport_fee, o.provisional_price, o.total_money, shipping_method, payment_method from tb_order o where o.order_id = ".$orderId." and o.user_id = ".$userId."");
		$row = mysqli_fetch_row($q);

		$transportFee = $row[2];
		$provisionalPrice = $row[3];
		$totalPrice = $row[4];

		$mdh['orderId'] = $orderId;
		$mdh['orderDate'] = $row[0];
		$mdh['orderStatus'] = $row[1];
		$mdh['paymentMethod'] = $row[6];

		array_push($response, $mdh);


		// 2
		$q2 = mysqli_query($conn, "select oa.recipient_name, oa.phone_number, oa.street, pc.name as pc_name, d.name as d_name, cwt.name as cwt_name from tb_order_address oa, tb_province_city pc, tb_district d, tb_commune_ward_town cwt where user_id = ".$userId." and oa.order_id = ".$orderId." and oa.province_city_id = pc.id and oa.district_id = d.id and oa.commune_ward_town_id = cwt.id");
		$row2 = mysqli_fetch_row($q2);

		$dcnh['title'] = "Địa chỉ người nhận";
		$dcnh['name'] = $row2[0];
		$dcnh['phone'] = $row2[1];
		$dcnh['street'] = $row2[2];
		$dcnh['communeWardTown'] = $row2[5];
		$dcnh['district'] = $row2[4];
		$dcnh['provinceCity'] = $row2[3];

		array_push($response, $dcnh);

		// 3
		$htgh['title'] = "Hình thức giao hàng";
		$htgh['shippingMethod'] = $row[5];
		array_push($response, $htgh);

		// 4
		$httt['title'] = "Hình thức thanh toán";
		$httt['paymentMethod'] = $row[6];
		array_push($response, $httt);

		// 5
		$ttdh['title'] = "Thông tin đơn hàng";
		$ttdh['products'] = array();

		$query = mysqli_query($conn, "select p.name as product_name, od.product_id, od.attribute_id, od.price, od.quantity from tb_order_detail od, tb_order o, tb_product p where o.user_id = ".$userId." and od.order_id = o.order_id and o.order_id = ".$orderId." and od.product_id = p.id order by od.id desc");
		while ($rows = mysqli_fetch_array($query)) {
			
			$p['id'] = $rows['product_id'];
			$p['attributeId'] = $rows['attribute_id'];

			if (!empty($p['attributeId'])) {
				$attributes = mysqli_query($conn, "select * from tb_product_attribute where product_id = ".$p['id']." and id = ".$p['attributeId']."");
				$r = mysqli_fetch_row($attributes);
				
				if (empty($r[2])) { // color_id = null
					$sql2 = "select * from tb_size where id = ".$r[3]."";
					$query2 = mysqli_query($conn,$sql2);
					$row = mysqli_fetch_row($query2);

					$p['name'] = $rows['product_name'] . " - " . $row[1];
				}
				else if (empty($r[3])) { // size_id = null
					$sql2 = "select * from tb_color where id = ".$r[2]."";
					$query2 = mysqli_query($conn,$sql2);
					$row = mysqli_fetch_row($query2);

					$p['name'] = $rows['product_name'] . " - " . $row[1];
				}
				else {
					$sql2 = "select c.name as color_name, s.name as size_name from tb_color c, tb_size s where c.id = ".$r[2]." and s.id = ".$r[3]."";
					$query2 = mysqli_query($conn, $sql2);
					$row = mysqli_fetch_row($query2);

					$p['name'] = $rows['product_name'] . " - " . $row[0] . " - " . $row[1];
				}

			} else {
				$attributes = mysqli_query($conn, "select name from tb_product where id = ".$p['id']."");
				$row = mysqli_fetch_row($attributes);

				$p['name'] = $row[0];
			}

			// price
			$p['price'] = $rows['price'];

			$i = mysqli_query($conn, "select * from tb_product_image where product_id = ".$p['id']." order by id asc");
			$row_i = mysqli_fetch_row($i);

			$p['thumbnailUrl'] = $row_i[2];
			$p['quantity'] = $rows['quantity'];

			array_push($ttdh['products'], $p);

		}

		$ttdh['provisionalPrice'] = $provisionalPrice;
		$ttdh['transportFee'] = $transportFee;

		array_push($response, $ttdh);

		// 6
		$tt['title'] = "Thành tiền";
		$tt['totalPrice'] = $totalPrice;

		array_push($response, $tt);

	}
	else {
		$response['error'] = true;
        $response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>