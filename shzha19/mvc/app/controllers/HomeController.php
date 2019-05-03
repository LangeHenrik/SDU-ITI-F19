<?php
class HomeController extends Controller {
	public function index ($param) {
		//if($_SESSION['logged_in']=='logged_in') {
		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
			header('Location: /shzha19/mvc/public/index.php/users');
		}
		else{
			
			$this->view('home/login');
		}
	}
	
	public function login() {
		if(isset($_POST['username'])){
			$name = $_POST['username'];
			$check = $this->model('User')->login($name,$_POST['password']);
			if($check==true){//用户名和密码对
				$_SESSION['logged_in'] ='logged_in';
				$_SESSION['username'] = $name;
				//$this->view('home/users');
				header('Location: /shzha19/mvc/public/index.php/users');
	
			}
			else{
				echo "<script>alert('Your username or password is wrong!')</script>";
				$this->view('home/login');
			}
		}
		/*
		else if($_SESSION['logged_in']=='logged_in') {
			$this->view('home/users');
		}
		*/
		else{
			$this->view('home/login');
		}		
		
	}
	
	public function register() {
		if(isset($_POST['username'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			//正则表达式检查用户名、密码和email的格式
			if(!preg_match('/^[\w\x80-\xff]{1,20}$/', $username)){
				echo "<script>alert('Username is illegal');history.back(-1);</script>";
				exit;
			}
			if(strlen($password) < 6){
				echo "<script>alert('Password must be at least 6 characters');history.back(-1);</script>";
				exit;
			}
			if(!preg_match('/^[a-zA-Z0-9_\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $email)){
				echo "<script>alert('Wrong Email address');history.back(-1);</script>";
				exit;
			}

			$this->model('User')->register($username,$password,$_POST['firstname'],$_POST['lastname'],$_POST['zip'],$_POST['city'],$email,$_POST['phone']);
			
		}
		else{
			$this->view('home/register');
		}
		
	}
	
	public function ajax($username) {
		$this->model('User')->ajax($username);
	}
	
	
	
	
	public function logout() {
		//$_SESSION['logged_in'] = '';
		//$_SESSION['username'] = '';
		session_unset();
		header('Location: /shzha19/mvc/public/index.php');
	
	}

	
	public function pictures() {
		if(isset($_SESSION['username'])){
			$viewbag['pictures'] = $this->model('Picture')->getAllPictures();
			$this->view('home/pictures',$viewbag);
		}
		else{
			echo "<script>alert('You have not logged in.');location.href='/shzha19/mvc/public/index.php/login';</script>";
		}
	}
	
	public function users() {
		if(isset($_SESSION['username'])){
			$viewbag['users'] = $this->model('User')->getAllUsers();
			
			$this->view('home/users',$viewbag);
		}
		else{
			echo "<script>alert('You have not logged in.');location.href='/shzha19/mvc/public/index.php/login';</script>";
		}
	}
	
	public function mypictures() {
		if(isset($_SESSION['username'])){
			$viewbag['mypictures'] = $this->model('Picture')->getMyPictures();
			$this->view('home/mypictures',$viewbag);
		}
		else{
			echo "<script>alert('You have not logged in.');location.href='/shzha19/mvc/public/index.php/login';</script>";
		}
	}
	
	
}




?>