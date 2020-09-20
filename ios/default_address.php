<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	if ($_POST['userId'] && isset($_POST['addressId'])) {

		$userId = $_POST['userId'];
		$addressId = $_POST['addressId'];

		$default_address = mysqli_query($conn, "update tb_user_address set is_default = '1' where id = ".$addressId." and user_id = ".$userId."");
		if ($default_address) {
			$delete_old_default_address = mysqli_query($conn, "update tb_user_address set is_default = '0' where id not in (".$addressId.") and user_id = ".$userId."");

			if ($delete_old_default_address) {
				$response['error'] = false;
			}
			else {
				$response['error'] = true;	
			}
		}
		else {
			$response['error'] = true;	
		}

	}

	else {
		$response['error'] = true;	
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>