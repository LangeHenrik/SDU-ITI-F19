<?php


require 'ViewController.php';

$a = viewAllPosts();

// get the q parameter from URL
$q = $_REQUEST["search"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name[2], 0, $len))) {
            if ($hint === "") {
                $hint = $name[2];
            } else {
                $hint .= ", $name[2]";
            }
        }
    }
}



if ($hint === "") {
    echo "<div id=\"content\"><p style=\"color: red\">No match found..</p></div>";
} else {
    foreach ($a as $post) {
        if ($post[2] == $hint) {
            echo    '<div class="gallery">
            <img src="'.$post[4].'">
            <div class="header"><h2>'.$post[2].'</h2></div>
            <div class="desc">'.$post[3].'</div>
            </div>';
        }
        
    }
}



?>