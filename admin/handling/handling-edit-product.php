<?php

	require "../../includes/DBConnection.php";

	$baseUrl = $dir . "/mishop/uploads/child_categories/";
	$upload_path = "../../uploads/child_categories/";

	function reArrayFiles($file)
	{
	    $file_ary = array();
	    $file_count = count($file['name']);
	    $file_key = array_keys($file);
	   
	    for($i=0;$i<$file_count;$i++)
	    {
	        foreach($file_key as $val)
	        {
	            $file_ary[$i][$val] = $file[$val][$i];
	        }
	    }
	    return $file_ary;
	}

	if (isset($_POST['submit'])) {
		
		$id = $_POST['id'];

		if (isset($_POST['name'])) {
			
			$name = $_POST['name'];

			$sql = "update tb_product set name = '".$name."' where id = '".$id."'";
			$result = mysqli_query($conn, $sql);
			
		}

		if (isset($_POST['price'])) {
			$price = $_POST['price'];
			$sql2 = "update tb_product set price = '".$price."' where id = '".$id."'";
			$result2 = mysqli_query($conn, $sql2);
		}

		if (isset($_POST['checkbox'])) {
			$sql3 = "update tb_product set is_sale = 1 where id = '".$id."'";
			$result3 = mysqli_query($conn, $sql3);
		} else {
			$sql3 = "update tb_product set is_sale = 0 where id = '".$id."'";
			$result3 = mysqli_query($conn, $sql3);
		}

		if (isset($_POST['sale_price'])) {
			$sale_price = $_POST['sale_price'];
			$sql4 = "update tb_product set sale_price = '".$sale_price."' where id = '".$id."'";
			$result4 = mysqli_query($conn, $sql4);
		}

		if (isset($_POST['category'])) {
			$category = $_POST['category'];
			$sql5 = "update tb_product set child_category_id = '".$category."' where id = '".$id."'";
			$result5 = mysqli_query($conn, $sql5);
		}

		if (isset($_POST['brand'])) {
			$brand = $_POST['brand'];
			$sql6 = "update tb_product set brand_id = '".$brand."' where id = '".$id."'";
			$result6 = mysqli_query($conn, $sql6);
		}

		header("location: ../products.php?flag=9");

	}

?>