<?php
session_start();
require_once "db_config.php";
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <head>
  <link href="styles/style.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <title>ITI Assignment 1</title>
  </head>


  <body id="opgave">
    <h1 class="hidden"></h1>
	<div id="header">
	<div id="clock">		
	</div>
	<div id="menu">
		<ul>
			<li id="first">
				<a href="forside.php">Forside</a>
			</li>
			
			<li id="second">
				<a href="uploadbilleder.php">Upload billeder</a>
			</li>
			
			<li id="third">
				<a href="index.php">Log ud</a>
			</li>
			
		</ul>
	</div>	
	<div id="content">
	<div class="sidebar">
		<div class="head">
		<strong>Alle brugere</strong>
		</div>
	<?php
    if (isset($_POST["all_users"])) {
        require_once "db_config.php";
        $sql = "select username from user;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
         while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            ?>
            <tr>
                <td><?php echo $row[0] ?></td>
                <td><?php echo $row[1] ?></td>
                <td><?php echo $row[2] ?></td>
                <td><?php echo $row[3] ?></td>
                <td><?php echo $row[4] ?></td>
                <td><?php echo $row[5] ?></td>
                <td><?php echo $row[6] ?></td>
            </tr>
			            <?php
        }
    }
            ?>
		
	
	</div>
	
	<div class="maincolumn">
	<div class="head">
		<strong>Indlæg</strong>
		</div>
		<br>
		  <?php
		if (isset($_SESSION['user'])) {
        // fetch user's images
        $user_data = 'SELECT * FROM' . ' user ' . 'INNER JOIN images on user.id =images.id_user WHERE username="'
            . $_SESSION['user'] . '";';
        $stmt = $conn->prepare($user_data);
		$stmt->execute();
    }
    ?>
	<?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) { ?>
        <div class="images">
            <a target="_blank" href=  <?php print $row[13] ?>>
                <img class="img" src=  <?php print $row[13] ?>></a>
            <div class="header"><?php print $row[10] ?> <br> </div>
                <div class="description" >Your description:</div>
                <div class="text"><?php print $row[11] ?> </div>
                <form name="delete" method="post" action="delete.php">
                    <input type="hidden" name="image_path" value="<?php print($row[13])?>">
                    <button type='submit' value="Delete" class="delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>

         </div>
        <?php
    };
    ?>
	</div>
	
	</div>
	
	<div id="footer">
	<span>
	"Mipou16"
	</span>
	</div>
  </body>
</html>
