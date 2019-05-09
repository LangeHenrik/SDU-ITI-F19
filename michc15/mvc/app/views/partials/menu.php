<?php include 'header.php'; ?>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3b5998;" >
  <div class="container">
  <i class="fa fa-facebook-official fa-2x mr-2"style="color:#DDDDDD;"></i>
      <a class="navbar-brand" href="<">Bacefook<a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" id='index_link' href="/michc15/mvc/public/">Home</a>
          </li>
		  <?php
		  if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
			?>
          <li class="nav-item">
            <a class="nav-link" href="/michc15/mvc/public/Posts">Posts</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/michc15/mvc/public/Upload">Upload</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="/michc15/mvc/public/Users">Users</a>
            </li>     
            <li class="nav-item">
              <a class="nav-link" href="/michc15/mvc/public/Home/logout" method="post" class="login_logout">Logout</a>
            </li>   
			<?php
		} else {
      ?>
      <li class="nav-item">
      <a class="nav-link" id='login_link' href="/michc15/mvc/public/login">Login</a>
    </li>
      <li class="nav-item">
     <a class="nav-link" id='register_link' href="/michc15/mvc/public/register">Register</a>
    </li>
    <?php
    }
     ?>
		</ul>
		</div>
    </div>
	</nav>
	<?php require 'footer.php'; ?>







