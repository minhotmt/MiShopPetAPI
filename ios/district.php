<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	$q = mysqli_query($conn, "select * from tb_district order by id asc");
	while ($rows = mysqli_fetch_array($q)) {
		$d['id'] = $rows['id'];
		$d['name'] = $rows['name'];
		$d['province_city_id'] = $rows['province_city_id'];

		array_push($response, $d);
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);


?>