

<!--DOCTYPE_HTML-->
<html>
<head>
 
    
</head>    
    
<body>    

    
    
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/todah16/mvc/public/home/other">Dankify</a>
    </div>
    <ul class="nav navbar-nav">
     
      
   

       <?php
    if(isset($_SESSION['user_name'])){
   /*     
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/todah16/mvc/public/home/other">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/todah16/mvc/public/home/myImages/'.htmlentities($_SESSION['user_name']).'">My images</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
</nav>';    
        
        
       echo ' <div class="navbar-nav">';
        echo   '<li><a class "nav-item nav-link active" href="/todah16/mvc/public/home/myImages/'.htmlentities($_SESSION['user_name']).'">My images</a></li>';
        echo '</div>';
        
        echo   '<form name="logout_form" action="/todah16/mvc/public/service/logout" method="post">  
        <button id="logout" type="submit" name="logout">Logout</button>
        
        </form>';
    } 
    
    
    
    
    
    */
        echo '<li><a href="/todah16/mvc/public/home/myImages/'.htmlentities($_SESSION['user_name']).'">My images</a></li>';
        echo   '<form class="navbar-form navbar-left" name="logout_form" action="/todah16/mvc/public/service/logout" method="post">  
        <button class="btn btn-default" id="logout" type="submit" name="logout">Logout</button>
        
        </form>';
    }
        else {
        echo '<li><a href="login">Login</a></li>';
        echo '<li><a href="register">Register</a></li>';
    }
    ?>
     </ul>
  </div>
</nav>
 
    
</body>
</html>
