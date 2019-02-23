<?php

namespace Resources\views\partials;
use Services\Auth;

class MenuPartial
{
    private static $topUrls = [
        ["Home", "/"],
        ["Photos", "/photos"],
    ];

    public static function show()
    {
        $h = "<ul><div class='first'>";
        foreach(MenuPartial::$topUrls as $url) {
            $h = $h . '<li><a class="'.MenuPartial::isActive($url[1]).'" href="'.$url[1].'">'.$url[0].'</a></li>';
        }
        $h = $h . '<li><a class="'.MenuPartial::isActive('/profile').'" href="/profile">Profile</a></li>';
        $h = $h . "</div>";

        $h = $h . "<div class='last'>";
        if (Auth::isLoggedIn()) {
            $h = $h . '<li><a href="/logout">Logout</a></li>';
        } else {
            $h = $h . '<li><a class="'.MenuPartial::isActive('/login').'" href="/login">Login</a></li>';
            $h = $h . '<li><a class="'.MenuPartial::isActive('/register').'" href="/register">Register</a></li>';
        }
        $h = $h . "</div></ul>";

        echo $h;
    }

    private static function isActive($url): string
    {
        return $_SERVER["REQUEST_URI"] === $url ? "is-active" : "";
    }
}

