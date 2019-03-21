<?php

    $page = 'login';
    Views\Core\Header::view($page);

?>

    <div class="content decorated">
        
        <div class="form_outer">

            <?php if(isset($data["errmsg"])):  ?>
                <div class="err_container">
                    <p>Please check your information for errors:</p><ul>
                    <?php foreach ($data["errmsg"] as $errmsg): ?>
                        <li><?= $errmsg ?></li>
                    <?php endforeach; ?>
                </ul></div>
            <?php endif; ?>
            
            <h3>Please log in to continue</h3>

            <form class="form" role="form" action="/login" method="post">
            <div class="form_element">
                <input type = "text" class = "form-control" name = "username" placeholder = "Username" required autofocus>
            </div>

            <div class="form_element">
                <input type = "password" class = "form-control" name = "password" placeholder = "Password" required>
            </div>
            
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
            </form>

        </div>

    
    </div>


<?php

Views\Core\Footer::view();

?>