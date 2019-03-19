<?php
    session_start();

    if(!isset($_SESSION['ID'])) {
        header('Location: /index.php');
    }

    $iid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $opinion = $_POST['opinion'];

    $opinions = array('LIKES', 'DISLIKES');

    if(empty($iid) || empty($opinion)) {
        $_SESSION['MESSAGE'] = 'The id or opinion is empty!';
    } else if(!in_array($opinion, $opinions)) {
        $_SESSION['MESSAGE'] = 'The opinion is invalid!';
    } else {
        include('pdo.php');
        
        try {
            $sql = 'SELECT * FROM opinion WHERE image_id = :id;';
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':id', $iid);

            $stmt -> execute();
            $result = $stmt -> fetchAll();
            
            if(count($result) > 0) {
                if($result[0]['opinion'] == $opinion) {
                    $sql = 'UPDATE opinion SET opinion = :opinion WHERE account_id = :aid AND image_id = :iid;';
                    $stmt = $conn -> prepare($sql);
                    $stmt -> bindParam(':opinion', $opinion);
                    $stmt -> bindParam(':id', $_SESSION['ID']);
                    $stmt -> bindParam(':id', $iid);
                }
            } else {
                $sql = 'INSERT INTO opinion(account_id, image_id, opinion) VALUES';
            }

            if(count($result) > 0 && $result[0]['opinion'] == $opinion) {
                $sql = 'DELETE FROM opinion WHERE image_id = :id;';
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(':id', $iid);
            } else {
                
            }
        } catch (PDOException $e) {
            $_SESSION['MESSAGE'] = 'ERROR: ' . $e -> getMessage();
        }
    }

?>