<?php 
class userAPI extends Database {
    public function users() {
        $sql = "SELECT user_id, user_username as username
        FROM silar17.site_user
        order by user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $array = $stmt->fetchALL();
        $json = json_encode($array);
        return $json;
    }
}
class image {
    public $image;
    public $title;
    public $descreption;

    public function __construct($img_, $title_, $descreption_){
        $this->$image = $img_;
        $this->$title = $title_;
        $this->$descreption = $descreption_; 
    }
}
?>