<?php

echo "<h1>Test</h1>";


$url = $_SERVER['REQUEST_URI'];



$functions = array(
    "multiply" => function($number, $multiplyBy = 2){return $number * $multiplyBy;},
    "add" => function($firstNumber, $secondNumber = 2){return $firstNumber + $secondNumber;},
    "subtract" => function($firstNumber, $secondNumber = 2){return $firstNumber - $secondNumber;},
    "sqrt" => function($number){return sqrt($number);},
    "power" => function($base, $exp = 2){return pow($base, $exp);});


foreach($functions as $function) {
   echo "<h1>{$function(5)}</h1>";
}


echo $_GET['link'];

if($url == '/multiply') {
    echo $functions['power'](5, 5);
}




