<?php

    $page = 'register';
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

            <h3>Let's get you signed up!</h3>

            <form class="form" role="form" action="/signup" onsubmit="return validateForm(this)" method="post">
            <div class="form_element">
                <input type = "text" class = "form-control" name = "username" placeholder = "Username" onkeyup="validateInput(this)" required autofocus>
            </div>

            <div class="form_element">
                <input type = "password" class = "form-control" name = "password" placeholder = "Password" onkeyup="validateInput(this)" required>
            </div>

            <div class="form_element">
                <input type = "password" class = "form-control" name = "confirm_password" placeholder = "Repeat Password" onkeyup="validateInput(this)" required>
            </div>

            <div class="form_element">
                <input type = "text" class = "form-control" name = "firstname" placeholder = "First Name" onkeyup="validateInput(this)" required>
            </div>

            <div class="form_element">
                <input type = "text" class = "form-control" name = "lastname" placeholder = "Last Name" onkeyup="validateInput(this)" required>
            </div>

            <div class="form_element">
                <input type = "text" class = "form-control" name = "city" placeholder = "City" onkeyup="validateInput(this)" required>
            </div>

            <div class="form_element">
                <input type = "text" class = "form-control" name = "zip" placeholder = "Zip" onkeyup="validateInput(this)" required>
            </div>
            
            <div class="form_element">
                <input type = "text" class = "form-control" name = "email" placeholder = "Email" onkeyup="validateInput(this)" required>
            </div>

            <div class="form_element">
                <input type = "text" class = "form-control" name = "phone" placeholder = "Phone" onkeyup="validateInput(this)" required>
            </div>

            <button>Sign up</button>
            
        </form>

        </div>

    
    </div>


<?php

    Views\Core\Footer::view();

?>