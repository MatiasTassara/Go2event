<?php
namespace model;

class Category{

    private $id;
    private $name;

    public function __construct($name, $id = ""){
        $this->id = $id;
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
      $this->id = $id;
    }


}
