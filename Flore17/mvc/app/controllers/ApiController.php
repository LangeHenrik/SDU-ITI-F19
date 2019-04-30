<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

class ApiController extends Controller {

	
	public static function index () {
		
	}

	public function users(){
		$viewbag['users'] = $this->model('User')->getAllUsers();
		$this->service('UserPicApi')->users2json($viewbag);
	}

	public function pictures($username, $user_id){

		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			
			$viewbag['images'] = $this->model('Picture')->getAllPosts();

			$this->service('UserPicApi')->image2json($viewbag);

		} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {


		/*
			//For testing:
			$ext1 = 'image/png';
			$blob = 'iVBORw0KGgoAAAANSUhEUgAAABQAAAANCAYAAACpUE5eAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA7DAAAOwwHHb6hkAAAAB3RJTUUH4wQcAh0kc6DRyAAAAu1JREFUOMtlkc1rXGUYxX/Pe9/3ztw7H3ca82EothQKihTR2mJUrIgUwYWu/QP8A3TrRrdSV4rNRigUV1WRirUBiWLrUoySREJJjTFtSewkM5nP+/U+LqaK4A+ezVkcznOOHHa7igj/IIBXRXUiGxOg6gEwxuC94ssS6xz/RQAtSwwoYgwigoigQBRFJEkCCN57QFCvFEWBtZZmkvB/BBXB+CKnGPcpsyH5uI8znuWlb/hk8SIVK4RhSJamiECStNjb3eXq51fwRYbPU3w+/ve0zLGIgApehcKDq8Ssrf/GB++9y631VRaeP8fq6hrWWc6efZoPL1wgzXJeevk8gqA6+VdRRGRiKIFDAGcsaZbz6muvc3PpW5avfY0f9PHGEcc1Li0u0vlrnzffeptavc5gMMAEwaRAFEGwxlrQySiqigJHWgntTpv5uWlu79xlfX2NRiPhySdOMRwdUqvXCJxDjHlg+CAmYDu79wiCAJUAVaXRqPPF5Uv8vv0HJ48fo723RRA16Kc5W9s7qAjXv/qSZ59boPRKYCbpAIyAPdhcISjHlKN9jBi2B2N+vHETFzp6/R7Ts/PMzB2lyHP2d7fAOjZvb3H98ke8+Mzj9HsDBEUCR1hrYE8creMPuxRhTmQKPlvZ5G77kDOPHWfU7zE0lvb9PRrNFnHzIUoRitITDO7QGEXUnRC4kJIA4wS59s4rCkJUa/LnIOLTpRXS8Yg3zj9FN3d8/+sdgjAmlBKbH1ILlf3OkKga0u31eOH0Sc6dmsGVI7wqVpuPUK1WuLff5eMrN1AT0IwqLP20QxrExEmLlh2ysbHB3u4es1NTZFkG6omrEcs//MyJ6TMcm60yzgpk+7uLShAyHva5tfoLB+0uTTOgLHJGhZBW5pgPO1QaLXr9Mf2xkuclrWpGVhqcczx6eoH6kRm898jq1fe1VEs2HpGnGU5T8lLpHHQ4uN8hjiyzUxVQwZjJnkEQEk89TJzMkHsoSk+WlSDC3xXbYiGh3Q16AAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDE5LTA0LTI4VDAyOjI5OjM2LTA3OjAw+KHRWAAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxOS0wNC0yOFQwMjoyOTozNi0wNzowMIn8aeQAAAAASUVORK5CYII=';
			$_POST['json'] = '{"image": "' . $blob . '","title": "some title", "description":"my description","username":"frederiklorenzen","password":"Frederik1243"}';
		*/

			$json_obj = json_decode($_POST['json']);

			$exists = $this->model('User')->checkPasswordDB($json_obj->username, $json_obj->password);
			
			//Split image-blob in ext and content
			$temp = $json_obj->image;
			//echo $temp;
			$temp1 = explode(';', $temp, 2);
			$ext = $temp1[0];
			$ext1 = substr($ext, 5);
			$image = $temp1[1];
			$image1 = substr($image, 7);

			$user_id_match = $this->model('User')->checkUserID($json_obj->username, $user_id);

			if ($exists == true && $user_id_match == true){
				$image_id = $this->model('Picture')->uploadPicDB($json_obj->title, $json_obj->description, $image1, $ext1);
				$img_id->image_id = $image_id;
				$json = json_encode($img_id, JSON_PRETTY_PRINT);

				header('Content-Type: application/json');
				echo $json;
			}
		}
	}
}
?>

