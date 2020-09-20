<?php
	
	require '../includes/DBConnection.php';

	if(isset($_POST['phone']) && isset($_POST['password'])) {

		$phone = $_POST['phone'];
		$password = $_POST['password'];

		$get_user = mysqli_query($conn, "select * from tb_user where phone = '". $phone ."' and password = '". $password ."'");
		if ($rowcount = mysqli_num_rows($get_user) > 0) {

			$user['error'] = false;
			$row = mysqli_fetch_row($get_user);
			$user['id'] = $row[0];
			$user['name'] = $row[1];
			$user['password'] = $row[2];
			$user['phone'] = $row[3];
			
			if ($row[4] == null) {
				$user['email'] = "";
			}
			else {
				$user['email'] = $row[4];
			}

			
			if ($row[5] == null) {
				$user['gender'] = "";
			}
			else {
				$user['gender'] = $row[5];
			}

			if ($row[5] == null) {
				$user['accountType'] = "";
			}
			else {
				$user['accountType'] = $row[6];
			}

			$user['avatarUrl'] = $row[7];
			$user['createAt'] = $row[8];

			if ($row[9] == null) {
				$user['birthday'] = "";
			}
			else {
				$user['birthday'] = $row[9];
			}

			// default address id
			$q_addr = mysqli_query($conn, "select * from tb_user_address where user_id = ".$user['id']." and is_default = '1'");
			$row_address = mysqli_fetch_row($q_addr);
			if (empty($row_address[0])) {
				$user['addressId'] = 0;
			}
			else {
				$user['addressId'] = $row_address[0];
			}

			// cart count
			$q2 = mysqli_query($conn, "select sum(quantity) as cart_count from tb_cart where user_id = '".$user['id']."'");
			$r = mysqli_fetch_row($q2);
			if ($r[0] == null) {
				$user['cartCount'] = 0;
			}
			else {
				$user['cartCount'] = $r[0];
			}
			

		}
		else {
			$user['error'] = true;
			$user['message'] = "Thông tin đăng nhập không đúng.";
		}
		
	}
	else {
		$user['error'] = true;
		$user['message'] = "Request not allowed";
	}

	echo json_encode($user, JSON_NUMERIC_CHECK);

?>