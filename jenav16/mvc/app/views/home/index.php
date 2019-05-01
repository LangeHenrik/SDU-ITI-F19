<!DOCTYPE html>
<html>
<head>
    <title>ITI 1.0</title>
    <meta charset="UTF-8"/>
    <link href="../../../CSS/main.css" rel="stylesheet">
</head>
<body>
<?php if (isloggedIn()) { ?>

<b>Hello <?php echo $viewbag['user']['firstName']?> </b>

    <form action="/jenav16/mvc/public/home/upload" enctype="multipart/form-data" id="fileForm" method="post">
        <b>Select image asset </b><br>
        <input name="file" required type="file"><br>
        Headline:<br>
        <input name="headline" placeholder="Headline" required type="text"><br>
        Text:<br>
        <input name="text" placeholder="Text" required type="text"><br>
        <br><input id="submitAssetButton" name="submitAsset" type="submit" value="Upload"><br><br>
    </form>


    <form action="/jenav16/mvc/public/home/allAssets" id="seeAllAssets" method="post">
        <input id="seeAllAssetsButton" name="seeAllAssets" type="submit" value="See all assets"><br><br>
    </form>



    <form action="/jenav16/mvc/public/home/users" id="usersForm" method="post">
        <input id="usersButton" name="users" type="submit" value="See all users"><br><br>
    </form>


    <b>Your uploads: </b>
<?php
    if ($viewbag['userAssets'] != null) {
        foreach ($viewbag['userAssets'] as $asset) {
            ?>
            <figure id="<?php echo $asset["fileID"]; ?>">
                <b>
                    <figcaption><?php echo $asset["headline"]; ?></figcaption>
                </b>
                <img src=<?php echo '../../../upload/' . $asset["fileID"]; ?>>
                <?php echo $asset["text"]; ?> <br>
                <?php if ($asset["username"] == $_SESSION["username"]) { ?>
                    <form action="/jenav16/mvc/public/home/delete" enctype="multipart/form-data" id="fileForm" method="post">
                        <input type="hidden" name=fileID value='<?php echo $asset["fileID"]; ?>'/>
                        <br><input id="deleteAssetButton" name="deleteAsset" type="submit"
                                   value="Delete <?php echo $asset["headline"]; ?>"><br>
                    </form>
                <?php } ?>
            </figure>
            <?php
        }
    }
?>



    <form action="/jenav16/mvc/public/home/logout" id="loginForm" method="post">
        <input id="logoutButton" name="logout" type="submit" value="Logout">
    </form>




<?php } else { ?>
    <form action="/jenav16/mvc/public/home/login" id="loginForm" method="post">
        <b>Login</b><br>
        Username<br>
        <input name="username" placeholder="Username" required type="text"><br>
        Password<br>
        <input name="password" placeholder="Password" required type="password"><br><br>
        <input id="loginButton" name="login" type="submit" value="Login"><br>
    </form>

    <form action="/jenav16/mvc/public/home/register" id="registerForm" method="post">
        <b>Not a user yet? Go register you silly fool</b><br>
        Username<br>
        <input name="username" placeholder="Username" required type="text"><br>
        Password<br>
        <input name="password" placeholder="Password" required type="password"><br>
        Re enter password<br>
        <input name="password2" placeholder="Re enter password" required type="password"><br>
        First name<br>
        <input name="firstName" placeholder="First name" required type="text"><br>
        Last name<br>
        <input name="lastName" placeholder="Last name" required type="text"><br>
        Zip<br>
        <input name="zip" placeholder="Zip" required type="text"><br>
        City<br>
        <input name="city" placeholder="City" required type="text"><br>
        Email address<br>
        <input name="emailAddress" placeholder="Email address" required type="text"><br>
        Phone number<br>
        <input name="phoneNumber" placeholder="Phone number" required type="text"><br>
        <br><input id="registerButton" name="register" type="submit" value="Register"><br>
    </form>
<?php }



function isloggedIn()
{
    return isset($_SESSION['username']);
}
?>
</body>
</html>