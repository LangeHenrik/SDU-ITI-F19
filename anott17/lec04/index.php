<form method="post">
  <input type="text" name="search">
  <input type="submit">
</form>


<table>
  <tr>
    <th>Book</th>
    <th>Author</th>
    <th>Publisher</th>
  </tr>
  <tr>
    <td>$</td>
    <td></td>
    <td></td>
  </tr>
</table>

<?php
  if (isset($_POST["search"])) {
    $searchInput = $_POST["search"];
    $result = "";

    require_once 'db_config.php';
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname",
      $username,
      $password,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

      $stmt = $conn->prepare("SELECT * FROM book_view WHERE Book = :search OR Author = :search OR Publisher = :search;");
      $stmt->bindparam(':search', $searchInput);

      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      print_r($result);

    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    $conn = null;

    if (!empty($result)) {}
}?>
