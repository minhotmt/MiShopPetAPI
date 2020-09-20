<?php

	function isEmailExistAndAccountTypeExist($email, $accountType) {
		require '../includes/DBConnection.php';
		$check = mysqli_query($conn, "select * from tb_user where email = '". $email ."' and account_type = '".$accountType."'");
		$rowcount = mysqli_num_rows($check);
		return $rowcount > 0;
	}


	require '../includes/DBConnection.php';

	$response = array();

	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['accountType']) && isset($_POST['avatarUrl'])) {

		$name = $_POST['name'];
		$email = $_POST['email'];
		$accountType = $_POST['accountType'];
		$avatarUrl = $_POST['avatarUrl'];

		// $email = "nguyenhaiau442@gmail.com";
		// $accountType = '1';

		if (isEmailExistAndAccountTypeExist($email, $accountType)) {
			$response['error'] = false;

			$get_user = mysqli_query($conn, "select * from tb_user where email = '".$email."' and account_type = '".$accountType."'");

			$row = mysqli_fetch_row($get_user);
			$response['id'] = $row[0];
			$response['name'] = $row[1];
			$response['email'] = $row[4];
			$response['gender'] = $row[5];
			$response['accountType'] = $row[6];
			$response['avatarUrl'] = $row[7];
			$response['createAt'] = $row[8];
			$response['birthday'] = $row[9];

			// default address id
			$q_addr = mysqli_query($conn, "select * from tb_user_address where user_id = '".$response['id']."' and is_default = '1'");
			$row_address = mysqli_fetch_row($q_addr);
			if (empty($row_address[0])) {
				$response['addressId'] = 0;
			}
			else {
				$response['addressId'] = $row_address[0];
			}


			// cart count
			$q2 = mysqli_query($conn, "select sum(quantity) as cart_count from tb_cart where user_id = '".$response['id']."'");
			$r = mysqli_fetch_row($q2);
			if (empty($r[0])) {
				$response['cartCount'] = 0;
			}
			else {
				$response['cartCount'] = $r[0];
			}
			
		}
		else {
			$q = mysqli_query($conn, "insert into tb_user (name, email, account_type, avatar_url) values ('".$name."', '".$email."', '".$accountType."', '".$avatarUrl."')");

			if(!$q) {
				$response['error'] = true;
			}
			else {
				$response['error'] = false;
				$get_user = mysqli_query($conn, "select * from tb_user where email = '".$email."' and account_type = '".$accountType."'");
				$row = mysqli_fetch_row($get_user);
				$response['id'] = $row[0];
				$response['name'] = $row[1];
				$response['email'] = $row[4];
				$response['accountType'] = $row[6];
				$response['avatarUrl'] = $row[7];
				$response['createAt'] = $row[8];
			}
		}

	}
	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>