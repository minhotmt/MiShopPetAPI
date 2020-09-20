<?php

	function isPhoneExists($phone) {
		require '../includes/DBConnection.php';
		$check = mysqli_query($conn, "select * from tb_user where phone = '". $phone ."'");
		$rowcount = mysqli_num_rows($check);
		return $rowcount > 0;
	}

	if (isset($_POST['phone'])) {

		$response = array();
		$phone = $_POST['phone'];

		if (isPhoneExists($phone)) {
			$response['isExists'] = true;
			
		}
		else {
			$response['isExists'] = false;
		}

		echo json_encode($response);
	}

?>