<?php
namespace dao\db;

use Model\Event as M_Event;
use Dao\db\CategoryDb as CategoryDb;
use Dao\singletondao as SingletonDAO;
/**
*
*/
class EventDb extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  private $daoCategories;
  function __construct(){

    $this->daoCategories = CategoryDb::getInstance();

  }


  public function add($obj){

    $sql ="INSERT INTO events (name_event, description, img_path, id_category, active) VALUES (:name_event, :description, :img_path, :id_category, :active)";

    $parameters['name_event'] = $obj->getName();
    $parameters['description'] = $obj->getDesc();
    $parameters['img_path'] = $obj->getImgPath();
    $parameters['id_category'] =$obj->getCategory()->getId();
    $parameters['active'] = 1;


    try{
      $this->connection = Connection::getInstance();

      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function retrieveByName($name){

    $sql = "SELECT * FROM events where name_event LIKE %:name_event% and active = 1";

    $parameters['name_event'] = $name;

    try {
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);
    } catch(Exception $ex) {
      throw $ex;
    }


    if(!empty($response)){

      $result = $this->map($response);
      return array_shift($result);
    }

    else
    return null;

  }


  public function retrieveById($id){

    $sql = "SELECT * from events where id_event = :id_event and active = 1";
    $parameters['id_event'] = $id;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);

    }catch(Exception $ex){
      throw $ex;

    }if(!empty($response)){

      $result = $this->map($response);
      return array_shift($result);
    }

    else
    return null;



  }


  public function getAll(){

    $sql = "SELECT * FROM events WHERE active = 1 order by name_event";
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql);
    }catch(Exception $ex){
      throw $ex;
    }
    if(!empty($response))
    return $this->map($response);
    else
    return null;

  }

  public function getAllNonActive(){
    $sql = "SELECT * FROM events WHERE active = 2 ORDER BY name_event";
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql);
    }catch(Exception $ex){
      throw $ex;
    }
    if(!empty($response))
    return $this->map($response);
    else
    return null;
  }
  public function getEventsActAndNonAct(){
    $sql = "SELECT * FROM events ORDER BY name_event";
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql);
    }catch(Exception $ex){
      throw $ex;
    }
    if(!empty($response))
    return $this->map($response);
    else
    return null;
  }

  protected function map($value) {

    $value = is_array($value) ? $value : [];
    $arrayResponse = array();


    $resp = array_map(function($p){

      $category = $this->daoCategories->retrieveById($p['id_category']);

      return new M_Event($p['name_event'], $p['description'], $p['img_path'], $category, $p['id_event']);
    }, $value);

    return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];


  }

  public function update($obj){
    $sql = "UPDATE events SET name_event = :name_event, description = :description, img_path = :img_path, id_category = :id_category where id_event = :id_event";
    $parameters['id_event'] = $obj->getId();
    $parameters['name_event'] = $obj->getName();
    $parameters['description'] = $obj->getDesc();
    $parameters['img_path'] = $obj->getImgPath();
    $parameters['id_category'] = $obj->getCategory()->getId();
    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function delete($id){

    $sql = "UPDATE events SET active = :active where id_event = :id_event";
    $parameters['id_artist'] = $id;
    $parameters['active'] = 2;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->executeNonQuery($sql, $parameters);
    }catch(Exception $ex){
      throw $ex;
    }



  }


}


?>
