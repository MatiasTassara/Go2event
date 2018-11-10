<?php
namespace dao;
use Model\SeatType as M_SeatType;
/**
 *
 */
class SeatTypeDb extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  function __construct(){

  }
  public function add($obj){

    $sql ="INSERT INTO seattypes (name_seattype, description) VALUES (:name_seattype, :description)";

    $parameters['name_seattype'] = $obj->getName();
    $parameters['description'] =$obj->getDescription();

    try{
      $this->connection = Connection::getInstance();

      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function retrieveByName($name){

    $sql = "SELECT * FROM seattypes where name_seattype = :name_seattype";
    $parameters['name_seattype'] = $name;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);

    }catch(Exception $ex){
      throw $ex;
    }
    if(!empty($response)){

      $result = $this->map($response);
      return array_shift($result);
    }else
       return false;


  }

  public function retrieveById($id){

    $sql = "SELECT * FROM seattypes where id_seattype = :id_seattype";
    $parameters['id_seattype'] = $id;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);

    }catch(Exception $ex){
      throw $ex;
    }
    if(!empty($response)){
      $result = $this->map($response);
      return array_shift($result);
    }
    else
      return null;

  }
  public function getAll(){

    $sql = "SELECT * FROM seattypes order by name_seattype";
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql);

    }catch(Exception $ex){
      throw $ex;
    }
    if(!empty($response)){
      return  $this->map($response);
          }
    else
      return null;

  }

  public function update($obj){

    $sql = "UPDATE seattypes SET name_seattype = :name_seattype, description = :description where id_seattype = :id_seattype ";
    $parameters['id_seattype'] = $obj->getId();
    $parameters['name_seattype'] = $obj->getName();
    $parameters['description'] = $obj->getDescription();

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->ExecuteNonQuery($sql, $parameters);

    }catch(\PDOException $ex){
      throw $ex;
    }



  }

  public function delete($id){

    $sql = "DELETE from seattypes where id_seattype =:id_seattype";
    $parameters['id_seattype'] = $id;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->executeNonQuery($sql,$parameters);
    }catch(Exception $ex){
      throw $ex;
    }

  }


  protected function map($value) {

      $value = is_array($value) ? $value : [];

      $resp = array_map(function($p){
        return new M_SeatType($p['name_seattype'], $p['description'], $p['id_seattype']);}, $value);

               return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];


}
}


 ?>
