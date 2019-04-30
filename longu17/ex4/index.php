<form method="post">
  <input type="text" name="searchbar">
  <input type="submit">
</form>


<?php

$dbhost = "127.0.0.1";
$dbname = "authors";
$dbuser = "root";
$dbpass = "";
  
  if (isset($_POST["searchbar"])) {
    $searchInput = $_POST["searchbar"];
    $respons = "";

    try {
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

      $stmt = $conn->prepare("SELECT * FROM book_view WHERE Book = :searchbar OR Author = :searchbar OR Country = :searchbar;");
      $stmt->bindparam(':searchbar', $searchInput);
      $stmt->execute();

      $response = $stmt->fetchAll();
        for($i = 0; $i  < (count($response)); $i++){
            $info = array_values($response)[$i];
                    
                    echo '<h2>Book </h2><p>' . $info['Book'] . '</p> ';
                    echo '<h2>Author </h2><p>' . $info['Author'] . '</p>';
                    echo '<h2>Country </h2><p>' . $info['Country'] . '</p>';
                    
        }
    } catch (PDOException $exception) {
      echo "Error: " . $exception->getMessage();
    }
    $conn = null;
}?>
