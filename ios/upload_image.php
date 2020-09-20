<?php

	require '../includes/DBConnection.php';

	$response = array();
	$basePath = '../uploads/avatars/';
	$baseUrl = $dir . 'mishop/uploads/avatars/';

	if (isset($_POST['userId'])) {

		$userId = $_POST['userId'];

		if (isset($_FILES['file'])) {

			$file = $_FILES['file'];

			if (is_uploaded_file($file['tmp_name'])) {
				
				$photoPath = $basePath . 'avatar_'. $userId . '.jpg';
				$avatarUrl = $baseUrl . 'avatar_'. $userId . '.jpg';

				if (move_uploaded_file($file['tmp_name'], $photoPath)) {
					mysqli_query($conn, "update tb_user set avatar_url = '".$avatarUrl."' where id = ".$userId."");
				}

			}

		}

	}

	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed";
	}	

	echo json_encode($response, JSON_NUMERIC_CHECK);

	
?>