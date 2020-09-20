<?php

	require "../../includes/DBConnection.php";

	if (isset($_GET['id'])) {

		$id = $_GET['id'];

		$sql = "delete from tb_user where id = ".$id."";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			header("location: ../users.php?flag=15");
		}

	}

?>