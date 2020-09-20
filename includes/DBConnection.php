<?php

	date_default_timezone_set('Asia/Ho_Chi_Minh');

	$conn = mysqli_connect("localhost", "root", "root", "mishop");

	mysqli_set_charset($conn, "UTF8");

	$dir = "http://localhost:8888/";

	if(!$conn) {
		echo "Error connect to database";
	}

	

?>
