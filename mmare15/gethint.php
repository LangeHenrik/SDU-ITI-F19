<?php
/**
 * Created by PhpStorm.
 * User: matiasmarek
 * Date: 21/03/2019
 * Time: 09.46
 */

//Array for ajax functionality, allowing for city suggestions.
$city[] = "Odense";
$city[] = "København";
$city[] = "Aarhus";
$city[] = "Aalborg";
$city[] = "Esbjerg";
$city[] = "Randers";
$city[] = "Kolding";
$city[] = "Horsens";
$city[] = "Vejle";
$city[] = "Roskilde";
$city[] = "Herning";
$city[] = "Hørsholm";
$city[] = "Helsingør";
$city[] = "Silkeborg";
$city[] = "Næstved";
$city[] = "Fredericia";
$city[] = "Viborg";
$city[] = "Køge";
$city[] = "Holstebro";
$city[] = "Taastrup";
$city[] = "Sønderborg";

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($city as $name) {
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


