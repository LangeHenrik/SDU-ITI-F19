<?php
// Array with names
$a[]="TheGarlicChair";
$a[]="Hamuki";
$a[]="WingWoman20";
$a[]="DarthCake";
$a[]="Crybaby";
$a[]="ZombieMan";
$a[]="Aragorn";
$a[]="BananaBoris";
$a[]="ElectricEigil";
$a[]="FroggyJohn";
$a[]="GlenTheGiraffe";
$a[]="HippoMan";
$a[]="Iglesias";
$a[]="JordbærDrengen";
$a[]="KnockoutBenny";

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
?>