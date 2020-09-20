<?php

	function getcode($phone) {
		require '../includes/DBConnection.php';
		$get_code = mysqli_query($conn, "select * from tb_verify where phone = ". $phone ." and time(created_at) >= time(now()) - interval 5 minute order by id desc");
		$row = mysqli_fetch_row($get_code);
		return $row[2];
	}

	function user_register($name, $password, $phone, $account_type, $avatar_url) {
		require '../includes/DBConnection.php';
		$create_user = mysqli_query($conn, "insert into tb_user (name, password, phone, account_type, avatar_url) values ('". $name ."','". $password ."', '". $phone ."', '". $account_type ."', '". $avatar_url ."')");
		if (!($create_user)) {
			$response['error'] = true;
			$response['message'] = "Đăng ký tài khoản thất bại!";
			echo json_encode($response);
		}
	}

	function delete_verification($phone) {
		require '../includes/DBConnection.php';
		$delete = mysqli_query($conn, "delete from tb_verify where phone = ". $phone ."");
		return true;
	}

	require '../includes/DBConnection.php';

	if (isset($_POST['phone']) && isset($_POST['code']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['accountType'])) {

		$phone = $_POST['phone'];
		$send_code = $_POST['code'];
		$get_code = getcode($phone);
		$name = $_POST['name'];
		$password = md5($_POST['password']);
		$account_type = $_POST['accountType'];
		$avatar_url = "https://www.elwa.com/wp-content/uploads/2013/04/default-avatar-300x300.jpg";

		if ($get_code == $send_code) {
			$response['error'] = false;
			user_register($name, $password, $phone, $account_type, $avatar_url);
			delete_verification($phone);

			$get_user = mysqli_query($conn, "select * from tb_user where phone = '". $phone ."' and password = '". $password ."'");
			$row = mysqli_fetch_row($get_user);
			$response['id'] = $row[0];
			$response['name'] = $row[1];
			$response['password'] = $row[2];
			$response['phone'] = $row[3];
			// $response['user_email'] = $row[4];
			$response['accountType'] = $row[6];
			$response['avatarUrl'] = $row[7];
			$response['createAt'] = $row[8];
			// $response['user_birthday'] = $row[9];
		}
		else {
			$response['error'] = true;
			$response['message'] = "Mã xác thực không đúng hoặc đã hết hạn.";
		}

		echo json_encode($response, JSON_NUMERIC_CHECK);

	}

?>