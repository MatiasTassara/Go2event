<?php
namespace dao\db;

use Model\User as M_User;
use Dao\db\RoleDb as RoleDb;
use Dao\singletondao as SingletonDAO;

/**
*
*/
class UserDb extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  private $daoRoles;
  function __construct(){

    $this->daoRoles = RoleDb::getInstance();

  }

  public function add($obj){

    $sql ="INSERT INTO users (email, name, surname, pass, id_role) VALUES (:email, :name, :surname, :pass, :role)";

    $parameters['email'] = $obj->getMail();
    $parameters['name'] =$obj->getName();
    $parameters['surname'] =$obj->getSurname();
    $parameters['pass']= $obj->getPass();
    $parameters['role'] = $obj->getRole()->getId();

    try{
      $this->connection = Connection::getInstance();

      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function retrieveByName($name){

    $sql = "SELECT * FROM users where name LIKE %:name%";

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
    $sql = "SELECT * FROM users WHERE email = :email AND id_role <> 3";
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

    $sql = "SELECT * from users where id_user = :id_user";
    $parameters['id_user'] = $id;
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

    $sql = "SELECT * FROM users";
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

    $rol = $this->daoRoles->retrieveById($p['id_role']);
    return new M_User($p['email'], $p['name'], $p['surname'], $p['pass'], $rol, $p['id_user']);}, $value);


    return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];


  }


  public function update($obj){
    $sql = "UPDATE users SET email = :email, name = :name, surname = :surname, pass = :pass, id_role = :id_role where id_user = :id_user";
    $parameters['id_user'] = $obj->getId();
    $parameters['email'] = $obj->getMail();
    $parameters['name'] = $obj->getName();
    $parameters['surname'] = $obj->getSurname();
    $parameters['pass'] = $obj->getPass();
    $parameters['id_role'] = $obj->getRole()->getId();
    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }


  public function delete($id){

    $sql = "DELETE from users where id_user = :id_user";
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
