<?php
namespace dao\db;

use Model\PurchaseItem as M_PurchaseItem;
use Dao\db\PurchaseDb as D_Purchase;
use Dao\singletondao as SingletonDAO;
use Dao\db\SeatDb as D_Seat;
/**
*
*/
class PurchaseItemDb extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  private $daoPurchases;
  private $daoSeats;
  function __construct(){

    $this->daoPurchases = D_Purchase::getInstance();
    $this->daoSeats = D_Seat::getInstance();

  }


  public function add($obj){

    $sql ="INSERT INTO purchase_items (quantity, price, id_purchase, id_seat) VALUES (:quantity, :price, :id_purchase, :id_seat)";

    $parameters['quantity'] = $obj->getQuantity();
    $parameters['price'] = $obj->getPrice();
    $parameters['id_purchase'] = $obj->getPurchase()->getId();
    $parameters['id_seat'] = $obj->getSeat()->getId();



    try{
      $this->connection = Connection::getInstance();

      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }
  public function getLastPurchaseItems(){
    $sql = "SELECT * FROM purchase_items order by id_purchase_item desc limit 1";
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
  public function retrieveByName($name){


  }


  public function retrieveById($id){

    $sql = "SELECT * from purchase_items where id_purchase_item = :id_purchase_item";
    $parameters['id_purchase_item'] = $id;
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

    $sql = "SELECT * FROM purchase_items order by price";
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

      $purchase = $this->daoPurchases->retrieveById($p['id_purchase']);
      $seat = $daoSeats->retrieveById($p['id_seat']);

      return new M_PurchaseItem ($p['quantity'], $p['price'], $purchase, $seat, $p['id_purchase_item']);
    }, $value);

    return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];


  }

  public function update($obj){
    $sql = "UPDATE purchase_items SET quantity = :quantity, price = :price, id_purchase = :id_purchase, id_seat = :id_seat where id_purchase_item = :id_purchase_item";
    $parameters['id_purchase_item'] = $obj->getId();
    $parameters['quantity'] = $obj->getQuantity();
    $parameters['price'] = $obj->getPrice();
    $parameters['id_purchase'] = $obj->getPurchase()->getId();
    $parameters['id_seat'] = $obj->getSeat()->getId();


    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function delete($id){

    $sql = "DELETE from purchase_items where id_purchase_item = :id_purchase_item";
    $parameters['id_purchase_item'] = $id;

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->executeNonQuery($sql, $parameters);
    }catch(Exception $ex){
      throw $ex;
    }



  }


}


?>
