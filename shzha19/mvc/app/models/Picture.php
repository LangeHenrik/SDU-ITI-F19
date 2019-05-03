<?php
class Picture extends Database {
	
	//public $name;
	
	public function getAllPictures(){
		$sql = "select * from postview,usersinfo where postview.username=usersinfo.username order by postview.image_id desc";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$pictures = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $pictures;
	}
	
	public function getMyPictures() {
		$name = $_SESSION['username'];
		$sql = "SELECT * from postview,usersinfo where postview.username = usersinfo.username and usersinfo.username = :username order by postview.image_id desc";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username',$name);
		$stmt->execute();
		$mypictures = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $mypictures;
	}
	
	public function insertPost($title,$description,$image=""){
		$FileExtensions = substr(strrchr($_FILES["image"]["type"],'/'),1);//获取图片后缀
		$filepath="./pictures/".time().".".$FileExtensions;
		$bool = move_uploaded_file($_FILES['image']['tmp_name'],$filepath);//上传图片到文件夹
		/*
		if($bool){
			echo "<script>alert('上传到文件夹成功')</script>";
			
		}
		else
			echo "<script>alert('上传到文件夹失败')</script>";
		*/
		$dbpath = "/shzha19/mvc/public/pictures/".time().".".$FileExtensions;
		
		$sql = "insert into postview(username,title,description,image) values(:username,:title,:description,:image)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username',$_SESSION['username']);
		$stmt->bindParam(':title',$title);
		$stmt->bindParam(':description',$description);
		$stmt->bindParam(':image',$dbpath);
		$inserted = $stmt->execute();
		if($inserted) {
			echo "<script>alert('Submitted successfully');window.location.href='/shzha19/mvc/public/index.php/mypictures';</script>";
		}
		else
			echo "<script>alert('Something went wrong. Please try again');history.back(-1);</script>";
	}
	
	public function deletePost($image_id) {
		$sql = "delete from postview where postview.image_id = :image_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':image_id',$image_id);
		$deleted = $stmt->execute();
		if($deleted) {
			echo "<script>alert('Deleted successfully');window.location.href='/shzha19/mvc/public/index.php/mypictures';</script>";
		}
		else
			echo "<script>alert('Something went wrong. Please try again');history.back(-1);</script>";
		
		
	}
	
}



?>