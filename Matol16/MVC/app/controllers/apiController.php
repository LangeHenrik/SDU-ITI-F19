<?php
class ApiController extends controller
{
    public function users(){
        if ($this->get()) {
            $databaseUsers = $this->model('User')->getAllUsers();
            $users = array();

            foreach($databaseUsers as $user){
                $tempUser['user_id']=$user['ID'];
                $tempUser['username']=$user['username'];
                $users[] = $tempUser;

            }
            echo json_encode($users);
        }
    }

    public function pictures($param,$user_id){
        if ($this->get()) {
            $databasePics = $this->model('Picture')->getUserPictures($user_id);
            $pictures = array();

            foreach($databasePics as $picture){
                $tempPic['image']=$picture['picturelink'];
                $tempPic['title']=$picture['header'];
                $tempPic['description']=$picture['description'];
                $pictures[] = $tempPic;
            }
            echo json_encode($pictures);
        } else if ($this->post()) {
            //Forstår simpelthen ikke opgavedelen
            $picturePost = json_decode($_POST['json']);
            $pictureTitle = $picturePost->title;
            $pictureLink = $picturePost->image;
            $pictureDesc = $picturePost->description;
            $pictureUsername = $picturePost->username;
            $picturePass = $picturePost->password;
            $userModel = $this->model('User');
            if ($userModel->APIlogin($pictureUsername, $picturePass)){
                $pictureID = $this->model('Picture')->addPictureAPI($pictureTitle, $pictureDesc, $pictureLink);
                echo($pictureID);
            }

        }
    }
}