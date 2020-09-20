<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId']) && isset($_POST['rating']) && isset($_POST['comment']) && isset($_POST['productId']) && isset($_POST['orderId'])) {

		$userId = $_POST['userId'];
		$rating = $_POST['rating'];
		$comment = $_POST['comment'];
		$productId = $_POST['productId'];
		$orderId = $_POST['orderId'];

		$q = mysqli_query($conn, "insert into tb_review (rating, comment, user_id, product_id, status, order_id) values (".$rating.", '".$comment."', ".$userId.", ".$productId.", '0', ".$orderId.")");

		if ($q) {
			$response['error'] = false;
        	$response['message'] = "Chúng tôi đã ghi nhận đánh giá của bạn về sản phẩm này. Xin cảm ơn!";	
		}
		else {
			$response['error'] = true;
		}

	}
	else {
		$response['error'] = true;
        $response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>