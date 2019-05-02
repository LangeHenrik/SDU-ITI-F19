<?php
namespace Car;

require_once('iCar.php');
require_once('Car.php');

$car1 = new Car(200, "mazda");
$car2 = new Car(100, "ford");

echo "Cars: " .($car1->getLength() - $car2->getLength());
?>
