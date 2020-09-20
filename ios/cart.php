<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['user_id'])) {

		$user_id = $_POST['user_id'];

		$query = mysqli_query($conn, "select distinct(p.id) as product_id, p.name as product_name, p.price, p.is_sale, p.sale_price, c.attribute_id, c.quantity from tb_cart c, tb_product p, tb_user u where c.product_id = p.id and c.user_id = u.id and u.id = ".$user_id." order by c.id desc");

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
				$p['name'] = $rows['product_name'];
			}

			$p['price'] = $rows['price'];
			$p['isSale'] = $rows['is_sale'];
			$p['salePrice'] = $rows['sale_price'];
			$p['quantity'] = $rows['quantity'];

			// fetch thumbnail url
			$thumbnail = mysqli_query($conn, "select * from tb_product_image where product_id = ".$p['id']." order by id asc");
			$row = mysqli_fetch_row($thumbnail);
			$p['thumbnailUrl'] = $row[2];
			
			array_push($response, $p);

		}

	}

	else {
		$response['error'] = true;
		$response['message'] = "Request is not allowed.";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>