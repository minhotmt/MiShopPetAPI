<?php
	
	function getcode($phone) {
		require '../includes/DBConnection.php';
		$get_code = mysqli_query($conn, "select * from tb_verify where phone = ". $phone ." and time(created_at) >= time(now()) - interval 5 minute order by id desc");
		$row = mysqli_fetch_row($get_code);
		return $row[2];
	}

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['phone']) && isset($_POST['userId']) && isset($_POST['code'])) {

		$phone = $_POST['phone'];
		$userId = $_POST['userId'];
		$code = $_POST['code'];
		$get_code = getcode($phone);

		if ($code == $get_code) {
			$u = mysqli_query($conn, "update tb_user set phone = '".$phone."' where id = '".$userId."'");
			if ($u) {
				$response['error'] = false;
			}
			else {
				$response['error'] = true;
			}
		}
		else {
			$response['error'] = true;
			$response['message'] = "Mã xác thực không đúng hoặc đã hết hạn.";
		}

	}
	else {
		$response['error'] = true;
		$response['message'] = "Request is not allowed.";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>