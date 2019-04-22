<?php



function getImagesJson($start_index, $amount, $displayUser = null) {
	return json_encode(imagesInRange($start_index, $amount, $displayUser));
}