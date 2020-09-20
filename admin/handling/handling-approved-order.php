<?php

	require "../../includes/DBConnection.php";

	if (isset($_GET['id'])) {

		$id = $_GET['id'];

		$sql = "update tb_order set status = '2' where order_id = ".$id."";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			header("location: ../orders.php?flag=10");
		}

	}


?>