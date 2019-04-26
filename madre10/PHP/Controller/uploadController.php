<?php
require_once(__DIR__ . '/../Model/postDAO.php');
$data_is_present = is_uploaded_file ( $_FILES['image']['tmp_name']) && isset($_POST['title']) && isset($_POST['description']);
$user_is_set = isset($_SESSION['user_id']);


if ($data_is_present && $user_is_set) {
    $title = htmlentities($_POST['title']);
    $description = htmlentities($_POST['description']);
    $path = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($file_tmp);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    $result = addPost($title, $description, $base64, $_SESSION['user_id']);
    header("Location: /images");


} else {
    echo "Something went wrong..";
}


