<?php

	require '../includes/DBConnection.php';

	function getcode($phone) {
		require '../includes/DBConnection.php';
		$get_code = mysqli_query($conn, "select * from tb_verify where phone = ". $phone ." and time(created_at) >= time(now()) - interval 5 minute order by id desc");
		$row = mysqli_fetch_row($get_code);
		return $row[2];
	}

	function delete_verification($phone) {
		require '../includes/DBConnection.php';
		$delete = mysqli_query($conn, "delete from tb_verify where phone = ". $phone ."");
		return true;
	}


	if (isset($_POST['phone']) && isset($_POST['code'])) {

		$phone = $_POST['phone'];
		$send_code = $_POST['code'];
		$get_code = getcode($phone);

		if ($get_code == $send_code) {
			$response['error'] = false;
		}
		else {
			$response['error'] = true;
			$response['message'] = "Mã xác thực không đúng hoặc đã hết hạn.";
		}

		echo json_encode($response, JSON_NUMERIC_CHECK);

	}




?>