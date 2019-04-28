<?php
require_once(__DIR__ . '/../Model/userDAO.php');


if (isset($_SESSION['user_id'])) {
    header("Location: /madre10/");
}
require_once(__DIR__ . '/../Model/userDAO.php');
$message = '';


if (isset($_POST['email'])) {
    $all_fields_completed = true;
    $any_fields_completed = false;
    $fields = ['username', 'email', 'firstname', 'lastname', 'zip', 'city', 'phone'];
//Perhaps additional checks here...
    $user = [];
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $all_fields_completed = false;
        } else {
            $any_fields_completed = true;
        }
        //Sanitize...
        $user[$field] = htmlentities($_POST[$field]);
    }

    if ($all_fields_completed && $_POST['password'] !== $_POST['password_repeat']) {
        $message = "Password does not match!";
        $all_fields_completed = false;
    }


    if ($all_fields_completed):
        $hashed_pw = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user['password'] = $hashed_pw;
        $response = createUser($user);
        if ($response) {
            $message = "User successfully created. You can now login.";
        } else {
            $message = "Oh lord, something went wrong";
        }

    elseif ($any_fields_completed && $message == ''):
        $message = "You have to fill out all the fields";
    endif;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="/madre10/CSS/main.css">
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/madre10/CSS/register.css">
</head>
<body>
<?php include(__DIR__ . '/Components/NavigationBar.php'); ?>
<?php if (!empty($message)): ?>
    <div class="alert_message"><?= $message ?></div>
<?php endif; ?>

<div class="register_wrapper">
    <div class="register_box">
        <h1 class="register_title">Register</h1>
        <form class="form" id="register_form" action="register" method="POST" onsubmit="return validateInput()">
            <div class="form__group">
                <input type="text" placeholder="Username" class="form__input" name="username"/>
            </div>

            <div class="form__group">
                <input type="email" id="input_email" placeholder="Email" class="form__input" name="email"/>
            </div>

            <div class="form__group">
                <input type="text" placeholder="First name" class="form__input" name="firstname"/>
            </div>

            <div class="form__group">
                <input type="text" placeholder="Last name" class="form__input" name="lastname"/>
            </div>

            <div class="form__group">
                <input type="text" placeholder="Zip code" class="form__input" name="zip"/>
            </div>

            <div class="form__group">
                <input type="text" placeholder="City" class="form__input" name="city"/>
            </div>

            <div class="form__group">
                <input type="text" placeholder="Phone number" class="form__input" name="phone"/>
            </div>

            <div class="form__group">
                <input type="password" placeholder="Password" class="form__input" name="password"/>
            </div>

            <div class="form__group">
                <input type="password" placeholder="Repeat Password" class="form__input" name="password_repeat"/>
            </div>

            <button class="btn" type="submit">Register</button>
        </form>
    </div>
</div>

</body>

<script>

    function validateInput() {

        let validated = true;

        let form = document.getElementById("register_form");
        removeSpans(form);

        try {

            let username = form["username"]
            if (!validateUsername(username.value)) {
                validated = false;
                appendMessage(username, "Username must be between 3-15 characters.")
            }

            let email = form["email"];
            if(!validateEmail(email.value)){
                validated=false;
                appendMessage(email, "That doesn't look correct..")
            }




            let firstname = form["firstname"];
            if (!validateName(firstname.value)) {
                validated = false;
                appendMessage(firstname, "That dosen't look like a firstname..");
            }

            let lastname = form["lastname"];
            if (!validateName(lastname.value)) {
                validated = false;
                appendMessage(lastname, "That dosen't look like a lastname..");
            }

            let zip = form["zip"];
            if (!validateZip(zip.value)) {
                validated = false;
                appendMessage(zip, "Not a valid danish zipcode");
            }

            let city = form["city"];
            if (!validateCity(city.value)) {
                validated = false;
                appendMessage(city, "Is that really a city?");
            }

            let phone = form["phone"];
            if (!validatePhone(phone.value)) {
                validated = false;
                appendMessage(phone, "A danish phone number is 8 digits");
            }

            let password = form["password"];
            let password_repeat = form["password_repeat"];
            if(password.value != password_repeat.value){
                validated=false;
                appendMessage(password,"Passwords are not equal..")
            } else if (!validatePassword(password.value)){
                validated = false;
                appendMessage(password, "Minimum 5 characters and no spaces..")
            }




        } catch (e) {
            console.log(e)
        }

        return validated;
    }

    function appendMessage(element, msg) {
        let spanEl = document.createElement("span");
        spanEl.className = "validation_message";
        let textEl = document.createTextNode(msg);
        spanEl.appendChild(textEl);
        element.parentNode.appendChild(spanEl);
    }

    function validateEmail(email){
        let re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return re.test(email)
    }

    function validateUsername(username) {
        let re = /^[a-z0-9_-]{3,15}$/;
        return re.test(username);
    }

    function validateZip(zip) {
        let re = /^\d{4}$/;
        return re.test(zip);
    }

    function validateName(name) {
        let re = /^(?:[a-zA-Z]+)$/;
        return re.test(name);
    }

    function validateCity(city) {
        let re = /^[\a-zA-ZÆØÅæøå.\s]+$/;
        return re.test(city);
    }

    function validatePhone(number){
        let re = /^[2-9]\d{7}$/;
        return re.test(number);
    }

    //Minimum 5 characters and no spaces. Everything else goes
    function validatePassword(pwd){
        let re = /^\S{5,}$/
        return re.test(pwd);
    }

    function removeSpans(form){
        const spans = form.getElementsByTagName("span");
        let i = spans.length;
        while (i--) {
            spans[i].parentNode.removeChild(spans[i]);
        }

    }

</script>
</html>