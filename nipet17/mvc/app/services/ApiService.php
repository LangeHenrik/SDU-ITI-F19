<?php

class ApiService {

    public $username;
    public $id;
    public $image;
    public $title;
    public $description;


    public collectUsers() {
      $users = array();
      $data = 
    }

}


class Person {
public $name;
public $age;
public $possessions = [];
public function __construct($name, $age, $possessions) {
  $this->name = $name;
  $this->age = $age;
  $this->possessions = $possessions;
}
}
$jack = new Person("Jack", 32, ["Mercedes", "Toyota"]);
$jill = new Person("Jill", 29, []);
$people = [$jack, $jill];
$json = json_encode($people, JSON_PRETTY_PRINT);
header('Content-Type: application/json');
echo $json;
