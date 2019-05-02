<?php

class APIController extends Controller
{


    public function users()
    {
        $DB = new Database();
        $stmt = $DB->conn->prepare("SELECT ID AS user_id, username FROM user");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($users);
        $bag = json_encode($users, JSON_PRETTY_PRINT);
        $this->view('api/users', $bag);

    }

    public function pictures()
    {
        if ($this->post()) {
            $image_id = 1;
            $json = file_get_contents('php://input');
            $req = json_decode($json, true);
            $user = $req["username"];
            $password = $req["password"];
            $DB = new Database();

            $stmt = $DB->conn->prepare("SELECT * FROM user WHERE username=? ");
            $stmt->bindValue(1, $user, PDO::PARAM_STR);
            $stmt->execute();
            $users = $stmt->fetch();
            $viewbag = new ArrayIterator();
            $pass = hash('sha512', $password . $users['salt']);

            if ($users['ID'] == NULL || $users['password'] != $pass) {
                $viewbag['err'] = "login incorrect";
                $this->view('api/pictures', $viewbag);
            } else {
                $img = $req['image'];
                $imageid = basename($this->getUUID());
                $imagedescription = $req['description'];
                $imagename = $req['title'];
                $DB = new Database();
                $stmt = $DB->conn->prepare("INSERT INTO image (image_id, name, description, user, imgblob) VALUES (:id,:name,:desc,:user,:blob)");
                $stmt->bindParam(':id', $imageid);
                $stmt->bindParam(':name', $imagename);
                $stmt->bindParam(':desc', $imagedescription);
                $stmt->bindParam(':user', $user);
                $stmt->bindParam(':blob', $img);
                $stmt->execute();
                $bag['image_id'] = $image_id;
                $this->view('api/pictures', $bag);
            }

        } elseif ($this->get()) {

            //var_dump($this->parseUrl());
            if ($this->parseUrl()[count($this->parseUrl()) - 2] == "user") {
                $userid = $this->parseUrl()[count($this->parseUrl()) - 1];
                $DB = new Database();
                $bag = [];
                $result = $DB->conn->query("SELECT name, image_id, description, rating FROM image WHERE user LIKE '" . $userid . "'");
                if ($result->rowCount() > 0) {
                    $i = 0;
                    while ($row = $result->fetch()) {
                        $bag[$i]['image'] = $row['image_id'];
                        $bag[$i]['title'] = $row['name'];
                        $bag[$i]['description'] = $row['description'];
                        $i++;
                    }
                }
            }
//            var_dump($bag);


            $this->view('api/pictures', json_encode($bag));
        }
    }

    public function parseUrl()
    {
        $url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return array_slice($url, 4);
    }
}