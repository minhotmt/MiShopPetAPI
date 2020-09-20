<?php

	require "../../includes/DBConnection.php";

	$baseUrl = $dir . "mishop/uploads/banners/homes/";
	$upload_path = "../../uploads/banners/homes/";

	if (isset($_POST['submit'])) {
		
		if (isset($_FILES["banner"])) {
			
			if ($_FILES["banner"]["error"] > 0) {
				echo "KHÔNG THÀNH CÔNG!";
			}
			else {
				$newname = date('YmdHis',time()).mt_rand().'.jpg';
				$uploaded_file = move_uploaded_file($_FILES["banner"]["tmp_name"], $upload_path . $newname);
				if ($uploaded_file) {

					$path = $baseUrl . $newname;

					$sql = "insert into tb_banner (name, banner_url) values ('".$newname."', '".$path."')";
					$query = mysqli_query($conn, $sql);

					if ($query) {
						header("location: ../banners.php?flag=3");
					}
					else {
						echo "CÓ LỖI XẢY RA";
					}
				}
			}
		}
	}

?>