<?php

	require '../includes/DBConnection.php';

	$response = array();

	// function isUserExist($productId, $userId) {
	// 	require '../includes/DBConnection.php';
	// 	$q = mysqli_query($conn, "select * from tb_cart where product_id = ".$productId." and user_id = ".$userId."");
	// 	$row = mysqli_num_rows($q);
	// 	return $row;
	// }

	// function isProductExistWithAttributeId($productId, $userId, $attributeId) {
	// 	require '../includes/DBConnection.php';
	// 	$q = mysqli_query($conn, "select * from tb_cart where product_id = ".$productId." and user_id = ".$userId." and attribute_id = ".$attributeId."");
	// 	$row = mysqli_num_rows($q);
	// 	return $row;
	// }

    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['account_type'])) {

        $id = $_POST['id'];
		$name = $_POST['name'];
        $pass = $_POST['pass'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $accountType = $_POST['account_type'];

        $add_user = mysqli_query($conn, "insert into tb_user (id, name, password, phone, email, gender, account_type) values ('2',".$name.", ".$pass.", ".$phone.", ".$email.", ".$gender.", ".$accountType.")");
		$response['error'] = false;
	}
	else {
		$response['error'] = true;
		$response['message'] = "Request not allowed";
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);

?>