<?php
namespace dao;

use Model\Artist as M_Artist;

/**
 *
 */
class ArtistDb extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  function __construct(){

  }
  public function add($obj){

    $sql ="INSERT INTO artists (name_artist, description) VALUES (:name_artist, :description)";

    $parameters['name_artist'] = $obj->getName();
    $parameters['description'] =$obj->getDesc();

    try{
      $this->connection = Connection::getInstance();

      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function retrieveByName($name){

    $sql = "SELECT * FROM artists where name_artist LIKE %:name_artist%";

               $parameters['name_artist'] = $name;

               try {
                    $this->connection = Connection::getInstance();
                    $response = $this->connection->execute($sql, $parameters);
               } catch(Exception $ex) {
                   throw $ex;
               }


               if(!empty($response)){

                $resul = $this->map($response);
                return array_shift($result);

               }
                    
                    
               else
                    return null;

  }


  public function retrieveById($id){

    $sql = "SELECT * from artists where id_artist = :id_artist";
    $parameters['id_artist'] = $id;
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

    $sql = "SELECT * FROM artists order by name_artist";
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

      $resp = array_map(function($p){
        return new M_Artist($p['name_artist'], $p['description'], $p['id_artist']);}, $value);

               
       return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];

  
}

  public function update($obj){
    $sql = "UPDATE artists SET name_artist = :name_artist, description = :description where id_artist = :id_artist";
    $parameters['id_artist'] = $obj->getId();
    $parameters['name_artist'] = $obj->getName();
    $parameters['description'] = $obj->getDesc();
    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;
      
    }

  }

  public function delete($id){

    $sql = "DELETE from artists where id_artist = :id_artist";
    $parameters['id_artist'] = $id;

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->executeNonQuery($sql, $parameters);
    }catch(Exception $ex){
      throw $ex;
    }



  }

  
}


 ?>
