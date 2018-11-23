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
  private $daoClients;
  function __construct(){

    $this->daoClients = D_Client::getInstance();

  }


  public function add($obj){

    $sql ="INSERT INTO purchases (date_purchase, id_user) VALUES (:date_purchase, :id_user)";

    $parameters['date_purchase'] = $obj->getDate();
    $parameters['id_user'] = $obj->getClient()->getId();



    try{
      $this->connection = Connection::getInstance();

      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
       $ex->getMessage();

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
       $ex->getMessage();

    }if(!empty($response)){

      $result = $this->map($response);
      return array_shift($result);
    }

    else
    return null;



  }



  public function getAll(){

    $sql = "SELECT * FROM purchases order by date_purchase";
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
    $arrayResponse = array();


    $resp = array_map(function($p){

      $client = $this->daoClients->retrieveById($p['id_client']);

      return new M_Purchase($p['date_purchase'], $client, $p['id_purchase']);
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
       $ex->getMessage();

    }

  }


  public function delete($id){

    $sql = "DELETE from purchases where id_purchase = :id_purchase";
    $parameters['id_purchase'] = $id;

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->executeNonQuery($sql, $parameters);
    }catch(Exception $ex){
       $ex->getMessage();
    }



  }


}


?>
