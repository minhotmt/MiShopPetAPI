<?php

	require "../../includes/DBConnection.php";

	$baseUrl = $dir . "mishop/uploads/child_categories/";
	$upload_path = "../../uploads/child_categories/";

	if (isset($_POST['submit'])) {
		
		if (isset($_FILES["thumbnail"]) && isset($_POST['category_name']) && isset($_POST['select'])) {
			
			if ($_FILES["thumbnail"]["error"] > 0) {
				echo "error";
			}
			else {
				$newname = date('YmdHis',time()).mt_rand().'.jpg';
				$uploaded_file = move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $upload_path . $newname);
				if ($uploaded_file) {

					$path = $baseUrl . $newname;
					$name = $_POST['category_name'];
					$category_id = $_POST['select'];

					$sql = "insert into tb_child_category (name, thumbnail_name, thumbnail_url, category_id) values ('".$name."', '".$newname."', '".$path."', ".$category_id.")";
					$query = mysqli_query($conn, $sql);

					if ($query) {
						header("location: ../child-categories.php?flag=7");
					}
					else {
						echo "CÓ LỖI XẢY RA";
					}
				}
			}
		}
	}

?>