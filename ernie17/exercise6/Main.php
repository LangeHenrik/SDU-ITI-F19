<?php
    require_once('Car.php');

    $mazda = new Car("Mazda");
    $mazda->setLength(5);

    $ford = new Car("Ford");
    $ford->setLength(8);
    // print_r($mazda->getLength());

    $mazdaLength = $mazda->getLength();
    $fordLength = $ford->getLength();
    $lengthDifference = abs($mazdaLength-$fordLength);
    echo "Mazda has a length of $mazdaLength<br>";
    echo "Ford has a length if $fordLength<br>";
    echo "The difference in length is $lengthDifference";
 ?>
