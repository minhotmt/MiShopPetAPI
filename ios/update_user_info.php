<?php

	function getCurrentPhoneNumber($id) {
		require '../includes/DBConnection.php';
		$q = mysqli_query($conn, "select * from tb_user where id = '".$id."'");
		$r = mysqli_fetch_row($q);
		return $r[3];
	}

	function isPhoneExists($phone) {
		require '../includes/DBConnection.php';
		$check = mysqli_query($conn, "select * from tb_user where phone = '". $phone ."'");
		$rowcount = mysqli_num_rows($check);
		return $rowcount > 0;
	}

	require '../includes/DBConnection.php';

	$response = array();

	if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['gender']) && isset($_POST['birthday']) && isset($_POST['accountType'])) {

		$id = $_POST['id'];
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$gender = $_POST['gender'];
		$birthday = $_POST['birthday'];
		$accountType = $_POST['accountType'];

		if ($accountType == 0) {

			if ($phone == getCurrentPhoneNumber($id)) {
				if ($birthday == "") {
					$update = mysqli_query($conn, "update tb_user set name = '".$name."', phone = '".$phone."', gender = ".$gender.", birthday = null where id = ".$id."");

					if ($update) {
						$response['error'] = false;
					}
					else {
						$response['error'] = true;
					}
				}
				else {
					$update = mysqli_query($conn, "update tb_user set name = '".$name."', phone = '".$phone."', gender = ".$gender.", birthday = '".$birthday."' where id = ".$id."");

					if ($update) {
						$response['error'] = false;
					}
					else {
						$response['error'] = true;
					}
				}
			}

			else {
				if (isPhoneExists($phone)) {
					$response['error'] = true;
					$response['message'] = "Số điện này đã được sử dụng";
				}
				else {
					$response['error'] = false;

					if ($birthday == "") {
						$update = mysqli_query($conn, "update tb_user set name = '".$name."', gender = ".$gender.", birthday = null where id = ".$id."");

						if ($update) {
							$response['error'] = false;
						}
						else {
							$response['error'] = true;
						}
					}
					else {
						$update = mysqli_query($conn, "update tb_user set name = '".$name."', gender = ".$gender.", birthday = '".$birthday."' where id = ".$id."");

						if ($update) {
							$response['error'] = false;
						}
						else {
							$response['error'] = true;
						}
					}

					$response['activePhoneNumber'] = true;
				}
			}

			
		}

		else {
			if ($birthday == "") {
				$update = mysqli_query($conn, "update tb_user set name = '".$name."', gender = ".$gender.", birthday = null where id = ".$id."");

				if ($update) {
					$response['error'] = false;
				}
				else {
					$response['error'] = true;
				}
			}
			else {
				$update = mysqli_query($conn, "update tb_user set name = '".$name."', gender = ".$gender.", birthday = '".$birthday."' where id = ".$id."");

				if ($update) {
					$response['error'] = false;
				}
				else {
					$response['error'] = true;
				}
			}

		}

	}


	echo json_encode($response, JSON_NUMERIC_CHECK);

?>