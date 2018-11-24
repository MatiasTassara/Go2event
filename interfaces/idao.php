<?php

namespace interfaces;

interface Idao{

  public function add($obj);

  public function retrieveByName($name);

  public function retrieveById($id);

  public function update($obj);

  public function delete($id);

  public function getAll();

}


 ?>
