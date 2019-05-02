<?php
namespace Car;
/**
 *
 */
class Car implements iCar
{
  private $length;
  private $name;

  function __construct($length, $name)
  {
    $this->length = $length;
    $this->name = $name;
  }

  public function getLength() {
    return $this->length;
  }

  public function setLength($newLength) {
   $this->length = $newLength;
  }

}


?>
