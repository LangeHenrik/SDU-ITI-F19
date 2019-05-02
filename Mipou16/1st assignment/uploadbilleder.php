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
	das
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
			            
        }
    }
            
	
	</div>
	
	<div class="maincolumn">
	<div class="head">
		<strong>Upload billeder</strong>
		</div>
	<form id="upload" align="center" action="upload.php" method="post" enctype="multipart/form-data">
		<div>
		 <textarea 
      	id="text" 
      	cols="40" 
      	rows="1" 
      	name="image_title" 
      	placeholder="Billed titel"></textarea>
		</div>
		 Vælg billede:
		<input type="file" onchange="readURL(this)"name="fileToUpload" id="fileToUpload">
		<br>
		<img id="blah" src="#" alt="your image" />
		<br>
		<div>
		 <textarea 
      	id="text" 
      	cols="40" 
      	rows="6" 
      	name="image_text" 
      	placeholder="sig noget om dette billede...."></textarea>
		</div>
		<input type="submit" value="Upload Image" name="submit">
	</form>
	</div>
	
	</div>
	
	<div id="footer">
	<span>
	"Mipou16"
	</span>
	</div>
				
	
	
	
  </body>
</html>
