<?php
	
	require '../includes/DBConnection.php';

	$response = array();
	

	if (isset($_POST['userId'])) {

		$user_id = $_POST['userId'];

		// thông tin đơn hàng
		$ttdh['title'] = "Thông tin đơn hàng";
		$ttdh['products'] = array();

		$provisionalPrice = 0;

		// fetch products
		$fetch_products = mysqli_query($conn, "select distinct(p.id) as product_id, p.name as product_name, p.price, p.is_sale, p.sale_price, c.attribute_id, c.quantity from tb_cart c, tb_product p, tb_user u where c.product_id = p.id and c.user_id = u.id and u.id = ".$user_id." order by c.id desc");
		while ($rows = mysqli_fetch_array($fetch_products)) {
			
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
				$p['name'] = $rows['product_name'];
			}

			$p['price'] = $rows['price'];
			$p['isSale'] = $rows['is_sale'];
			$p['salePrice'] = $rows['sale_price'];
			$p['quantity'] = $rows['quantity'];

			if ($p['isSale'] == 1) {
				$provisionalPrice += $p['salePrice'] * $p['quantity'];
			}
			else {
				$provisionalPrice += $p['price'] * $p['quantity'];
			}

			// fetch thumbnail url
			$thumbnail = mysqli_query($conn, "select * from tb_product_image where product_id = ".$p['id']." order by id asc");
			$row = mysqli_fetch_row($thumbnail);
			$p['thumbnailUrl'] = $row[2];
			
			array_push($ttdh['products'], $p);

		}

		array_push($response, $ttdh);

		// địa chỉ nhận hàng
		$dcnh['title'] = "Địa chỉ nhận hàng";

		// fetch address
		$fetch_address = mysqli_query($conn, "select a.id, a.recipient_name, a.phone_number, a.street, pc.name as pc_name, d.name as d_name, cwt.name as cwt_name, a.is_default from tb_user_address a, tb_user u, tb_province_city pc, tb_district d, tb_commune_ward_town cwt where is_default = '1' and u.id = a.user_id and a.user_id = ".$user_id." and a.province_city_id = pc.id and a.district_id = d.id and a.commune_ward_town_id = cwt.id");
		$row = mysqli_fetch_row($fetch_address);

		if (!empty($row)) {
			$dcnh['id'] = $row[0];
			$dcnh['name'] = $row[1];
			$dcnh['phone'] = $row[2];
			$dcnh['street'] = $row[3];
			$dcnh['communeWardTown'] = $row[6];
			$dcnh['district'] = $row[5];
			$dcnh['provinceCity'] = $row[4];
			array_push($response, $dcnh);
		} else {
			$dcnh['id'] = null;
			$dcnh['name'] = null;
			$dcnh['phone'] = null;
			$dcnh['street'] = null;
			$dcnh['communeWardTown'] = null;
			$dcnh['district'] = null;
			$dcnh['provinceCity'] = null;
			array_push($response, $dcnh);
		}

		$htgh['title'] = "Hình thức giao hàng";
		$htgh['formOfDelivery'] = 0;
		array_push($response, $htgh);

		$httt['title'] = "Hình thức thanh toán";
		$httt['paymentMethod'] = 0;
		array_push($response, $httt);

		$n['provisionalPrice'] = $provisionalPrice;
		if ($provisionalPrice >= 200000) {
			$n['transportFee'] = 0;
		}
		else {
			$n['transportFee'] = 20000;
		}
		
		array_push($response, $n);		

	}
	else {
		$response['error'] = true;
        $response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);


?>