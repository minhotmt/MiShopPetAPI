<?php

	require "../../includes/DBConnection.php";

	$baseUrl = $dir . "/mishop/uploads/banners/categories/";
	$upload_path = "../../uploads/banners/categories/";

	if (isset($_POST['submit'])) {
		
		if (isset($_POST['category_name']) && isset($_POST['id'])) {
			
			$category_name = $_POST['category_name'];
			$id = $_POST['id'];

			$sql = "update tb_category set name = '".$category_name."' where id = '".$id."'";
			$result = mysqli_query($conn, $sql);

			if ($result) {

				if (isset($_FILES['banner'])) {
					if ($_FILES['banner']['error'] > 0) {
						// no banner
					} else {

						$newname = date('YmdHis',time()).mt_rand().'.jpg';
						$uploaded_file = move_uploaded_file($_FILES["banner"]["tmp_name"], $upload_path . $newname);

						if ($uploaded_file) {

							$sql2 = "select * from tb_category where id = ".$id."";
							$query2 = mysqli_query($conn, $sql2);

							$row = mysqli_fetch_row($query2);
							$path = "../../uploads/banners/categories/" . $row[2];
							$unlink = unlink($path);

							if ($unlink) {

								$path2 = $baseUrl . $newname;

								$sql = "update tb_category set banner_name = '".$newname."', banner_url = '".$path2."' where id = '".$id."'";
								$query = mysqli_query($conn, $sql);

								if ($query) {
									echo "ok";
								}
								else {
									echo "CÓ LỖI XẢY RA";
								}
							}
						}
					}
				}
				header("location: ../categories.php?flag=5");
			} else {
				echo "failed";
			}
			
		}

	}

?>