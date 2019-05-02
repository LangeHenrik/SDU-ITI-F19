<?php
include "../app/views/partials/header.php";
?>


<main>
    <div class="card">
    <h2>Signup</h2>
        <?php
            if (isset($_GET['error'])) {
                if ($_GET["error"] == "emptyfields") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                Fill in all the fields!
                            </div>';
                }
                else if ($_GET["error"] == "invalidmail") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                Invalid email address!
                            </div>';
                }
                else if ($_GET["error"] == "invaliduid") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                Invalid username!
                            </div>';
                }
                else if ($_GET["error"] == "passwordcheck") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                Passwords do not match!
                            </div>';
                }
                else if ($_GET["error"] == "invalidfirstname") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                Invalid first name!
                            </div>';
                }
                else if ($_GET["error"] == "invalidlastname") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                Invalid last name!
                            </div>';
                }
                else if ($_GET["error"] == "invalidzipcode") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                Invalid zip code!
                            </div>';
                }
                else if ($_GET["error"] == "invalidcity") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                Invalid city!
                            </div>';
                }
                else if ($_GET["error"] == "invalidphone") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                Invalid telephone number!
                            </div>';
                }
                else if ($_GET["error"] == "sqlerror") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                SQL ERROR!
                            </div>';
                }
                else if ($_GET['error'] == "usernametaken") {
                    echo '<div class="alert"onclick="this.style.display=\'none\';">
                                Username is already taken!
                            </div>';
                }
            }
        ?>
    <form class="signup" action="/sabah15/mvc/public/home/signup" method="post">
        <input type="text" name="uid" placeholder="Username">
        <input type="text" name="mail" placeholder="E-mail">
        <input type="password" name="pwd" placeholder="Password">
        <input type="password" name="pwd-repeat" placeholder="Repeat password">
        <p></p>
        <input type="text" name="firstname" placeholder="Firstname">
        <input type="text" name="lastname" placeholder="Lastname">
        <input type="number" name="zip" placeholder="Zip-Code">
        <input type="text" name="city" placeholder="City">
        <input type="tel" name="phone" placeholder="Telephone">

        <button type="submit" name="signup-submit">Signup</button>

    </form>
    </div>

</main>

<?php
include "../app/views/partials/footer.php";
?>
