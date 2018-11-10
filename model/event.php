<?php
namespace Model;

class Event{
  private $id;
  private $name;
  private $imgPath;
  private $category;
  private $description;

  function __construct($name,$description,$Path,$category, $id = '') {
    $this->id = $id;
    $this->name = $name;
    $this->Path = $Path;
    $this->category = $category;
    $this->description = $description;

  }
  public function getId(){
    return $this->id;
  }

  public function getName(){
    return $this->name;
  }
  public function getImgPath(){
    return $this->imgPath;
  }
  public function getCategory(){
    return $this->category;
  }
  public function getDesc(){
    return $this->description;
  }
  public function setId($id){
    $this->id = $id;
  }
  public function setName($name){
    $this->name = $name;
  }
  public function setImgPath($Path){
    $this->Path = $imgPath;
  }
  public function setCategory($category){
    $this->category = $categoory;
  }
  public function setDesc($description){
    $this->description = $description;
  }


}




 ?>
