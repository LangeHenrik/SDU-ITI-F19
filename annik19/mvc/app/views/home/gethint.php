<?php
include_once(__DIR__."\\..\\..\\core\\Database.php");

$user = $this -> model('UserTable');
$result= $user -> select();

// the q parameter from URL
if (isset($_GET['q'])) {
    $q = $_GET["q"];
    $hint = "";

    if ($q != "") {
        $q = strtolower($q);
        $len = strlen($q);
        foreach ($result as $name) { // search the table and compare with the hint
            if (stristr($q, substr($name, 0, strlen($q)))) {
                if ($hint === "") {
                    $hint = $name;
                } else { // it is a substring so show the hint concatenated with the table element
                    $hint .= ", $name";
                }
            }
        }
    }

print $hint === "" ? "No suggestion" : $hint;
}