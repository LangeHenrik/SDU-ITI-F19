<!DOCTYPE html>
<html>
    <head>
        <title>Userlist Page</title>
        <?php
            require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/views/partials/top.php';
            //include '../partials/top.php';
            $homecontroller = new HomeController();
            $_SESSION["disable_searchbar"] = true;
        ?>
    </head>
    <body>
        
    <br><br>
    <h2>Overview of all registered users:</h2>
    <?php 
    $usersarray = $homecontroller->showAllUsers();
        echo '<table border="1">
            <tr>
                <td><b>Username</b></td>
                <td><b>Phone number</b></td>
                <td><b>E-mail</b></td>
                <td><b>Zipcode</b></td>
            </tr>';
        foreach ($usersarray as $user) {
            echo '<tr>';
                echo '<td>'.$user[1].'</td>';
                echo '<td>'.$user[2].'</td>';
                echo '<td>'.$user[3].'</td>';
                echo '<td>'.$user[4].'</td>';
            echo '</tr>';
            
        }
        echo '</table>';
        include $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/views/partials/bot.php'; 


?>
    </body>
</html>