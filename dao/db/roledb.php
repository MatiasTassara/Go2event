<?php
namespace dao\db;

use Dao\Singletondao as SingletonDAO;
use Model\Role as M_Role;
/**
*
*/
class RoleDb extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  function __construct(){

  }

  public function add($name){

    $sql ="INSERT INTO roles (name_role) VALUES (:name_role)";

    $parameters['name_rol'] = $name;
    
    try{
      $this->connection = Connection::getInstance();

      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
       $ex->getMessage();

    }

  }

  public function retrieveByName($name){

    $sql = "SELECT * FROM roles where name_role = :name_role";

    $parameters['name_role'] = $name;

    try {
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);
    } catch(Exception $ex) {
       $ex->getMessage();
    }
   if(!empty($response)){

      $result = $this->map($response);
      return array_shift($result);

    }


    else
    return null;
   

  }



  



  public function retrieveById($id){

    $sql = "SELECT * from roles where id_role = :id_role";
    $parameters['id_role'] = $id;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);

    }catch(Exception $ex){
       $ex->getMessage();

    }

    if(!empty($response)){

      $result = $this->map($response);
      return array_shift($result);
    }


    else
    return null;



  }


  public function getAll(){

    $sql = "SELECT * FROM roles";
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql);

    }catch(Exception $ex){
       $ex->getMessage();
    }

    if(!empty($response))
    return $this->map($response);
    else
    return null;

  }
 

protected function map($value) {

  $value = is_array($value) ? $value : [];

  $resp = array_map(function($p){
    return new M_Role($p['name_role'], $p['id_role']);}, $value);


    return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];


  }


  public function update($obj){
    $sql = "UPDATE roles SET name_role = :name_role where id_role = :id_role";
    $parameters['id_role'] = $obj->getId();
    $parameters['name_role'] = $obj->getName();
    
    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
       $ex->getMessage();

    }

  }


  public function delete($id){

    $sql = "DELETE from roles where id_role = :id_role";
    $parameters['id_role'] = $id;

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->executeNonQuery($sql, $parameters);
    }catch(Exception $ex){
       $ex->getMessage();
    }



  }


}


?>
