<?php
function echoN($val)
{
    if (is_array($val)) {
        print_r($val);
    } else {
        echo str_replace("\n", "<br>", $val . "\n");
    }
}

function js($file)
{
    $offset = $_SERVER["route_offset"];
    return "<script src='$offset/$file'></script>";
}

function css($file)
{
    $offset = $_SERVER["route_offset"];
    return "<link href='$offset/$file' rel='stylesheet'>";
}
