<?php

	require "../../includes/DBConnection.php";

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		
		$sql = "select banner_name from tb_category where id = ".$id."";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			$row = mysqli_fetch_row($query);
			$path = "../../uploads/banners/categories/" . $row[0];
			$unlink = unlink($path);
			if ($unlink) {
				$sql2 = "delete from tb_category where id = ".$id."";
				$query2 = mysqli_query($conn, $sql2);
				if ($query2) {
					header("location: ../categories.php?flag=5");
				}
			}
		}
	}

?>