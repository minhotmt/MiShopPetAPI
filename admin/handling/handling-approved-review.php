<?php

	require "../../includes/DBConnection.php";

	if (isset($_GET['id'])) {

		$id = $_GET['id'];

		$sql = "update tb_review set status = '1' where id = ".$id."";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			header("location: ../reviews.php?flag=16");
		}

	}


?>