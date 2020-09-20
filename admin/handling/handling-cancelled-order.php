<?php

	require "../../includes/DBConnection.php";

	if (isset($_GET['id']) && isset($_GET['flag'])) {

		$id = $_GET['id'];
		$flag = $_GET['flag'];

		$sql = "update tb_order set status = '4' where order_id = ".$id."";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			header("location: ../orders.php?flag=$flag");
		}

	}


?>