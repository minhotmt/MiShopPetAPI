<?php

	require "../../includes/DBConnection.php";

	if (isset($_GET['id']) && isset($_GET['flag'])) {

		$id = $_GET['id'];
		$flag = $_GET['flag'];

		$sql = "delete from tb_order_detail where order_id = ".$id."";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			$sql2 = "delete from tb_order where order_id = ".$id."";
			$query2 = mysqli_query($conn, $sql2);

			if ($query2) {
				header("location: ../orders.php?flag=$flag");
			}
		}

	}

?>