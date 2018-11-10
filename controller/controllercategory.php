<?php
namespace controller;

use Model\Category as M_Category;
use DAO\ListCategory as D_Category;
//use DAO\CategoryDb as D_Category;

class ControllerCategory{
  private $daoCategory;

  public function __construct(){

    $this->daoCategory = D_Category::getInstance();

  }

  public function index(){
    $categories = $this->daoCategory->getAll();
    include(ROOT.'views/categories.php');
  }

  public function addCategory($name){
    $objCategory = new M_Category($name);
    $this->daoCategory->add($objCategory);
    $this->index();
  }
  function modifyCategory($id,$name) {

    $obj = $this->daoCategory->retrieveById($id);

    $obj->setName($name);
   

    $this->daoCategory->update($obj);
    $this->index();
  }

  function deleteCategory($idCategory) {
    $this->daoCategory->delete($idCategory);
    $this->index();
  }
}
