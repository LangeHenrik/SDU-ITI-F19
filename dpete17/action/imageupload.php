<?php
    session_start();

    if(!isset($_SESSION['ID'])) {
        header('Location: /index.php');
    }

    #$header = filter_input(INPUT_POST, 'header', FILTER_SANITIZE_STRING);
    $header = $_POST['header'];
    $content = $_POST['content'];

    $header = htmlentities($header);
    $content = htmlentities($content);

    $allowed =  array('image/gif','image/png' ,'image/jpg', 'image/jpeg');
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

    if(empty($header)) {
        $_SESSION['MESSAGE'] = "Header cannot be empty.";
    } else if($_FILES['image']['size'] > 0 && in_array($_FILES['image']['type'], $allowed)) {
        $hashed = hash('sha256', basename($_FILES['image']['name']) . time());
        
        include('pdo.php');
        
        try {
            $sql = 'INSERT INTO image(filename, header, content, uploaded_at) VALUES (:filename, :header, :content, now());';
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':filename', $hashed);
            $stmt -> bindParam(':header', $header);
            $stmt -> bindParam(':content', $content);
    
            $executed1 = $stmt -> execute();

            $sql = "INSERT INTO uploads(account_id, image_id) VALUES ({$_SESSION['ID']}, {$conn -> lastInsertId()});";
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':filename', $hashed);

            $executed2 = $stmt -> execute();

            if($executed1 && $executed2) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $hashed);
            }
    
            header('Location: ../dashboard/account.php');
        } catch (PDOException $e) {
            echo "ERROR: " . $e -> getMessage();
        }
    } else {
        $_SESSION['MESSAGE'] = 'The file extension is not allowed or the size is empty!';
    }
?>