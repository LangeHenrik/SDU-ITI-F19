<?php
    require_once('iCar.php');

    class Car implements iCar {
        private $length;
        private $brand;

        function __construct ($brand) {
            $this->brand = $brand;
        }

        public function getLength () {
            if (isset ($this->length)) {
                return $this->length;
            } else {
                return "Length is not set";
            }
        }

        public function setLength ($value) {
            $this->length = $value;
        }
    }
 ?>
