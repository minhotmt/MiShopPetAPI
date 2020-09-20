<?php

	require "../../includes/DBConnection.php";

	$baseUrl = $dir . "/fstore/uploads/child_categories/";
	$upload_path = "../../uploads/child_categories/";

	if (isset($_POST['submit'])) {
		
		if (isset($_POST['category_name']) && isset($_POST['id'])) {
			
			$category_name = $_POST['category_name'];
			$id = $_POST['id'];

			$sql = "update tb_child_category set name = '".$category_name."' where id = '".$id."'";
			$result = mysqli_query($conn, $sql);

			if ($result) {

				if (isset($_FILES['thumbnail'])) {
					if ($_FILES['thumbnail']['error'] > 0) {
						// no thumbnail
					} else {

						$newname = date('YmdHis',time()).mt_rand().'.jpg';
						$uploaded_file = move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $upload_path . $newname);

						if ($uploaded_file) {

							$sql2 = "select * from tb_child_category where id = ".$id."";
							$query2 = mysqli_query($conn, $sql2);

							$row = mysqli_fetch_row($query2);
							$path = "../../uploads/child_categories/" . $row[2];
							$unlink = unlink($path);

							if ($unlink) {

								$path2 = $baseUrl . $newname;

								$sql = "update tb_child_category set thumbnail_name = '".$newname."', thumbnail_url = '".$path2."' where id = '".$id."'";
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

				if (isset($_POST['select'])) {

					$categoryId = $_POST['select'];

					$sql3 = "update tb_child_category set category_id = '".$categoryId."' where id = '".$id."'";
					$result = mysqli_query($conn, $sql3);
					
				} else {
					echo "failed";
				}

				header("location: ../child-categories.php?flag=7");

			} else {
				echo "failed";
			}
			
		}

	}

?>