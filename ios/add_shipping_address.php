<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['recipient_name']) && isset($_POST['phone_number']) && isset($_POST['street']) && isset($_POST['province_city_id']) && isset($_POST['district_id']) && isset($_POST['commune_ward_town_id']) && isset($_POST['user_id'])) {

		$recipient_name = $_POST['recipient_name'];
		$phone_number = $_POST['phone_number'];
		$street = $_POST['street'];
		$province_city_id = $_POST['province_city_id'];
		$district_id = $_POST['district_id'];
		$commune_ward_town_id = $_POST['commune_ward_town_id'];
		$user_id = $_POST['user_id'];

		$add_shipping_address = mysqli_query($conn, "insert into tb_user_address (recipient_name, phone_number, street, user_id, province_city_id, district_id, commune_ward_town_id, is_default) values ('".$recipient_name."', '".$phone_number."', '".$street."', '".$user_id."', ".$province_city_id.", ".$district_id.", ".$commune_ward_town_id.", 0)");

		if ($add_shipping_address) {
			$response['error'] = false;
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