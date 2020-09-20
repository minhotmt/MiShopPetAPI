<?php

	require '../includes/DBConnection.php';

	if (isset($_POST['userId']) && isset($_POST['addressId'])) {

		$userId = $_POST['userId'];
		$addressId = $_POST['addressId'];

		$q = mysqli_query($conn, "select a.id, a.recipient_name, a.phone_number, a.street, a.province_city_id as pc_id, pc.name as pc_name, a.district_id as d_id, d.name as d_name, a.commune_ward_town_id as cwt_id, cwt.name as cwt_name from tb_user_address a, tb_commune_ward_town cwt, tb_district d, tb_province_city pc where a.user_id = ".$userId." and a.id = ".$addressId." and a.province_city_id = pc.id and a.district_id = d.id and a.commune_ward_town_id = cwt.id");

		$row = mysqli_fetch_row($q);

		$response['id'] = $row[0];
		$response['recipient_name'] = $row[1];
		$response['phone_number'] = $row[2];
		$response['street'] = $row[3];
		$response['pc_id'] = $row[4];
		$response['pc_name'] = $row[5];
		$response['d_id'] = $row[6];
		$response['d_name'] = $row[7];
		$response['cwt_id'] = $row[8];
		$response['cwt_name'] = $row[9];

		echo json_encode($response, JSON_NUMERIC_CHECK);
	}

	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed";

		echo json_encode($response, JSON_NUMERIC_CHECK);
	}

?>