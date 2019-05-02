<?php

require_once ("../../Core/database.php");


class userModel extends Database
{


    public function showUser()
    {

        //Check if user is logged in
        if (isset($_SESSION['u_id'])) {
            echo "User list!";

            $query = $this->conn->query('SELECT * FROM users')->fetchAll();
            ?>
        <ul>
            <?php
            foreach ($query as $query) {
                ?>
                <li>
                    <?php
                    echo $query['username'];
                    ?>
                </li>
            <?php

        }
    }
}
}
