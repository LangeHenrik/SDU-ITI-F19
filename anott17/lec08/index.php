<?php
  class User {
    public $userName;
    public $frontName;
    public $lastName;

    public function __construct($userName, $frontName, $lastName) {
      $this->userName = $userName;
      $this->frontName = $frontName;
      $this->lastName = $lastName;
    }


  }
  require_once 'db_config.php';
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $getUsersStmt = $conn->prepare("SELECT user_name, front_name, last_name FROM person");

    $getUsersStmt->execute();
    $getUsersStmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $getUsersStmt->fetchAll();

    $users = [];

    foreach ($result as $value) {
      $dbUserName = $value['user_name'];
      $dbFrontName = $value['front_name'];
      $dbLastName = $value['last_name'];
      $users[] = new User($dbUserName, $dbFrontName, $dbLastName);
    }

  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  $json = json_encode($users, JSON_PRETTY_PRINT);

  header('Content-Type:application/json');
  ini_set('display_errors', 1);

  echo $json;

  $conn = null;
?>
