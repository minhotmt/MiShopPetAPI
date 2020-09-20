
<?php
	
	require '../includes/DBConnection.php';

	function sendVerificationCode3TimesToPhone($phone) {
		require '../includes/DBConnection.php';
		$check = mysqli_query($conn, "select * from tb_verify where phone = '". $phone ."' and date(created_at) = date(now())");
		$rowcount = mysqli_num_rows($check);
		return $rowcount;
	}

	function sendVerificationCodeToPhone($phone, $code) {
		$APIKey= "APIKey";
		$SecretKey= "SecretKey";
		$YourPhone= $phone;
		$Content= $code;
		
		$SendContent= urlencode($Content);
		$data= "http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&SmsType=8";
		
		$curl = curl_init($data); 
		curl_setopt($curl, CURLOPT_FAILONERROR, true); 
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($curl); 
			
		$obj = json_decode($result,true);
	}

	if (isset($_POST['phone'])) {

		$response = array();

		$phone = $_POST['phone'];
		$verify_code = random_int(100000, 999999);

		if (sendVerificationCode3TimesToPhone($phone) < 3) {
			$response['error'] = false;
			$create_verify_code = mysqli_query($conn, "insert into tb_verify (phone, verify_code) values ('". $phone ."', '". $verify_code ."')");
			if ($create_verify_code) {
				$get_verify_code = mysqli_query($conn, "select * from tb_verify where phone = ". $phone ." order by id desc");
				$row = mysqli_fetch_row($get_verify_code);
				$code = $row[2];
				
				//sendVerificationCodeToPhone($phone, $code);
			}

		}

		else {
			$response['error'] = true;
			$response['message'] = "Mã xác thực chỉ được gửi tối đa 3 lần trong một ngày.";
		}

		echo json_encode($response);

	}


?>
