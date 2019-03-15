<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
     integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
     crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="sign-action.js"></script>
    <title>Project A01</title>
</head>
<body>
    <div class="container">
        <header class="main-header">
            <h1>Project A01</h1>
        </header>
        <div class="sign-content">
            <div id="register">
                <form action="register.php" method="POST">
                    <div class="input">
                        <label for="email">Email</label>
                        <input type="email" name="email" />
                        <label for="password">Password</label>
                        <input type="password" name="password" />
                    </div>
                    <div class="filler"></div>
                    <div class="button-container"><button type="submit">Register!</button></div>
                    <div class="sign-toggle"><span>Already a user? <a href="javascript:toggle()">Login!</a></span></div>
                </form>
            </div>
            <div id="login" class="hidden">
                <form action="login.php" method="POST">
                    <div class="input">
                        <label for="email">Email</label>
                        <input type="email" name="email" />
                        <label for="password">Password</label>
                        <input type="password" name="password" />
                    </div>
                    <div class="filler"></div>
                    <div class="button-container"><button type="submit">Login!</button></div>
                    <div class="sign-toggle"><span>Not a member? <a href="javascript:toggle()">Register!</a></span></div>
                </form>
            </div>
        </div>
        <footer class="main-footer">
            <div class="footer-aboutus">
                <h3>About Us</h3>
                <ul>
                    <li><a href="#">Category 1, 1</a></li>
                    <li><a href="#">Category 1, 2</a></li>
                    <li><a href="#">Category 1, 3</a></li>
                    <li><a href="#">Category 1, 4</a></li>
                </ul>
            </div>
            <div class="footer-usefullinks">
                <h3>Useful Links</h3>
                <ul>
                    <li><a href="#">Category 2, 1</a></li>
                    <li><a href="#">Category 2, 2</a></li>
                    <li><a href="#">Category 2, 3</a></li>
                    <li><a href="#">Category 2, 4</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Contact</h3>
                <div>
                    <div>+45 88 88 88 88</div>
                    <br>
                    <div>web@teknologi.com</div>
                    <br>
                    <div>
                        Localhost <br>
                        The Internet <br>
                        The Earth
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>