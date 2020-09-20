<?php

	require "../../includes/DBConnection.php";

	$baseUrl = $dir . "fstore/uploads/banners/categories/";
	$upload_path = "../../uploads/banners/categories/";

	if (isset($_POST['submit'])) {
		
		if (isset($_FILES["banner"]) && isset($_POST['category_name'])) {
			
			if ($_FILES["banner"]["error"] > 0) {
				echo "KHÔNG THÀNH CÔNG!";
			}
			else {
				$newname = date('YmdHis',time()).mt_rand().'.jpg';
				$uploaded_file = move_uploaded_file($_FILES["banner"]["tmp_name"], $upload_path . $newname);
				if ($uploaded_file) {

					$path = $baseUrl . $newname;
					$name = $_POST['category_name'];

					$sql = "insert into tb_category (name, banner_name, banner_url) values ('".$name."','".$newname."', '".$path."')";
					$query = mysqli_query($conn, $sql);

					if ($query) {
						header("location: ../categories.php?flag=5");
					}
					else {
						echo "CÓ LỖI XẢY RA";
					}
				}
			}
		}
	}

?>