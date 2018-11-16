<?php
namespace dao;

use Model\User as M_User;

/**
*
*/
class AdminDb extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  function __construct(){

  }

  public function add($obj){

    $sql ="INSERT INTO admins (email, name, surname, pass, is_admin) VALUES (:email, :name, :surname, :pass, :is_admin)";

    $parameters['email'] = $obj->getMail();
    $parameters['name'] =$obj->getName();
    $parameters['surname'] =$obj->getSurname();
    $parameters['pass']= $obj->getPass();
    $parameters['is_admin'] = $obj->getIsAdmin();

    try{
      $this->connection = Connection::getInstance();

      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }


  public function retrieveByName($name){

    $sql = "SELECT * FROM admins where name LIKE %:name%";

    $parameters['name'] = $name;

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

  public function retrieveByEmail($email){
    $sql = "SELECT * FROM admins WHERE email = :email";
    $parameters['email'] = $email;
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


  public function retrieveById($id){

    $sql = "SELECT * from admins where id_admin = :id_admin";
    $parameters['id_admin'] = $id;
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

    $sql = "SELECT * FROM admins order by name";
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
      return new M_User($p['email'], $p['name'], $p['surname'], $p['pass'], $p['is_admin'], $p['id_admin']);}, $value);


      return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];


    }


    public function update($obj){
      $sql = "UPDATE admins SET email = :email, name = :name, surname = :surname, pass = :pass, is_admin = :is_admin where id_admin = :id_admin";
      $parameters['id_admin'] = $obj->getId();
      $parameters['email'] = $obj->getMail();
      $parameters['name'] = $obj->getName();
      $parameters['surname'] = $obj->getSurname();
      $parameters['pass'] = $obj->getPass();
      $parameters['is_admin'] = $obj->getIsAdmin();
      try{
        $this->connection = Connection::getInstance();
        return $this->connection->ExecuteNonQuery($sql, $parameters);
      }catch(\PDOException $ex){
        throw $ex;

      }

    }

    public function delete($id){

      $sql = "DELETE from admins where id_admin = :id_admin";
      $parameters['id_admin'] = $id;

      try{
        $this->connection = Connection::getInstance();
        $response = $this->connection->executeNonQuery($sql, $parameters);
      }catch(Exception $ex){
        throw $ex;
      }



    }


  }


  ?>
