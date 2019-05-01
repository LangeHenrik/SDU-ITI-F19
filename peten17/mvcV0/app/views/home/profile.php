<div class="content">
      <div class="usernameTag">
        <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
      </div>
      <div class="userInfo">
        <p>Name: <?php echo htmlspecialchars($_SESSION["firstname"]) .' '. htmlspecialchars($_SESSION["lastname"]); ?></p>
        <p>Email: <?php echo htmlspecialchars($_SESSION["email"]); ?></p>
        <p>City: <?php echo htmlspecialchars($_SESSION["city"]); ?></p>
        <p>Zipcode: <?php echo htmlspecialchars($_SESSION["zipcode"]); ?></p>
        <p>Phonenumber: <?php echo htmlspecialchars($_SESSION["phonenumber"]); ?></p>
      </div>

    </div>
    