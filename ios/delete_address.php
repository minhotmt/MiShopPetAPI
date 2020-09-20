<?php

	require '../includes/DBConnection.php';

	if (isset($_POST['addressId']) && isset($_POST['userId'])) {

		$addressId = $_POST['addressId'];
		$userId = $_POST['userId'];


		$delete_address = mysqli_query($conn, "delete from tb_user_address where id = ".$addressId." and user_id = ".$userId."");

	}

?>