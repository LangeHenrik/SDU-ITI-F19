<?php

//session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: other");
    exit;
}

include_once (__DIR__ . '\..\..\..\app\core\Database.php');
$database = new Database();
$conn = $database->getConn();

$homeController = new HomeController();

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function(){
            var pictureCount = 0;
            $("#btn").click(function(){
                pictureCount = pictureCount + 5;
                $("#pictureLoad").load("load-pictures", {
                    pictureNewCount: pictureCount
                });
            });
        });
    </script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
		table { border-collapse: collapse; width: 100%; }
		th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        form{ display: inline-block }
        img{ max-height: 100%; max-width: 100%; object-fit: contain; }
        .gallerybox{ border-style: solid; max-width: 25%; margin: auto; border-radius: 5px}
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php  echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome!</h1>
        <p>
            <a href="logout" class="btn btn-danger">Sign Out of Your Account</a>
        </p>
    </div>
	<div>
	<h3>Users in database:</h3>
	
	<table>
		<tr>
			<th>Id</th>
			<th>Username</th>
			<th>First name</th>
			<th>Last name</th>
			<th>Zip code</th>
			<th>City</th>
			<th>Email</th>
			<th>Phone number</th>
		</tr>
	<?php

	$sql = "SELECT user_id, username, firstname, lastname, zipcode, city, email, phonenumber FROM users";
	$stmt1 = $conn->prepare($sql);
	$stmt1->execute();
	$row_count = $stmt1->fetchColumn();
	if($row_count > 0){
		while($row = $stmt1->fetchAll(PDO::FETCH_ASSOC)){

            foreach($row as $data_values){
                $id = $data_values['user_id'];
                $username = $data_values['username'];
                $firstname = $data_values['firstname'];
                $lastname = $data_values['lastname'];
                $zip = $data_values['zipcode'];
                $city = $data_values['city'];
                $email = $data_values['email'];
                $phonenumber = $data_values['phonenumber'];
                echo "<tr><td>$id</td>
                <td>$username</td>
                <td>$firstname</td>
                <td>$lastname</td>
                <td>$zip</td>
                <td>$city</td>
                <td>$email</td>
                <td>$phonenumber</td>
                </tr>";
            }
		}
		echo "</table>";
	}
	else {
		echo "0 result/s";
	}
	?>
	</table>
	</div>
	<br>
	<br>
	<div>
        <!--<main>-->
            <!--<section class="gallery-links">-->
                <div class="wrapper">
                    <div class="gallery-container">
                        <h3>Upload pictures to gallery</h3>
                        <?php
                        echo '<div class="gallery-upload">
                        <form action="gallery_upload"  method="POST" enctype="multipart/form-data">
                            <input type="text" name="filename" placeholder="File name here" class="form-control">
                            <input type="text" name="filetitle" placeholder="Image title here" class="form-control">
                            <input type="text" name="filedesc" placeholder="Image description here" class="form-control">
                            <input type="file" name="file"> 
                            <button type="submit" name="submit" class="btn btn-success">UPLOAD</button>
                        </form>
                    </div>';
                        ?>
                        <h2>Gallery</h2>
                        <div id="pictureLoad">
                        </div>
                        <br>
                        <button type="submit" action="load-pictures" id="btn" class="btn btn-primary">Load pictures</button>
                        <br>
                    </div>
                </div>
            <!--</section>-->
        <!--</main>-->
	</div>
</body>
</html>