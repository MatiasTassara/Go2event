<?php
namespace model;

class Venue{

    private $id;
    private $name;
    private $address;
    private $city;
    private $capacityLimit;
    

    public function __construct($name,$address,$city,$capacityLimit,$id = ""){
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->capacityLimit = $capacityLimit;
       
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getCity(){
        return $this->city;
    }
    public function getCapacityLimit(){
        return $this->capacityLimit;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setAddress($address){
        $this->address = $address;
    }
    public function setCity($city){
        $this->city = $city;
    }
    public function setCapacityLimit($capacityLimit){
        $this->capacityLimit = $capacityLimit;
    }
   

}


?>
