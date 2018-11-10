<?php
namespace dao;

class ListCategory extends SingletonDAO implements \interfaces\idao{

  private $categories;



  public function __construct(){

      if(!isset($_SESSION['categories'])){
                $_SESSION['categories'] = array();

                $id = (isset($_SESSION['idsCategories'])) ? $_SESSION['idsCategories'] : 0;

                $_SESSION['idsCategories'] = $id;
        }
        $this->categories = $_SESSION['categories'];

    }

    public function add($obj){


   		$check = true;
   		$this->categories = $_SESSION['categories'];
   		foreach ($this->categories as $key => $value) {
   			if($value->getName() == $obj->getName()){
   					$check = false;
   	 		}
   		}

   		if($check){
        $id = $_SESSION['idsCategories'];
        $obj->setId(++$id);
        $_SESSION['idsCategories'] = $id;
        $this->categories[] = $obj;
        $_SESSION['categories'] = $this->categories;
   		}
   	}

    public function getAll()
    {
      $this->categories = $_SESSION['categories'];
      return $this->categories;
    }
    public function retrieveByName($name){

        $categoriesReturn = null;
        foreach ($this->categories as $key => $value) {
            if($name == $value->getName()){
                if($categoriesReturn == null){

                   $categoriesReturn = array();
                }

                $categoriesReturn[] = $value;
            }
        }
        return $categoriesReturn;
    }
    public function retrieveById($id){

        $categoryReturn = null;
        foreach ($this->categories as $key => $value) {
            if($id == $value->getId()){

                $categoryReturn = $value;
            }
        }
        return $categoryReturn;
    }
    public function update($obj)
    {

    }
    public function retrieve($obj)
    {

    }
    public function delete($obj)
    {

    }



}
