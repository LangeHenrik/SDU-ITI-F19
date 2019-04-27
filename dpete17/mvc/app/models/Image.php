<?php 

class Image {
    public $id;
    public $base64;
    public $header;
    public $content;
    public $likes;
    public $dislikes;
    public $uploaded_at;

    public static function opinion($account_id, $image_id, $opinion) {
        $conn = Database::get() -> conn;

        $sql = 'SELECT account_id, image_id, opinion FROM opinion WHERE account_id = :aid AND image_id = :iid;';
        $stmt = $conn -> prepare($sql);
        $stmt -> bindParam(':aid', $account_id);
        $stmt -> bindParam(':iid', $image_id);

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

            $stmt -> bindParam(':aid', $account_id);
            $stmt -> bindParam(':iid', $image_id);
        
            $stmt -> execute();
        } else {
            $sql = 'INSERT INTO opinion(account_id, image_id, opinion) VALUES (:aid, :iid, :opinion)';
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':aid', $account_id);
            $stmt -> bindParam(':iid', $image_id);
            $stmt -> bindParam(':opinion', $opinion);

            $stmt -> execute();
        }

        # new query 
        $sql = "SELECT sum(`opinion` = 'LIKES') as likes, sum(`opinion` = 'DISLIKES') as dislikes FROM `opinion` WHERE image_id = :iid HAVING SUM(opinion) IS NOT NULL;";
        $stmt = $conn -> prepare($sql);
        $stmt -> bindParam(':iid', $image_id);

        $stmt -> execute();
        $result = $stmt -> fetchAll();

        if(count($result) > 0) {
            return json_encode(array('LIKES' => $result[0][0], 'DISLIKES' => $result[0][1]));
        } else {
            return json_encode(array('LIKES' => 0, 'DISLIKES' => 0));
        }
    }

    public function getMimeType() {
        $f = finfo_open();
        return finfo_buffer($f, $this -> base64, FILEINFO_MIME_TYPE);
    }

    public static function getImagesByAccount($account_id, $limit = 1000) {
        $sql = 'SELECT id, file as base64, header, content, uploaded_at FROM image WHERE id IN (SELECT image_id FROM uploads WHERE account_id = :account_id) LIMIT :limit;';
        $stmt = Database::get() -> conn -> prepare($sql);
        $stmt -> bindParam(':account_id', $account_id);
        $stmt -> bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt -> execute();

        $result = $stmt -> fetchAll(PDO::FETCH_CLASS, 'Image');
  
        return $result;
    }

    public static function getAllImages($limit = 1000) {
        $sql =  "SELECT image.id as id, (SELECT username FROM account, uploads WHERE account.id = uploads.account_id AND uploads.image_id = image.id) as user, " .
        "image.file as base64, image.header, image.content, image.uploaded_at, " .
        "(SELECT COALESCE(sum(opinion = 'LIKES'), 0) FROM opinion WHERE image_id = image.id) as 'likes', " .
        "(SELECT COALESCE(sum(opinion = 'DISLIKES'), 0) FROM opinion WHERE image_id = image.id) as 'dislikes' " .
        "FROM image LIMIT :limit;";

        $stmt = Database::get() -> conn -> prepare($sql);
        $stmt -> bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt -> execute();

        $result = $stmt -> fetchAll(PDO::FETCH_CLASS, 'Image');
  
        return $result;
    }

    public static function postImage($account_id, $image) {
        $conn = Database::get() -> conn;

        $time = time();

        $image_sql = 'INSERT INTO image(file, header, content, uploaded_at) VALUES (:file, :header, :content, FROM_UNIXTIME(:time));';
        $stmt = $conn -> prepare($image_sql);
        $stmt -> bindParam(':file', $image -> base64);
        $stmt -> bindParam(':header', $image -> header);
        $stmt -> bindParam(':content', $image -> content);
        $stmt -> bindParam(':time', $time);

        $executed1 = $stmt -> execute();
        $image_id = $conn -> lastInsertId();

        $uploads_sql = "INSERT INTO uploads(account_id, image_id) VALUES (:account_id, :image_id);";
        $stmt = $conn -> prepare($uploads_sql);
        $stmt -> bindParam(':account_id', $account_id);
        $stmt -> bindParam(':image_id', $image_id);

        $executed2 = $stmt -> execute();

        $new_image = null;
        if($executed1 && $executed2) {
            $new_image = new Image();
            $new_image -> id = $image_id;
            $new_image -> base64 = $image -> base64;
            $new_image -> header = $image -> header;
            $new_image -> content = $image -> content;
            $new_image -> uploaded_at = date('Y-m-d H:i:s', $time);
        }

        return $new_image;
    }
}

?>