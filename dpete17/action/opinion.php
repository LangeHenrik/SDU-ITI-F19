<?php
    session_start();

    if(!isset($_SESSION['ID'])) {
        header("HTTP/1.1 401 Unauthorized");
        header('Location: /index.php');
    } else {
        header("HTTP/1.1 400 Bad Request");
    }

    $iid = filter_input(INPUT_GET, 'iid', FILTER_SANITIZE_NUMBER_INT);
    $opinion = $_GET['opinion'];

    $opinions = array('LIKES', 'DISLIKES');

    if(empty($iid) || empty($opinion)) {
        echo 'The id or opinion is empty!';
    } else if(!in_array($opinion, $opinions)) {
        echo 'The opinion is invalid!';
    } else {
        include('pdo.php');
        
        try {
            $sql = 'SELECT * FROM opinion WHERE account_id = :aid AND image_id = :iid;';
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':aid', $_SESSION['ID']);
            $stmt -> bindParam(':iid', $iid);

            $stmt -> execute();
            $result = $stmt -> fetchAll();
            
            if(count($result) > 0) {
                if($result[0]['opinion'] == $opinion) {
                    $sql = 'DELETE FROM `opinion` WHERE account_id = :aid AND image_id = :iid;';
                    $stmt = $conn -> prepare($sql);
                } else {
                    $sql = 'UPDATE `opinion` SET opinion = :opinion WHERE account_id = :aid AND image_id = :iid;';
                    $stmt = $conn -> prepare($sql);
                    $stmt -> bindParam(':opinion', $opinion);
                }

                $stmt -> bindParam(':aid', $_SESSION['ID']);
                $stmt -> bindParam(':iid', $iid);
            
                $stmt -> execute();
            } else {
                $sql = 'INSERT INTO opinion(account_id, image_id, opinion) VALUES (:aid, :iid, :opinion)';
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(':aid', $_SESSION['ID']);
                $stmt -> bindParam(':iid', $iid);
                $stmt -> bindParam(':opinion', $opinion);

                $stmt -> execute();
            }

            # new query
            $sql = "SELECT sum(`opinion` = 'LIKES') as likes, sum(`opinion` = 'DISLIKES') as dislikes FROM `opinion` WHERE image_id = :iid HAVING SUM(opinion) IS NOT NULL;";
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':iid', $iid);

            $stmt -> execute();
            $result = $stmt -> fetchAll();

            if(count($result) > 0) {
                echo json_encode(array('LIKES' => $result[0][0], 'DISLIKES' => $result[0][1]));
            } else {
                echo json_encode(array('LIKES' => 0, 'DISLIKES' => 0));
            }

            header("HTTP/1.1 200 OK");
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e -> getMessage();
        }
    }
?>