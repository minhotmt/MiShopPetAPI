<?php

	require '../includes/DBConnection.php';

	$json_response = array();

	// fetch categories
	$fetch_categories = mysqli_query($conn, "select * from tb_category order by id asc");
	while ($row_categories = mysqli_fetch_array($fetch_categories)) {
		$category['id'] = $row_categories['id'];
		$category['name'] = $row_categories['name'];
		$category['bannerUrl'] = $row_categories['banner_url'];
		$category['categories'] = array();

		// fetch child categories
		$fetch_child_categories = mysqli_query($conn, "select ch.id, ch.name, ch.thumbnail_url from tb_child_category ch, tb_category c where ch.category_id = c.id and c.id = ". $row_categories['id'] ." order by ch.name asc");
		while ($row_child_categories = mysqli_fetch_array($fetch_child_categories)) {
			$child_category['id'] = $row_child_categories['id'];
			$child_category['name'] = $row_child_categories['name'];
			$child_category['thumbnailUrl'] = $row_child_categories['thumbnail_url'];

			array_push($category['categories'], $child_category);
		}

		array_push($json_response, $category);
	}


	echo json_encode($json_response, JSON_NUMERIC_CHECK);

?>