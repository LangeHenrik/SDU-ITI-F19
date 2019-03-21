<?php

namespace Views\Core;

class Header{
    public static function view(string $activePage){
        if(!isset($_SESSION)){
            session_start();
        }
?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="../Resources/Style/style.css">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        </head>
        <body>
            <header id="header">
                <a href="/">
                    <div class="logo">
                    <img src="../assets/gfx/fire.gif">
                        PHOTOFYRE
                    </div>
                </a>
                <nav class="nav" id="nav">
                    <div class="nav_elements">
                        <a href="/">
                            <div class="nav_item <?php echo ($activePage == 'home') ? 'nav_item active' : '' ?>"> 
                                Home
                            </div>
                        </a>
                        <a href="/photos">
                            <div class="nav_item <?php echo ($activePage == 'photos') ? 'nav_item active' : '' ?>"> 
                                Photos
                            </div>
                        </a>
                        <a href="/users">
                            <div class="nav_item <?php echo ($activePage == 'users') ? 'nav_item active' : '' ?>"> 
                                Users
                            </div>
                        </a>
                        <?php if(!isset($_SESSION['username'])): ?>
                            <a href="/login" class="nav_user">
                                <div class="nav_item <?php echo ($activePage == 'login') ? 'nav_item active' : '' ?>"> 
                                    Log In
                                </div>
                            </a>
                            <a href="/signup" class="nav_user">
                                <div class="nav_item <?php echo ($activePage == 'register') ? 'nav_item active' : '' ?>"> 
                                    Sign Up
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['username'])): ?>
                            <a href="/upload" class="nav_user">
                                <div class="nav_item <?php echo ($activePage == 'upload') ? 'nav_item active' : '' ?>"> 
                                    Upload
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>

                <div onclick="nav()" class="burger">
                    <i class="material-icons">menu</i>
                </div>

                <?php if(!isset($_SESSION['username'])): ?>
                    <div class="login">
                        <a href="/login">
                            <button>Log In</button>
                        </a>

                        <a href="/signup">
                            <button>Sign Up</button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['username'])): ?>
                    <div class="upload">
                        <a href="/upload">
                            <button>Upload</button>
                        </a>
                    </div>
                    <div onclick="userMenu(this)" class="user">
                        <?php echo strtoupper($_SESSION["username"][0]); ?>
                        <div class="userMenu">
                            <ul>
                                <li>
                                    <?php echo $_SESSION["firstname"] . ' ' . $_SESSION["lastname"]; ?>
                                </li>
                                <li>
                                <?php echo $_SESSION["email"]; ?>
                                </li>
                                <li class="logout">
                                    <a href="/logout">
                                        Sign Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                



            </header>
<?php
    }
}
?>