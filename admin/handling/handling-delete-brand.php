<?php

	require "../../includes/DBConnection.php";

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		
		$sql = "select thumbnail_name from tb_brand where id = ".$id."";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			$row = mysqli_fetch_row($query);
			$path = "../../uploads/brands/" . $row[0];
			$unlink = unlink($path);
			if ($unlink) {
				$sql2 = "delete from tb_brand where id = ".$id."";
				$query2 = mysqli_query($conn, $sql2);
				if ($query2) {
					header("location: ../brands.php?flag=18");
				}
			}
		}
	}

?>