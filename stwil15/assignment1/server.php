<?php
session_start();

$errors = array();

// user registration variables
$username = "";
$password1 = "";
$password2 = "";
$firstname = "";
$lastname = "";
$zip = "";
$city = "";
$email = "";
$phone = "";

// database connection variables
$dbuser = 'root';
$dbpass = '';

// set up database PDO connection
try {
    $db = new PDO('mysql:host=localhost;dbname=itidb', $dbuser, $dbpass);
    //print stuff to test connection
    foreach($db->query('SELECT * from USERS') as $row) {
        print_r($row);
    }
} catch (PDOException $e) {
    print "ERROR: " . $e->getMessage() . "<br/>";
    die();
}
// userlogin
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // get userid for salt for the password hash
    $useridget = "SELECT userid FROM users WHERE username ='$username";
    $db->prepare($useridget);
    $userid = $db->execute();
    $hash = hash("sha256", ($password + $userid));
    // check login
    $query = "SELECT * from users WHERE username='$username' AND password='$hash'";
    $rs = $db->query($query);
    if
    
}


// use the connection
//$st = $db->query('SELECT * from USERS where username =' + $username); 

if (isset($_POST['submit'])) {
    // get input from form
    $username = $db->quote($_POST['username']);
    $password1 = $db->quote($_POST['password1']);
    $password2 = $db->quote($_POST['password2']);
    $firstname = $db->quote($_POST['firstname']);
    $lastname = $db->quote($_POST['lastname']);
    $zip = $db->quote($_POST['zip']);
    $city = $db->quote($_POST['city']);
    $email = $db->quote($_POST['email']);
    $phone = $db->quote($_POST['phone']);

    //validate form
    if (empty($username)) { array_push($errors, "username is required"); }
    if (empty($email)) { array_push($errors, 'Email is required');}
    if (empty($firstname )) { array_push($errors, 'firstname is required');}
    if (empty($lastname )) { array_push($errors, 'lastname is required');}
    if (empty($zip )) { array_push($errors, 'zip is required');}
    if (empty($city )) { array_push($errors, 'city is required');}
    if (empty($email )) { array_push($errors, 'email is required');}
    if (empty($phone )) { array_push($errors, 'phone is required');}
    if (empty($password )) { array_push($errors, 'password is required');}
    if ($password1 != $password2) {
        array_push($errors, "the passwords do not match");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = $db->query($user_check_query);

    if ($user){
        if ($user['username'] === $username) {
            array_push($errors, "username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    if (count($errors) == 0) { 
        $query = "INSERT INTO users (username, email, firstname, lastname, 
            zip, city, email, phone) VALUES('$username', '$email', '$firstname', 
            '$lastname', '$zip', '$city', '$email', '$phone')";
        $db->query($query);
        $useridget = "SELECT userid FROM users WHERE username ='$username";
        $userid = $db->query($useridget);
        $hash = hash("sha256", ($password + $userid));
        $query = "INSERT INTO users (password) VALUES ('$hash') Where username='$username'";
        $db->query($query);
    }
}
if ($db != null){
    $st = null;
    $db = null; // should kill the pdo object and connection
}
?>