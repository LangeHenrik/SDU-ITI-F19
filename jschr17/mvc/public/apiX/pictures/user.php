<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json, charset=UTF-8");
include_once(__DIR__ . '/../../../app/core/Database.php');
include_once (__DIR__ . '/user.php');

$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
switch ($method) {
    case 'POST':
        postValues();
        break;
    default:
        echo 'Default switch case';
        break;
}

function postValues(){
    $database = new Database();
    $conn = $database->getConn();

    $data = file_get_contents("php://input");
    $json = json_decode($data, true);
    extract($json);
    $user_id = '1'; //NEED TO GET PROPER FROM THE URL!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    $image = base64_decode($json['image']);
    $title = $json['title'];
    $description = $json['description'];
    $username = $json['username'];
    $password = $json['password'];

    $userBool = checkUser($username, $password, $conn);
    $matchBool = matchUsernameAndId($user_id, $username, $conn);

    if($userBool === $matchBool){
        uploadImage($image, $title, $description, $user_id, $conn);
        returnImgId($conn);
    } else{
        return 'Something went wrong';
    }
}

function returnImgId($conn){

    $sql = "SELECT user_id FROM images ORDER BY image_id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $got_user_id = $stmt->fetch(PDO::FETCH_ASSOC);

    echo $got_user_id['user_id'];

}

function uploadImage($blob, $title, $desc, $user_id, $conn){

    $sql2 = 'INSERT INTO images(image, title, description, user_id) VALUES (?, ?, ?, ?);';
    $stmt2 = $conn->prepare($sql2);
    if(!$stmt2 = $conn->prepare($sql2)){
        echo "SQL statement failed 2";
    } else {
        $stmt2->execute([$blob, $title, $desc, $user_id]);
    }
}

function checkUser($username, $password, $conn)
{
    $sql_username = "SELECT username FROM users WHERE username = :param_username";
    $stmt1 = $conn->prepare($sql_username);
    if ($conn->prepare($sql_username)) {
        $stmt1->bindParam(':param_username', $param_username);
        $param_username = $username;
        if ($stmt1->execute()) {
            // Store result
            $username_values = $stmt1->fetchAll();
            $got_username = '';
            foreach ($username_values as $_username) {
                $got_username = $_username['username'];
            }
            if ($param_username === $got_username) {
                $sql_password = "SELECT password FROM users WHERE username = :param_username";
                $stmt2 = $conn->prepare($sql_password);
                $stmt2->bindParam(':param_username', $param_username);
                $stmt2->execute();
                $password_values = $stmt2->fetchAll();
                $got_hashed_password = '';
                foreach ($password_values as $hashed_password) {
                    $got_hashed_password = $hashed_password['password'];
                }
                if (password_verify($password, $got_hashed_password)) {
                    return true;
                } else return false;
            }
        }
    }
}

function matchUsernameAndId($user_id, $username, $conn){
    $sql = "SELECT username FROM users WHERE user_id = :param_user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param_user_id', $user_id);
    $stmt->execute();

    $gotUsername = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($gotUsername['username'] !== $username){
                return false;
            } else{
                return true;
            }
}
