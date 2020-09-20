<?php
	
	require '../includes/DBConnection.php';

	$response = array();

	$q = mysqli_query($conn, "select * from tb_province_city order by id asc");
	while ($rows = mysqli_fetch_array($q)) {
		$pc['id'] = $rows['id'];
		$pc['name'] = $rows['name'];

		array_push($response, $pc);
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);


?>