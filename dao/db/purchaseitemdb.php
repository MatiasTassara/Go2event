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

  public function retrieveByPurchaseId($idPurchase){

    $sql= "SELECT pi.id_purchase_item FROM purchase_items pi INNER JOIN purchases p ON 
           pi.id_purchase = p.id_purchase WHERE pi.id_purchase = :id_purchase";
    $parameters['id_purchase'] = $idPurchase;
     try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql,$parameters);
    }catch(Exception $ex){
       $ex->getMessage();
    }
    $arrayPurchaseItems = array();
    if(isset($response)){
      foreach ($response as $key => $value) {
        $purchaseItem = $this->retrieveById($value['id_purchase_item']);
        $arrayPurchaseItems[] = $purchaseItem;
      }
      return $arrayPurchaseItems;
    }else{
      return null;
    }
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
  public function totalIncome($dateFrom, $dateTo){

    $sql = "SELECT sum(pi.quantity * pi.price) as total FROM purchase_items pi INNER JOIN seats s
            ON pi.id_seat = s.id_seat INNER JOIN calendars c ON s.id_calendar = c.id_calendar
            WHERE c.date_calendar >= :date_from AND c.date_calendar <= :date_to";
    $parameters['date_from'] = $dateFrom;
    $parameters['date_to'] = $dateTo;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);
    }catch(Exception $ex){
       $ex->getMessage();
    }
    if(!empty($response)){
      $money = $response['total'];
      return $money;
    } else
    return 0;
  }



  protected function map($value) {

    $value = is_array($value) ? $value : [];
    $arrayResponse = array();


    $resp = array_map(function($p){

      $purchase = $this->daoPurchases->retrieveById($p['id_purchase']);
      $seat = $this->daoSeats->retrieveById($p['id_seat']);

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
