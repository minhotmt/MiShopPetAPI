<?php

	require "../../includes/DBConnection.php";

	$baseUrl = $dir . "fstore/uploads/products/";
	$upload_path = "../../uploads/products/";

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

		$name = $_POST['name'];
		$price = $_POST['price'];

		if (empty($_POST['color'])) {
			$color = null;
		} else {
			$color = $_POST['color'];
		}

		if (empty($_POST['size'])) {
			$size = null;
		} else {
			$size = $_POST['size'];
		}
		
		if (isset($_POST['checkbox'])) {
			$is_sale = 1;
			$sale_price = $_POST['sale_price'];
		} else {
			$is_sale = 0;
			$sale_price = 0;
		}

		$category = $_POST['category'];
		if (empty($_POST['brand'])) {
			$brand = 0;
		} else {
			$brand = $_POST['brand'];
		}


		if (isset($_POST['description'])) {
			$description = $_POST['description'];
		} else {
			$description = null;
		}

		$sql = "insert into tb_product (name, price, is_sale, sale_price, child_category_id, description, brand_id) values ('".$name."', ".$price.", ".$is_sale.", ".$sale_price.", ".$category.", '".$description."', ".$brand.")";
		$query = mysqli_query($conn, $sql);

		if ($query) {

			$get_product_id = "select id from tb_product order by id desc";
			$query_get_product_id = mysqli_query($conn, $get_product_id);
			$row = mysqli_fetch_row($query_get_product_id);

			$img = $_FILES['img'];

			if(!empty($img)) {
			    $img_desc = reArrayFiles($img);
			   
			    foreach($img_desc as $val)
			    {
			        $newname = date('YmdHis',time()).mt_rand().'.jpg';
			        $uploaded_file = move_uploaded_file($val['tmp_name'],'../../uploads/products/'.$newname);
			        if ($uploaded_file) {

						$path = $baseUrl . $newname;

						$sql3 = "insert into tb_product_image (image_name, image_url, product_id) values ('".$newname."', '".$path."', ".$row[0].")";
						$query3 = mysqli_query($conn, $sql3);
					}
			    }
			}

			if (empty($color) || empty($size)) {
				if (empty($color)) {
					for ($i=0; $i < count($size) ; $i++) {
						$sql4 = "insert into tb_product_attribute (product_id, size_id) values (".$row[0].", ".$size[$i].")";
						$query4 = mysqli_query($conn, $sql4);
					}
				}
				if (empty($size)) {
					for ($i=0; $i < count($color) ; $i++) {
						$sql4 = "insert into tb_product_attribute (product_id, color_id) values (".$row[0].", ".$color[$i].")";
						$query4 = mysqli_query($conn, $sql4);
					}
				}
			}

			if (!empty($color) && !empty($size)) {
				for ($i=0; $i < count($color) ; $i++) {
					for ($j=0; $j < count($size); $j++) { 
						$sql4 = "insert into tb_product_attribute (product_id, color_id, size_id) values (".$row[0].", ".$color[$i].", ".$size[$j].")";
						$query4 = mysqli_query($conn, $sql4);
					}
				}
			}

			header("location: ../products.php?flag=9");

		} else {
			echo "error";
		}

	}

?>