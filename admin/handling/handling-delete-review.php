<?php

	require "../../includes/DBConnection.php";

	if (isset($_GET['id']) && isset($_GET['flag'])) {

		$id = $_GET['id'];
		$flag = $_GET['flag'];

		$sql = "delete from tb_review where id = ".$id."";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			header("location: ../reviews.php?flag=$flag");
		}

	}

?>