<?php

/**
 * The iCar class
 */
/**
 *
 */
interface iCar
{
    public function getLength();

    public function setLength($newlength);
}


class Car implements iCar
{

  function __construct($length, $brand){
    $this->length = $length;
    $this->brand = $brand;
  }
  public function getLength(){
    return $this->length;
  }

  public function setLength($newlength){
    return $length = $newlength;
  }
}

$carr = new Car(4, "Ford");

echo 'The length of the car is: '.$carr->getLength().'<br>';
echo 'Now we change the car length to 6 <br>';
echo 'The length of the car is now: '.$carr->setLength(6).'<br>';
?>
