<?php
/**
 *
 */

/**
 *
 */
/**
 *
 */
interface iCar
{
  public function getLenght();

  public function setLenght($newLenght);

  public function getBrand();
}







class Car implements iCar
{
  public $lenght, $brand;




  function __construct($l,$b){
    $this->lengt = $l;
    $this->brand = $b;
  }

  public function getLenght(){
    return $this->lengt;
  }

  public function setLenght($newLenght){
    $this->lenght = $newLenght;
  }
  public function getBrand(){
    return $this->brand;
  }



}

$c1 = new Car(4,"Ford");
$c2 = new Car(5,"Mazda");


echo "First car is a " . $c1->getBrand() . " with a lenght of " . $c1->getLenght();





 ?>
