<?php

	require '../includes/DBConnection.php';

	$response = array();

	$q = mysqli_query($conn, "select * from tb_brand order by name asc");
	while ($rows = mysqli_fetch_array($q)) {
		$tm['id'] = $rows['id'];
		$tm['name'] = $rows['name'];
		$tm['imageUrl'] = $rows['thumbnail_url'];

		array_push($response, $tm);
	}


	echo json_encode($response, JSON_NUMERIC_CHECK);


?>