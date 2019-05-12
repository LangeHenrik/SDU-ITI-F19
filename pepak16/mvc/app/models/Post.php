<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/core/Database.php';

    class Post extends Database {
        
        protected $image_id;

        public function getPostId() {
            return $this->$image_id;
        }
        
        public function setPostId($setPostId) {
            $this->$image_id["image_id"] = $setPostId;
        }

        public function __toString() {
            try {
                $intvar = $this->$image_id;
                if(is_null($intvar)) {
                    return 'NULL';
                } else {
                    return '{"image_id": "'.strval($intvar).'"}';
                }
            } catch (Exception $exception) {
                return 'Cannot be converted to string';
            }
        }
    }

    
?>