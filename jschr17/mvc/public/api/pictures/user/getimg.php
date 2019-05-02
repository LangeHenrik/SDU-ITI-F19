<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json, charset=UTF-8");
include_once(__DIR__ . '/../../../../app/core/Database.php');
include_once 'image.php';


$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
switch ($method) {
    case 'GET':
        readimg();
        break;
    case 'POST':
        //method call
        break;
    default:
        echo 'Default switch case';
        break;
}

function readimg(){
    // get $user from the URL given (2 is the id): GET localhost:8080/xx/mvc/public/api/pictures/user/2
    //$user = preg_split("(?<=user\/)(.*)", $_SERVER['REQUEST_URI']);
    $user = 1;
    echo json_encode("user id should be: " . $user);

    //create image array
    $images = array();
    
    try {
        //database connection
        $database = new Database;
        $db = $database->getConn();

        //connect to database
        $query = $db->prepare("SELECT * FROM images WHERE user_id = ". $user); // get $user from the URL given (2 is the id): GET localhost:8080/xx/mvc/public/api/pictures/user/2
        $query->execute();

        $images_size = $query->rowCount();

        //get list of user images
        $images = $query->fetchAll();
    } catch(Exception $e){
        echo json_encode('Exception in database connection');
    }
    
    echo json_encode('size of images array: ' . $images_size /*$images->sizeof*/);
    //check amount of images found
    if ($images_size > 0){
        $image_list = array();
        //echo json_encode(print_r($images));
        //print_r($images);
        foreach ($images as $img) {

            $image = new Image(
                $img[1], // index of image
                $img[3], // index of title
                $img[4]  // index of description
            );

            //for each tuple make new image object with the information
            /*$image = new Image(
                $img['image'],
                $img['title'],
                $img['description']
            );*/
            //add image to array of images
            array_push($image_list, $image);
        }

        //json encode array of images and return it
        $json = json_encode($image_list, JSON_PRETTY_PRINT);
        http_response_code(200);
        echo($json);
        return($json);
    } else {
        http_response_code(404); //find correct response code
        echo json_encode('no images found.');
        return $msg;
        
    }
}


//notes
//json_encode($object)
//foreach($object as $key => $value) {...}
//print_r($object)
?>