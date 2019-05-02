<?php

class getUsers extends Database {

    public function users () {
        
        $stmt = $this->conn->prepare("SELECT username, user_id FROM rafha13.siteUser");
                
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $users = $stmt->fetchAll();
        
        $result = [];


        foreach ($users as $tmp) :
            array_push($result, $tmp);
        endforeach;

        $json = json_encode($result);

        return $json;
    }

}
?>