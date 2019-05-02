<?php



function getImagesJson($start_index, $amount, $displayUser = null) {
	require_once "../app/models/Image.php";
	return json_encode(Image::imagesInRange($start_index, $amount, $displayUser));
}