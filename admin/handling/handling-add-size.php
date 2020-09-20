<?php

	require "../../includes/DBConnection.php";

	if (isset($_POST['size_name'])) {

		$size_name = $_POST['size_name'];

		$sql = "insert into tb_size (name) values ('".$size_name."')";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			header("location: ../attributes.php?flag=14");
		}

	}

?>