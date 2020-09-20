<?php

	require "../../includes/DBConnection.php";

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "delete from tb_product where id = ".$id."";
		$query = mysqli_query($conn, $sql);
		if ($query) {
			$sql2 = "delete from tb_product_attribute where product_id = ".$id."";
			$query2 = mysqli_query($conn, $sql2);
			if ($query2) {
				$sql3 = "select image_name from tb_product_image where product_id = ".$id."";
				$query3 = mysqli_query($conn, $sql3);
				while ($rows = mysqli_fetch_array($query3)) {
					$path = "../../uploads/products/" . $rows['image_name'];
					$unlink = unlink($path);

					if ($unlink) {
						$sql4 = "delete from tb_product_image where image_name = '".$rows['image_name']."'";
						$query4 = mysqli_query($conn, $sql4);
						if ($query4) {
							header("location: ../products.php?flag=9");
						}
					}
				}
			}
		}
	}

?>