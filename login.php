<?php

	session_start();

	require "includes/DBConnection.php";

	if (isset($_POST['username']) && isset($_POST['pass'])) {

		$username = $_POST["username"];
		$pass = $_POST["pass"];

		$sql = "select * from tb_admin where username = '".$username."' and password = '".$pass."'";
		$result = mysqli_query($conn, $sql);
		$row_count = mysqli_num_rows($result);

		if ($row_count > 0) {
			$_SESSION['logged'] = true;
			header("location: admin/home.php?flag=1");
		}
		else {
			echo "Đăng nhập thất bại. Vui lòng kiểm tra và thử lại!";
		}

	}

?>