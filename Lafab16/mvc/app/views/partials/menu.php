<DOCTYPE html>

    <html>
    <head>
      <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name= viewport content="width= device-width, initial-scale=1">
        <title></title>
    </head>
    <body>

    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="../../../mvc/public/home/login ">Login</a></li>
                <li><a href="#">Pictues</a></li>
            </ul>
            <div>
                <?php
                if (isset($_SESSION['user_id'])){
                    echo '<form method="POST" action="../../../mvc/public/home/logout">
                    	<input type="submit">logout</input>
                    </form>';

                }else{
                    echo '<form method="POST" action="../../../mvc/public/home/login_submit">
                        <fieldset>
                            <legend style="font-weight: bold">Please log in here.</legend>
                            <input type="text" name= "username" placeholder="Username"/>
                            <input type="password" name= "password" placeholder="Password"/>
                            <button type="submit" name="login_submit"> Login </button>
                        </fieldset>
                    </form>
                    <a href="../../../mvc/public/home/signup"> Register</a>';

                }
                ?>

            </div>
        </nav>
    </header>
    </body>
    </html>


</DOCTYPE>
