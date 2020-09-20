<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['userId'])) {

		$userId = $_POST['userId'];

		// fetch address for user
		$fetch_address = mysqli_query($conn, "select a.id, a.recipient_name, a.phone_number, a.street, pc.name as pc_name, d.name as d_name, cwt.name as cwt_name, a.is_default from tb_user_address a, tb_user u, tb_province_city pc, tb_district d, tb_commune_ward_town cwt where u.id = a.user_id and a.user_id = ".$userId." and a.province_city_id = pc.id and a.district_id = d.id and a.commune_ward_town_id = cwt.id");
		while ($rows = mysqli_fetch_array($fetch_address)) {
			
			$a['id'] = $rows['id'];
			$a['name'] = $rows['recipient_name'];
			$a['phone'] = $rows['phone_number'];
			$a['street'] = $rows['street'];
			$a['communeWardTown'] = $rows['cwt_name'];
			$a['district'] = $rows['d_name'];
			$a['provinceCity'] = $rows['pc_name'];
			$a['isDefault'] = $rows['is_default'];

			array_push($response, $a);
		}

	}
	else {
		$response['error'] = true;
        $response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>