<!DOCTYPE html>
<html>
    <head>
        <title>Login page</title>
        <?php
            require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/views/partials/top.php';
            $homecontroller = new HomeController();
        ?>
        <script src="../../services/AjaxSearchbar.js"></script>
    </head>
    <body>
        <div id="content">
            <br><br>
            <p>Type <b>the title</b> of a picture here to search for it automatically:</p>
            <input type="text" name="search" id="search" onkeyup="showHint(this.value)" placeholder="Search for a picture">
            <p>In order to search, you need to type the first letter of the title. <br/><br/>There is no difference between upper/lower case letters.</p>
        </div>
            <?php 
                // AJAX attributes
                echo "<p style=\"color: white;\"><span id=\"txtHint\"></span></p>";
                echo '<span id="defaultpage">';
            ?>
       
    </body>
</html>