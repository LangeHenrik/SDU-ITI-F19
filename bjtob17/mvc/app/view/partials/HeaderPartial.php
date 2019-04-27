<?php


namespace app\view\partials;


use app\util\AuthUtil;

class HeaderPartial
{
    public static function show(array $viewBag)
    {
        $pageTitle = $viewBag["page_title"];
        $myCss = css("css/style.css");
        $bulmaCss = css("css/bulma.min.css");
        $myJs = js("js/js.js");
        $logo = img("img/logo.png", "logo image");
        $pathRoot = $_SERVER["route_offset"];
        echo <<<EOL
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    $myCss
    $bulmaCss
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous"
    />
    $myJs
    <title>$pageTitle | MVC Assignment</title>
</head>
<body>
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
   <a class="navbar-item" href="https://bulma.io">
      $logo
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a href="$pathRoot/" class="navbar-item">
        Home
      </a>
      
      <a href="$pathRoot/pictures" class="navbar-item">
        Images
      </a>

      <a href="$pathRoot/users" class="navbar-item">
        Users
      </a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
EOL;
        if (!AuthUtil::isLoggedIn()) {
            echo <<<EOL
        <div class="buttons">
          <a href="$pathRoot/register" class="button is-primary">
            <strong>Sign up</strong>
          </a>
          <a href="$pathRoot/login" class="button is-light">
            Log in
          </a>
        </div>
EOL;
        } else {
            echo <<<EOL
        <div class="buttons">
            <a href="$pathRoot/profile" class="button is-light">Profile</a>
            <form action="$pathRoot/logout" method="post">
                <button class="button is-light">Logout</button>
            </form>
        </div>
EOL;
        }
        echo <<<EOL
      </div>
    </div>
  </div>
</nav>
<div class="container">
EOL;
    }

}