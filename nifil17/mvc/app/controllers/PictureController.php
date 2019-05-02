<?php

require_once '../app/models/Picture.php';

class PictureController extends Controller {

	public function index() {
        if(isset($_SESSION['logged_in']) == true and $_SESSION['logged_in'] == true) {
			$viewbag['pics'] = $this->model('Picture')->getPictures();
			$this->view('picture/index', $viewbag);
        } else {
            header('Location: home');
        }
	}
	
	public function upload() {
		if(isset($_SESSION['logged_in']) == true and $_SESSION['logged_in'] == true) {
			$this->view('picture/upload');
        } else {
            header('Location: ../home');
        }
	}
	
	public function save() {
		if ( ! empty( $_POST ) ) {
			if ( isset( $_POST['image'] ) && isset( $_POST['header'] ) ) {
				$tmpname = $_POST['image'];
				$fp = fopen($_POST['image'], 'rb');
				try {
					require_once('../app/core/Database.php');
					$conn = (new Database)->conn;
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$st = $conn->prepare("INSERT INTO picture(picture, user, header, description) VALUES(:picture, :user, :header, :description)");
					$st->bindParam(':picture', $fp, PDO::PARAM_LOB);
					$st->bindParam(':user', $_SESSION['username']);
					$st->bindParam(':header', $_POST['header']);
					$st->bindParam(':description', $_POST['description']);
					$st->execute();
					header("Location: upload");
				}catch(PDOException $e) {
					'Error : ' .$e->getMessage();
				}
			} else {
			}
		} else {
		}
	}
}
