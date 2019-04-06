<?php
function echoN($val)
{
    if (is_array($val)) {
        print_r($val);
    } else {
        echo str_replace("\n", "<br>", $val . "\n");
    }
}
