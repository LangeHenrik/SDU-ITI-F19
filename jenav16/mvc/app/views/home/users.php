<?php

if(isloggedIn()) {

    for ($i = 0; $i < count($viewbag); $i++) {
        echo $viewbag[$i];
    }
    echo "<button onclick='window.history.back()'>Go back</button>";
}

function isloggedIn()
{
    return isset($_SESSION['username']);
}