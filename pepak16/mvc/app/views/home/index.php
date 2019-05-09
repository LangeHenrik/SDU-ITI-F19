<!DOCTYPE html>
<html>
<head>
    <?php
        require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/views/partials/top.php';
        $homecontroller = new HomeController();
        
        // if ($_SESSION["logged_in"] == true) {
        //     echo 'logged in is trueeee';
        // } else {
        //     echo 'logged in is FALSE';
        // }
    ?>
    <title>Assignment 1 - Persha</title>

    

</head>

<body>
        <?php 
        // ALWAYS remember to use $_SERVER['DOCUMENT_ROOT'] when uploading files, 
        // since it works best this way! And for fetching pictures, 
        // just using ordinary slash url method, e.g. /app/uploads/....

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
                //chmod("uploads/", 755); 
                if(empty($errors)==true && $file_tmp != null) {
                    //$file_dest = "uploads/".$file_name;
                    $file_dest = $_SERVER['DOCUMENT_ROOT']."/pepak16/mvc/app/uploads/".$file_name;
                    move_uploaded_file($file_tmp,$file_dest);
                    // $file_dest = "uploads/".$file_name;
                    // echo $file_dest;
                    $file_dest = "uploads/".$file_name;
                    // if ($_SESSION["userid"] != null) {
                    //     $useridwithcomma = $_SESSION["userid"] + ",";
                    // }
                    $homecontroller->postAPicture($header,$desc,$file_dest,$_SESSION["userid"]);
                    $successtext = "Uploaded successfully!";
                    echo $_FILES["post_image"]["error"];
                } else {
                    $warningtext = "Something went wrong... </br><b>Error type:</b> ".$errors;
                }
            }
        ?>

        <div id="content">
        
            <br><br>
        <p>Post your picture here:</p>
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
        $controllerObject = new HomeController();
        $allPosts = $controllerObject->showAllPosts();

        // // AJAX
        // echo "<p style=\"color: white;\"><span id=\"txtHint\"></span></p>";
        
        // echo '<span id="defaultpage">';
        
        
        
        //if ($_POST['search'] == "") {
            foreach ($allPosts as $post) {
                $imagedir = '../../'.$post[4];
                echo    '<div class="gallery">
                        <img src="'.$imagedir.'">
                        <div class="header"><h2>'.$post[2].'</h2></div>
                        <div class="desc">'.$post[3].'</div>
                        </div>';
            }
            
        //}
        
        echo '</span>';

    ?> 
    


    </div>
        <?php 
        
        } else { 
            echo '</br></br><div id="content"><h2>For viewing/posting pictures, please login.</h2></div>';
        } 
        include '../app/views/partials/bot.php';
        ?>

    </body>
</html>