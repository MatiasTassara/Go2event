<?php
namespace model;

class SeatType{

    private $id;
    private $name;
    private $description;


    function __construct($name,$desc,$id=''){
      $this->id = $id;
      $this->name = $name;
      $this->description = $desc;
    }

    public function getId(){
      return $this->id;
    }

    public function getName(){
      return $this->name;
    }
    public function getDescription(){

      return $this->description; 
    }
    public function setName($n){
      $this->name = $n;
    }
    public function setDescription($desc){

      $this->description = $desc;
    }
    public function setID($id){

      $this->id = $id;
    }


}


?>
