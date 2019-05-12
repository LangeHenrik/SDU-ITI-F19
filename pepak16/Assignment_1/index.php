<!DOCTYPE html>
<html>
<head>
    <title>Assignment 1 - Persha</title> 

    <script type="text/javascript">
    function showHint(str) {
        if (str.length == 0) { 
            document.getElementById("txtHint").innerHTML = "";
            document.getElementById("defaultpage").innerHTML = "<?php 
            foreach ($allPosts as $post) {
                echo    '<div class="gallery">
                        <img src="'.$post[4].'">
                        <div class="header"><h2>'.$post[2].'</h2></div>
                        <div class="desc">'.$post[3].'</div>
                        </div>';
            } ?>";
            document.getElementById("txtHint").innerHTML = "<div id=\"content\">Please refresh page to view all content again.</div>";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                    document.getElementById("defaultpage").innerHTML = "";
                    
                }
            }
            xmlhttp.open("GET", "getSearchResults.php?search="+str, true);
            xmlhttp.send();
           
        }
    }
    </script>

</head>
    <body>
        <?php include 'top.php'; 
        $successtext = "";
        $warningtext = "";
        $imageset = $_FILES['image'];
        $header = $_POST['header'];
        $desc = $_POST['description'];
        $submietset = $_POST['submit'];

        if ($_SESSION["logged_in"] == true) {
            if(isset($imageset)){
                $errors= array();
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                
                if(empty($errors)==true && $file_tmp != null) {
                    $file_dest = "uploads/".$file_name;
                    move_uploaded_file($file_tmp,$file_dest);
                    postAPicture($header,$desc,$file_dest);
                    $successtext = "Uploaded successfully!";
                } else {
                    $warningtext = "Something went wrong... </br><b>Error type:</b> ".$errors;
                }
            }
        ?>

        <div id="content">
        
            <br><br>
        <p>Create a post here:</p>
        <form action = "" method = "POST" enctype = "multipart/form-data">
                <input type="text" name="header" id="header" placeholder="Title"/> 
                <br>
                <br>
                <textarea rows="6" cols="30" type="text" name="description" id="description" placeholder="Description"></textarea>
                <br>
                <br>
            <input style="color: white;"  type = "file" name = "image"/>
            <br>
            <br>
        <input type = "submit" value = "Submit" />
        </form>

        <br>
        <?php 
            echo '<span style="color: green;">'.$successtext.'</span>'; 
            echo '<span style="color: red;">'.$warningtext.'</span>'; 
        ?>
        <br>
    </div>
    <div id="posts">


    <?php 
        //include 'bottom.php'; 
        $allPosts = viewAllPosts();

        // AJAX
        echo "<p style=\"color: white;\"><span id=\"txtHint\"></span></p>";
        
        echo '<span id="defaultpage">';
            
        
        
        
        if ($_POST['search'] == "") {
            foreach ($allPosts as $post) {
                echo    '<div class="gallery">
                        <img src="'.$post[4].'">
                        <div class="header"><h2>'.$post[2].'</h2></div>
                        <div class="desc">'.$post[3].'</div>
                        </div>';
            }
        }
        
        echo '</span>';

    ?> 
    


    </div>
        <?php } else { 
            echo '</br></br><div id="content"><h2>For viewing/posting pictures, please login.</h2></div>';
        } ?>
    
    </body>
</html>