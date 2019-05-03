<?php
class User extends Database {
	
	//public $name;
	
	public function login($username,$password){ //whether username and password are correct
		
		$sql = "select password from usersinfo where username = :username";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username',$username);
		$stmt->execute();
		$pwd_from_data = $stmt->fetchColumn();
		if(md5($password)==$pwd_from_data){
			return true;
		}
		else
			return false;
		
		
	}	
	
	public function register($username,$password,$firstname,$lastname,$zip,$city,$email,$phone,$photo="") {
		//检查用户名是否已存在(ajax仅检测用户名是否存在，该段代码保证重名的不能注册成功)
		$sqlSelectName = "select username from usersinfo where username = :username";
		$stmt = $this->conn->prepare($sqlSelectName);
		$stmt->bindParam(':username',$username);
		$stmt->execute();
		$num = $stmt->fetchColumn();
		if($num){
			echo "<script>alert('Someone already has that username. Try another?');history.back(-1);</script>";
			exit;
			
		}
		
		//检查email是否已被注册
		$sqlSelectEmail = "select email from usersinfo where email = :email";
		$stmt = $this->conn->prepare($sqlSelectEmail);
		$stmt->bindParam(':email',$email);
		$stmt->execute();
		$numEmail = $stmt->fetchColumn();
		if($numEmail){
			echo "<script>alert('The email address you have entered is already registered!');history.back(-1);</script>";
			exit;
			
		}
		
		//取头像路径
		if(!empty($_FILES['photo']['name'])){
			
			$FileExtensions = substr(strrchr($_FILES["photo"]["type"],'/'),1);//获取图片后缀
			$filepath="./photos/".time().".".$FileExtensions;
			$bool = move_uploaded_file($_FILES['photo']['tmp_name'],$filepath);//上传图片到文件夹
			/*
			if($bool){
				echo "<script>alert('上传到文件夹成功')</script>";
				
			}
			else
				echo "<script>alert('上传到文件夹失败')</script>";
			*/
			
			//$dbpath= "/ass/photos/".time().".".$a;   //path:/ass/photos/a.jpg 存入数据库
			$dbpath = "/shzha19/mvc/public/photos/".time().".".$FileExtensions;
		}
		else{
			
			$dbpath = "/shzha19/mvc/public/photos/default.jpg";
			echo $dbpath;
		}
		
		//写入数据库
		$password = md5($password);
		$sqlInsert = "insert into usersinfo(username,password,firstname,lastname,zip,city,email,phone,photo) values(:username, :password,:firstname,:lastname,:zip,:city,:email,:phone,:photo)";
		$stmt = $this->conn->prepare($sqlInsert);
		$stmt->bindParam(':username',$username);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':firstname',$_POST['firstname']);
		$stmt->bindParam(':lastname',$_POST['lastname']);
		$stmt->bindParam(':zip',$_POST['zip']);
		$stmt->bindParam(':city',$_POST['city']);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':phone',$_POST['phone']);
		$stmt->bindParam(':photo',$dbpath);
		
		$inserted = $stmt->execute();
		if($inserted) {
			echo "<script>alert('Register success');window.location.href='/shzha19/mvc/public/index.php/login';</script>";
		}
		else
			echo "<script>alert('Something went wrong. Please try again')</script>";
			
	}

	public function ajax($username) {
		if(!preg_match('/^[\w\x80-\xff]{1,20}$/', $username)){
			echo $username;
			echo "Username is illegal！";
			exit;
		}
		else{
			$sqlSelectName = "select username from usersinfo where username = :username";
			$stmt = $this->conn->prepare($sqlSelectName);
			$stmt->bindParam(':username',$username);
			$stmt->execute();
			$num = $stmt->fetchColumn();
			if($num){
				echo "Someone already has that username. Try another?";
			}else{
				echo "You can use this username!";
			}
			
			
		}
	}
	
	public function getAllUsers() {
		$sql = "select * from usersinfo order by usersinfo.user_id desc";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $allUsers;
	}
	
	
}