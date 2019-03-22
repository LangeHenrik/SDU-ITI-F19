<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
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
                $("#pictureLoad").load("load-pictures.php", {
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
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome!</h1>
        <p>
            <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
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
    include 'config.php';
	$sql = "SELECT id, username, firstname, lastname, zip, city, email, phonenumber FROM users";
	$stmt1 = $link->prepare($sql);
	$stmt1->execute();
    //$result = $stmt1->fetchAll();
	if(/*$result-> num_rows > 0*/ true){ //DET HER SKAL FIKSES!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		while(/*$row = $result-> fetch_assoc()*/ $row = $stmt1->fetchAll(PDO::FETCH_ASSOC)){
            foreach($row as $data_values){
                $id = $data_values['id'];
                $username = $data_values['username'];
                $firstname = $data_values['firstname'];
                $lastname = $data_values['lastname'];
                $zip = $data_values['zip'];
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
        <main>
            <section class="gallery-links">
                <div class="wrapper">
                    <div class="gallery-container">
                        <h3>Upload pictures to gallery</h3>
                        <?php
                        echo '<div class="gallery-upload">
                        <form action="gallery_upload.php" method="POST" enctype="multipart/form-data">
                            <input type="text" name="filename" placeholder="File name here" class="form-control">
                            <input type="text" name="filetitle" placeholder="Image title here" class="form-control">
                            <input type="text" name="filedesc" placeholder="Image description here" class="form-control">
                            <input type="file" name="file"> 
                            <button type="submit" name="submit" class="btn btn-success">UPLOAD</button>
                        </form>
                    </div>';
                        ?>
                        <h2>Gallery</h2>
                        <?php
                        /*$sql = 'SELECT * FROM images ORDER BY imgorder DESC LIMIT 3;';
                        $stmt = mysqli_stmt_init($link3);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL statement failed 3";
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                <div class="gallerybox">
                                <h3>'.$row["title"].'</h3>
                                <img src="images/'.$row["imgName"].'">
                                <p>'.$row["imgdesc"].'</p>
                                </div>
                                <br>';
                            }
                        }*/
                        ?>
                        <div id="pictureLoad">
                        </div>
                        <br>
                        <button id="btn" class="btn btn-primary">Load pictures</button>
                        <br>
                    </div>
                </div>
            </section>
        </main>
	</div>
</body>
</html>