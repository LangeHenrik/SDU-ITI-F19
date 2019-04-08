<?php
interface iCar{
	public function setBrand($brand);
	public function setLenght($lenght);
	public function getLenght();
	public function getBrand();
}
class Car {
	private $brand;
	private $lenght;
	public function setBrand($brand) {
		$this->brand = $brand;
	}
	public function setLenght($lenght) {
		$this->lenght = $lenght;
	}
	public function getLenght() {
		return $this->lenght;
	}
} 
$ford = new Car;
$hyundai = new Car;

$ford->setBrand('ford');
$hyundai->setBrand('hyundai');

$ford->setLenght(10);
$hyundai->setLenght(55);


echo $ford->getLenght();
echo "<br>";
echo $hyundai->getLenght();


?>