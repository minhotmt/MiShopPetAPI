<?php

	require "../../includes/DBConnection.php";

	$baseUrl = $dir . "mishop/uploads/brands/";
	$upload_path = "../../uploads/brands/";

	if (isset($_POST['submit'])) {
		
		if (isset($_FILES["thumbnail"]) && isset($_POST['brand_name'])) {
			
			if ($_FILES["thumbnail"]["error"] > 0) {
				echo "KHÔNG THÀNH CÔNG!";
			}
			else {
				$newname = date('YmdHis',time()).mt_rand().'.jpg';
				$uploaded_file = move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $upload_path . $newname);
				if ($uploaded_file) {

					$path = $baseUrl . $newname;
					$name = $_POST['brand_name'];

					$sql = "insert into tb_brand (name, thumbnail_name, thumbnail_url) values ('".$name."','".$newname."', '".$path."')";
					$query = mysqli_query($conn, $sql);

					if ($query) {
						header("location: ../brands.php?flag=18");
					}
					else {
						echo "CÓ LỖI XẢY RA";
					}
				}
			}
		}
	}

?>