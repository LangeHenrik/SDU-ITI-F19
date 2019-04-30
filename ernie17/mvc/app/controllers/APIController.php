<?php

class APIController extends Controller {

	public function index () {

	}

    public function users () {
        $users = $this->model('User') -> getAllUsernameAndId();

        $json_users = json_encode($users, JSON_PRETTY_PRINT);

        header('Content-Type:application/json');
        echo $json_users;
    }

    public function pictures ($user, $userId) {
		header('Content-Type:application/json');

        if (isset($_SERVER['REQUEST_METHOD']) && $this->post()) {
            $pictureInput = json_decode($_POST['json'], true);
            $imageBlob = $pictureInput['image'];
            $header = $pictureInput['title'];
            $description = $pictureInput['description'];
            $username = $pictureInput['username'];
            $password = $pictureInput['password'];

            $returnedUserId = $this->model('User') -> validateUser($username, $password);

            if ($returnedUserId === $userId) {
                $image_id = $this->model('Picture') -> apiUpload($imageBlob, $header, $description, $userId);

				$image_id = array('image_id' => $image_id);

                $json_users = json_encode($image_id, JSON_PRETTY_PRINT);

                echo $json_users;
            }
        } else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET') {

            $pictures = $this->model('Picture') -> getPicturesFromUser($userId);

			$returnObject = array();

			foreach ($pictures as $picture) {
				$returnObject[] = array($picture);
			}

            $json_users = json_encode($pictures, JSON_PRETTY_PRINT);

            echo $json_users;
        }

        #echo "Error";
    }

}
