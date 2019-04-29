<?php
  require 'header.php';
 ?>

  <main>

    <?php
      if (isset($_SESSION['userId'])) { // do we have session variables avalable, then we are logged in
        echo '<div class="wrapperscale">
        	<article class="articlescaletop">
        	 <p>
        		<h1>Yes! You are logged in</h1>
        	</p>
        	</article>
        </div>';
      }
      else {
        echo '<div class="wrapperscale">
        	<article class="articlescaletop">
        	 <p>
        		<h1>Nix! You are not logged in.. Click the signup button in the top right corner to join!</h1>
        	</p>
        	</article>
        </div>';
      }

     ?>

  </main>

<!--This page is the index page ..
Only functionallity echo if the user is logged in og logged out.

The index_new.php have a breif into and the display of users.

The database connection is handled in Includes/dbh_inc.php

Functionallity of login and logout is handled in Includes/login_inc.php and Includes/logout_inc.php

The users are registered on the signup page, and saved in a database lafab16 table users

Uploaded images are saved in four different tables because there are four different uploadpages

The AJAX call is used for uploading the next four images..

RegEx call is used on the signup page to check if the username and password cronstrains are forfilled

The pages are somewhat responsive - look in the style.css 
-->
