<?php

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['recipient_name']) && isset($_POST['phone_number']) && isset($_POST['street']) && isset($_POST['province_city_id']) && isset($_POST['district_id']) && isset($_POST['commune_ward_town_id']) && isset($_POST['user_id']) && isset($_POST['address_id'])) {

		$recipient_name = $_POST['recipient_name'];
		$phone_number = $_POST['phone_number'];
		$street = $_POST['street'];
		$province_city_id = $_POST['province_city_id'];
		$district_id = $_POST['district_id'];
		$commune_ward_town_id = $_POST['commune_ward_town_id'];
		$user_id = $_POST['user_id'];
		$address_id = $_POST['address_id'];

		$u = mysqli_query($conn, "update tb_user_address set recipient_name = '".$recipient_name."', phone_number = '".$phone_number."', street = '".$street."', province_city_id = ".$province_city_id.", district_id = ".$district_id.", commune_ward_town_id = ".$commune_ward_town_id." where user_id = ".$user_id." and id = ".$address_id."");

		if ($u) {
			$response['error'] = false;
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