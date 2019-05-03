<?php
    class Api extends Controller
    {

      public function __construct()
      {
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
        $this->db = new Database();
      }

      public function users()
      {
        header("Content-Type: application/json; charset=UTF-8");
        $users = $this->userModel->getUsers();
        $arr = array();
        foreach($users as $user){
            $userArr = array(
                'user_id' => $user->id,
                'username' => $user->email,
            );
            array_push($arr, $userArr);
        }

        echo json_encode($arr);
      }

      public function pictures()
      {
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
          if (isset($_GET)) // YODO: You only debug once
          {
            //array_push($_POST, $_GET);
          }
          
          $json = json_decode($_POST['json']);
         
          $userAuthenticated = $this->userModel->login($json->username, $json->password);

          if($userAuthenticated){
            $id = $this->userModel->getUserByEmail($json->username);
          $data = [
            'title' => $json->title,
            'body' => $json->description,
            'user_id' => $id,
            'picture' => $json->image
         ]; 
          $this->postModel->addPost($data);
          $this->db->query("SELECT id FROM posts ORDER BY id DESC LIMIT 1");
          $id = $this->db->single();
          
            $returnObj['image_id'] = $id->id;
            echo json_encode($returnObj);
          }else{
            $returnObj['image_id'] = "Oh, I dont think so";
            echo json_encode($returnObj);
          }
        }
        else
        {
          header("Content-Type: application/json; charset=UTF-8");
          $url = urldecode($_GET["url"]);
          $urlData = explode("/", $url);
          $posts = $this->postModel->getPostFromUserId($urlData[3]);
          
          $myArr = array();

          foreach ($posts as $post)
          {
            $postArr = array();
            $postArr['image'] = $post->picture;
            $postArr['title'] = $post->title;
            $postArr['description'] = $post->body;
            array_push($myArr, $postArr);
          }

          echo json_encode($myArr);
        }
      }
    }