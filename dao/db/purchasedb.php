<?php
namespace dao\db;

use Model\Purchase as M_Purchase;
use Dao\db\UserDb as D_User;
use Dao\singletondao as SingletonDAO;
/**
*
*/
class PurchaseDb extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  private $daoUser;
  function __construct(){

    $this->daoUsers = D_User::getInstance();

  }


  public function add($obj){

    $sql ="INSERT INTO purchases (date_purchase, id_user) VALUES (:date_purchase, :id_user)";

    $parameters['date_purchase'] = $obj->getDate();
    $parameters['id_user'] = $obj->getUser()->getId();



    try{
      $this->connection = Connection::getInstance();

      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function retrieveByName($name){


  }


  public function retrieveById($id){

    $sql = "SELECT * from purchases where id_purchase = :id_purchase";
    $parameters['id_purchase'] = $id;
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
  public function getLastPurchase(){
    $sql = "SELECT * FROM purchases order by id_purchase desc limit 1";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
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

  public function retrieveByUserEmail($email){

    $sql= "SELECT p.id_purchase FROM purchases p INNER JOIN users s ON p.id_user = s.id_user WHERE email = :email";
    $parameters['email'] = $email;
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql, $parameters);
    }catch(Exception $ex){
       $ex->getMessage();
    }
    $arrayPurchases = array();
    if(isset($response)){
      foreach ($response as $key => $value) {
        $purchase = $this->retrieveById($value['id_purchase']);
        $arrayPurchases[] = $purchase;
        
      }
      return $arrayPurchases;
    }else{
      return null;
    }




  }


  public function getAll(){

    $sql = "SELECT * FROM purchases order by date_purchase";
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

      $user = $this->daoUsers->retrieveById($p['id_user']);

      return new M_Purchase($p['date_purchase'], $user, $p['id_purchase']);
    }, $value);

    return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];


  }

  public function update($obj){
    $sql = "UPDATE purchases SET date_purchase = :date_purchase, id_user = :id_user where id_purchase = :id_purchase";
    $parameters['id_purchase'] = $obj->getId();
    $parameters['date_purchase'] = $obj->getDate();
    $parameters['id_user'] = $obj->getUser()->getId();

    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }


  public function delete($id){

    $sql = "DELETE from purchases where id_purchase = :id_purchase";
    $parameters['id_purchase'] = $id;

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->executeNonQuery($sql, $parameters);
    }catch(Exception $ex){
      throw $ex;
    }



  }


}


?>
