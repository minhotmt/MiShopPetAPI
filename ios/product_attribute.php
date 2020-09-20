<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['productId'])) {

		$productId = $_POST['productId'];

		$sql = "select * from tb_product_attribute where product_id = ".$productId."";
		$query = mysqli_query($conn, $sql);
		while ($rows = mysqli_fetch_array($query)) {

			$attribute['attributeId'] = (int)$rows['id'];
			$attribute['productId'] = (int)$productId;

			if (empty($rows['color_id'])) {
				$sql2 = "select * from tb_size where id = ".$rows['size_id']."";
				$query2 = mysqli_query($conn,$sql2);
				$row = mysqli_fetch_row($query2);

				$attribute['attributeName'] = $row[1];

			} else if (empty($rows['size_id'])) {
				$sql2 = "select * from tb_color where id = ".$rows['color_id']."";
				$query2 = mysqli_query($conn,$sql2);
				$row = mysqli_fetch_row($query2);

				$attribute['attributeName'] = $row[1];

			} else {
				$sql2 = "select c.name as color_name, s.name as size_name from tb_color c, tb_size s where c.id = ".$rows['color_id']." and s.id = ".$rows['size_id']."";
				$query2 = mysqli_query($conn, $sql2);
				$row = mysqli_fetch_row($query2);

				$attribute['attributeName'] = $row[0] . " - " . $row[1];
			}

			array_push($response, $attribute);
		}

	}
	else {
		$response['error'] = true;
        $response['message'] = "Request not allowed";
	}

	echo json_encode($response);

?>