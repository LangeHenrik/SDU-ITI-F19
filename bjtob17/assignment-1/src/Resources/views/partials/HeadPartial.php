<?php

namespace Resources\views\partials;

use Services\Auth;

class HeadPartial
{
    public static function show($viewData)
    {
        $appTitle = $viewData["_app_title"];
        $pageTitle = $viewData["page_title"];
        echo <<<EOL
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="/Resources/css/style.css">
    <title>$pageTitle | $appTitle</title>
</head>
<body>
<div class="wrapper">
    <header class="main-head">
        <div class="left">
            <h1>$appTitle</h1>
        </div>
        <div class="right">
EOL;
            WeatherPartial::show();
            echo <<<EOL
        </div>

    </header>
    <nav class="main-nav">
EOL;
        if (Auth::isLoggedIn()) {
            echo '<div class="nav-user">';
            echo '<h3>Hello '.Auth::getLoggedinUsername().'</h3>';
            echo '</div>';
        }
        MenuPartial::show();
    echo '</nav>';


    }
}