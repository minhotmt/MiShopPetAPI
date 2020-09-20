<?php

	require "../../includes/DBConnection.php";

	if (isset($_POST['color_name'])) {

		$color_name = $_POST['color_name'];

		$sql = "insert into tb_color (name) values ('".$color_name."')";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			header("location: ../attributes.php?flag=14");
		}

	}

?>