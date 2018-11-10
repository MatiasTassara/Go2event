<?php
namespace dao;

use Model\Calendar as M_Calendar;
use Model\Artist as M_Artist;

/**
 *
 */
class ArtistsPerCalendar extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  function __construct(){

  }
  public function add($obj){

   

  }
  public function add($calendar, $artist){

    $sql = "INSERT INTO artists_x_calendar(id_calendar, id_artist) values (:id_calendar, :id_artist)";
    $parameters['id_calendar'] = $calendar->getId();
    $parameters['id_artist'] = $artist->getId();

    try{
      $this->connection = Connection::getInstance();
      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;
    }
  }
  


  public function retrieveByName($name){

   
  }
  public retrieveArtistsByIdCalendar($id_calendar){
    
    $sql= "SELECT a".".name_artist, a".".description"."FROM artists a INNER JOIN artists_x_calendar ac on 
    a.id_artist = ac.id_artist WHERE ac.id_calendar = :id_calendar";
    $parameters['id_calendar'] = $id_calendar;
    try{
      $this->connection = Connnection::getInstance();
      $response = $this->connection->execute($sql, $parameters);

    }catch(Exception $ex){
      throw $ex;
    }
    if(!empty($response)){

    }

  }


  public function retrieveById($id){

    $sql = "SELECT * from categories where id_category = :id_category";
    $parameters['id_category'] = $id;
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
  public function retrieveById($idCalendar, $idArtist){


  }
  
	
  public function getAll(){

    $sql = "SELECT * FROM categories order by name_category";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
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

      $resp = array_map(function($p){
        return new M_Category($p['name_category'], $p['id_category']);}, $value);

               return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];

  
}

  public function update($obj){
    $sql = "UPDATE categories SET name_category = :name_category where id_category = :id_category";
    $parameters['id_category'] = $obj->getId();
    $parameters['name_category'] = $obj->getName();
   
    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;
      
    }

  }

  public function delete($id){

    $sql = "DELETE from categories where id_category = :id_category";
    $parameters['id_category'] = $id;

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->executeNonQuery($sql, $parameters);
    }catch(Exception $ex){
      throw $ex;
    }



  }

  
}


 ?>