<?php

    // Logging the user in. 
    // Argument: un = username
    // Argument: pw = password
    function authentificateUser($un, $pw) {
        require 'db_config.php';
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $sql = 'SELECT user_id FROM user WHERE user_name = :domain_name AND user_password = :domain_pass';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':domain_name', $un);
        $stmt->bindParam(':domain_pass', $pw);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        if ($result[0] == NULL) {
            return false;
        } else {
            return true;
        }
    }

    function insertUserInfo($un, $pw, $pn, $em, $zc) {
        try {
            require 'db_config.php';
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'INSERT INTO user 
                    SELECT * FROM (SELECT UUID(),:domain_name,:domain_pass,:domain_phone,:domain_email,:domain_zipcode) AS tmp
                    WHERE NOT EXISTS (SELECT `user_name` FROM user WHERE `user_name` = :domain_name) LIMIT 1';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':domain_name', $un);
            $stmt->bindParam(':domain_pass', $pw);
            $stmt->bindParam(':domain_phone', $pn);
            $stmt->bindParam(':domain_email', $em);
            $stmt->bindParam(':domain_zipcode', $zc);
            $stmt->execute();
            $count = $stmt->rowCount();

            if ($count == 1) {
                echo 'true';
            } else {
                echo 'false';
            }
            return true;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function selectAllPosts() {
        require 'db_config.php';
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $data = $pdo->query("SELECT * FROM user_post ORDER BY user_post_time DESC");
        $result = $data->fetchAll();
        return $result;
        // $resultsarray = array();
        
        // foreach ($result as $row) {
        //     $counter = 0;
        //     $resultsarray[$counter] = $row;
        //     $counter = $counter++;
        // }
        // return $resultsarray;
    }

    function insertPost($hd, $dc, $url) {
        try {
            require 'db_config.php';
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO user_post VALUES (:domain_id, now(), :domain_header, :domain_desc, :domain_url)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':domain_id', uniqid());
            $stmt->bindParam(':domain_header', $hd);
            $stmt->bindParam(':domain_desc', $dc);
            $stmt->bindParam(':domain_url', $url);
            $stmt->execute();
            $count = $stmt->rowCount();

            if ($count == 1) {
                return true;
            } else {
                return false;
            }
          

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // if (insertPost('select * where 1 =1 ','Free wallpaper for you guys who loves my style.','uploads/Screenshot from 2019-03-08 20-50-02.png')) {
    //     echo 'true';
    // } else {
    //     echo 'false';
    // }
    
    //selectAllPosts();
    //echo uniqid();

?>