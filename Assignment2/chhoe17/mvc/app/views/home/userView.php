<?php
include_once 'menu.php';
?>



<section class="main-container">
    <div class="main-wrapper">
        <h2>Users</h2>
        <?php
            //Check if user is logged in
        if (isset($_SESSION['u_id'])) {
            include ("../../controllers/UserController.php");
           
        ?>






        </ul>




        


        

        <?php

    }
    ?>
    </div>
</section>