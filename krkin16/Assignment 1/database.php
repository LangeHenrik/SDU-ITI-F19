<?php
$serverName = "localhost:3307";
$dbUser = "root";
$dbPassword = "";
$dbName = "spacebook";
    
    
    
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function connect() {
    global $serverName, $dbUser, $dbPassword, $dbName, $connection;
    $connection = mysqli_connect($serverName, $dbUser, $dbPassword, $dbName);
}
function registerUser($username, $password, $firstName, $lastName, $zip, $city, $email, $phone) {
    connect();
    global $connection;
    $stmt = $connection->prepare("INSERT INTO users (username, password, first_name, last_name, zip, city, email, phone) VALUES (?, ?, ?, ?,?, ?,?, ?)");
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $stmt->bind_param("ssssisss", $username, $hashed, $firstName, $lastName, $zip, $city, $email, $phone);
    if(!$stmt->execute()) {
        echo $stmt->error;
    }
    
    $stmt->close();
    $connection->close();
}

function deleteImage($id) {
    connect();
    global $connection;
    $stmt = $connection->prepare("DELETE FROM images WHERE id = ?");
    $stmt->bind_param("i", $id);
    if(!$stmt->execute()) {
        echo $stmt->error;
    }
    
    $stmt = $connection->prepare("DELETE FROM comments WHERE image_id = ?");
    $stmt->bind_param("i", $id);
    if(!$stmt->execute()) {
        echo $stmt->error;
    }
    
    $stmt->close();
    $connection->close();
}


function uploadImage($title, $description, $path) {
    connect();
    global $connection;    
    $user_id= getId($_SESSION["user_name"]);
    $stmt = $connection->prepare("INSERT INTO images (title, description, image_path, user_id) VALUES (?, ?, ?, ?)");
    
    $stmt->bind_param("sssi", $title, $description, $path, $user_id);
    
    
    if(!$stmt->execute()) {
        echo $stmt->error;
    }
    
    $stmt->close();
    $connection->close();
}

function authenticate($username, $password) {
    connect();
    global $connection;
    $stmt = $connection->prepare("SELECT password from users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $isLegit = false;
    
    while($row = $result->fetch_assoc()) {
        $isLegit = password_verify($password, $row["password"]);
    }
    
    return $isLegit;
}

function getId($username) {
    connect();
    global $connection;
    $stmt = $connection->prepare("SELECT id from users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()) {
        return $row["id"];
    }
}

function getUser($id=null) {
    connect();
    global $connection;
    if($id!==null) {
        $stmt = $connection->prepare("SELECT username from users WHERE id = ?");
        $stmt->bind_param("i", $id);$stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            return $row["username"];
        }
    } else {
        $result = $connection->query("SELECT username from users;");
        $arrayOfUsers = array();
        $count=0;

        while($row = $result->fetch_assoc()) {
            $arrayOfUsers[$count++] = $row["username"];
        }
        return $arrayOfUsers;
    }    
}

function imagesInRange($start_i, $amount, $user) {
    connect();
    global $connection;
    $entries = array();
    if($user === null) {
        $stmt = $connection->prepare("SELECT * FROM images limit ?, ?");
        $stmt->bind_param("ii", $start_i, $amount);
    } else {
        $id = getId($user);
        $stmt = $connection->prepare("SELECT * FROM images WHERE user_id = ? limit ?, ?");
        $stmt->bind_param("iii", $id, $start_i, $amount);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $index = 0;
    while($row = $result->fetch_assoc()) {
        $entries[$index] = new stdClass();
        $entries[$index]->id = $row["id"];
        $entries[$index]->imagePath = $row["image_path"];
        $entries[$index]->title = $row["title"];
        $entries[$index]->description = $row["description"];
        $entries[$index]->user = $row["user_id"];
        $entries[$index]->imageDate = $row["date"];
        
        $index++;
    }
    
    foreach($entries as $object) {
        $object->user=getUser($object->user);
    }
    
    return $entries;
}
function getComments($imageId) {
    connect();
    global $connection;
    $entries = array();
    
    
    $stmt = $connection->prepare("SELECT * FROM comments WHERE image_id = ?");
    $stmt->bind_param("i", $imageId);

    $stmt->execute();
    $result = $stmt->get_result();
    $index = 0;
    while($row = $result->fetch_assoc()) {
        $entries[$index] = new stdClass();
        $entries[$index]->id = $row["id"];
        $entries[$index]->text = $row["text"];
        $entries[$index]->userId = $row["user_id"];
        
        $index++;
    }
    
    foreach($entries as $object) {
        $object->user=getUser($object->userId);
    }
    
    return $entries;
}

function getImage($id) {
    connect();
    global $connection;
    

    $stmt = $connection->prepare("SELECT * FROM images WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $row = $result->fetch_assoc();
        
    $entry = new stdClass();
    $entry->id = $row["id"];
    $entry->imagePath = $row["image_path"];
    $entry->title = $row["title"];
    $entry->description = $row["description"];
    $entry->user = $row["user_id"];
    $entry->imageDate = $row["date"];
    
    
    return $entry;
}

function submitComment($comment, $imageId, $user) {
    connect();
    global $connection;    
    $user_id= getId($user);
    $stmt = $connection->prepare("INSERT INTO comments (text, image_id, user_id) VALUES (?, ?, ?)");
    
    $stmt->bind_param("sii", $comment, $imageId, $user_id);
    
    
    if(!$stmt->execute()) {
        echo $stmt->error;
    }
    
    $stmt->close();
    $connection->close();
}

?>