<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId']) && isset($_POST['amount']) && isset($_POST['fee']) && isset($_POST['totalPrice']) && isset($_POST['shippingMethod']) && isset($_POST['paymentMethod'])) {

		$user_id = $_POST['userId'];
		$amount = $_POST['amount'];
		$fee = $_POST['fee'];
		$total_money = $_POST['totalPrice'];
		$shipping_method = $_POST['shippingMethod'];
		$payment_method = $_POST['paymentMethod'];

		// $user_id = 16;
		// $amount = 100000;
		// $fee = 20000;
		// $total_money = 120000;

		// general order id
		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$hour = date('h');
		$minute = date('i');
		$second = date('s');

		$order_id = $user_id . substr($year, -2) . $month . $day . $hour . $minute . $second;


		$order = mysqli_query($conn, "insert into tb_order (order_id, user_id, total_money, status, transport_fee, provisional_price, shipping_method, payment_method) values (".$order_id.", ".$user_id.", ".$total_money.", '1', ".$fee.", ".$amount.", ".$shipping_method.", ".$payment_method.")");

		if ($order) {			

			// lấy tất cả sản phẩm trong tb cart theo user id
			$get_product = mysqli_query($conn, "select * from tb_cart c, tb_product p where c.user_id = ".$user_id." and c.product_id = p.id");
			while ($row_products = mysqli_fetch_array($get_product)) {

				// thêm các sản phẩm lấy được từ tb cart vào tb order detail
				if ($row_products['is_sale'] == 1) { // sản phẩm giảm giá
					if (!empty($row_products['attribute_id'])) {
						$add_to_order_detail = mysqli_query($conn, "insert into tb_order_detail (order_id, product_id, attribute_id, price, quantity) values (".$order_id.", ".$row_products['product_id'].", ".$row_products['attribute_id'].", ".$row_products['sale_price'].", ".$row_products['quantity'].")");
						if ($add_to_order_detail) {
							$response['error'] = false;
						}
						else {
							$response['error'] = true;
						}
					} else {
						$add_to_order_detail = mysqli_query($conn, "insert into tb_order_detail (order_id, product_id, price, quantity) values (".$order_id.", ".$row_products['product_id'].", ".$row_products['sale_price'].", ".$row_products['quantity'].")");
						if ($add_to_order_detail) {
							$response['error'] = false;
						}
						else {
							$response['error'] = true;
						}
					}
					
				}

				else {
					if (!empty($row_products['attribute_id'])) {
						$add_to_order_detail = mysqli_query($conn, "insert into tb_order_detail (order_id, product_id, attribute_id, price, quantity) values (".$order_id.", ".$row_products['product_id'].", '".$row_products['attribute_id']."', ".$row_products['price'].", ".$row_products['quantity'].")");
						if ($add_to_order_detail) {
							$response['error'] = false;
						}
						else {
							$response['error'] = true;
						}
					} else {
						$add_to_order_detail = mysqli_query($conn, "insert into tb_order_detail (order_id, product_id, price, quantity) values (".$order_id.", ".$row_products['product_id'].", ".$row_products['price'].", ".$row_products['quantity'].")");
						if ($add_to_order_detail) {
							$response['error'] = false;
						}
						else {
							$response['error'] = true;
						}
					}
					
				}
				
			}

			// lấy address id từ bảng tb_address thêm vào bảng tb_order_address
			$get_address = mysqli_query($conn, "select * from tb_user_address where user_id = ".$user_id." and is_default = '1'");
			$row = mysqli_fetch_row($get_address);
			
			$add_address_id = mysqli_query($conn, "insert into tb_order_address (order_id, recipient_name, phone_number, street, user_id, province_city_id, district_id, commune_ward_town_id) values ('".$order_id."', '".$row[1]."', '".$row[2]."', '".$row[3]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."')");

			// xoá tất cả sản phẩm trong bảng tb_cart khi đã đặt hàng
			$delete_cart = mysqli_query($conn, "delete from tb_cart where user_id = ".$user_id."");

			$response['error'] = false;
			$response['orderId'] = $order_id;

		}

	}
	else {
		$response['error'] = true;
        $response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>