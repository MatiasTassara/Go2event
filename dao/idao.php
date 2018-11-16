<?php

namespace DAO;

interface IDAO
{
  public function add($obj);

  public function retrieve($obj);

  public function update($obj);

  public function delete($obj);
  
}


 ?>
