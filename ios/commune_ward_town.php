<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	$q = mysqli_query($conn, "select * from tb_commune_ward_town order by id asc");
	while ($rows = mysqli_fetch_array($q)) {
		$cwt['id'] = $rows['id'];
		$cwt['name'] = $rows['name'];
		$cwt['district_id'] = $rows['district_id'];

		array_push($response, $cwt);
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);


?>